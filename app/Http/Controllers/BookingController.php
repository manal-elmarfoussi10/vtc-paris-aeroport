<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Customer;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

class BookingController extends Controller
{
    public function index()
    {
        $vehicles = Vehicle::active()->get();
        return view('booking.index', compact('vehicles'));
    }

    public function store(Request $request)
    {
        // Validation rules
        $validated = $request->validate([
            'pickup_address' => 'required|string|max:255',
            'pickup_lat' => 'nullable|numeric|between:-90,90',
            'pickup_lng' => 'nullable|numeric|between:-180,180',
            'dropoff_address' => 'required|string|max:255',
            'dropoff_lat' => 'nullable|numeric|between:-90,90',
            'dropoff_lng' => 'nullable|numeric|between:-180,180',
            'pickup_time' => 'required|date|after:now +2 hours',
            'pax' => 'required|integer|min:1|max:8',
            'luggage' => 'required|integer|min:0|max:8',
            'vehicle_class' => 'required|in:sedan,business,van',
            'child_seat_count' => 'nullable|integer|min:0|max:4',
            'meet_greet' => 'nullable|boolean',
            'flight_number' => 'nullable|string|max:20',
            'notes' => 'nullable|string|max:1000',
            // Guest booking fields
            'customer_name' => 'required_if:user_id,null|string|max:255',
            'customer_email' => 'required_if:user_id,null|email|max:255',
            'customer_phone' => 'required_if:user_id,null|string|max:20',
        ], [
            'pickup_address.required' => 'L\'adresse de prise en charge est obligatoire.',
            'dropoff_address.required' => 'L\'adresse de destination est obligatoire.',
            'pickup_time.required' => 'La date et heure sont obligatoires.',
            'pickup_time.after' => 'La réservation doit être faite au minimum 2 heures à l\'avance.',
            'pax.required' => 'Le nombre de passagers est obligatoire.',
            'pax.min' => 'Au minimum 1 passager.',
            'pax.max' => 'Maximum 8 passagers.',
            'luggage.required' => 'Le nombre de bagages est obligatoire.',
            'luggage.min' => 'Nombre de bagages invalide.',
            'luggage.max' => 'Maximum 8 bagages.',
            'vehicle_class.required' => 'La catégorie de véhicule est obligatoire.',
            'vehicle_class.in' => 'Catégorie de véhicule invalide.',
            'customer_name.required_if' => 'Le nom est obligatoire pour les réservations sans compte.',
            'customer_email.required_if' => 'L\'email est obligatoire pour les réservations sans compte.',
            'customer_email.email' => 'Adresse email invalide.',
            'customer_phone.required_if' => 'Le téléphone est obligatoire pour les réservations sans compte.',
        ]);

        try {
            DB::beginTransaction();

            $user = Auth::user();
            $customer = null;

            // Handle guest booking or create/update customer profile
            if ($user) {
                $customer = $user->customer ?? Customer::create(['user_id' => $user->id]);
            }

            // Find available vehicle
            $vehicle = Vehicle::where('class', $validated['vehicle_class'])
                             ->active()
                             ->first();

            if (!$vehicle) {
                return back()->withErrors(['vehicle_class' => 'Aucun véhicule disponible dans cette catégorie.']);
            }

            // Calculate estimated price (simplified for v1)
            $priceEstimate = $this->calculatePriceEstimate($validated, $vehicle);

            // Create booking
            $booking = Booking::create([
                'user_id' => $user?->id,
                'customer_id' => $customer?->id,
                'customer_name' => $validated['customer_name'] ?? $user?->name,
                'customer_email' => $validated['customer_email'] ?? $user?->email,
                'customer_phone' => $validated['customer_phone'] ?? $user?->phone,
                'pickup_address' => $validated['pickup_address'],
                'pickup_lat' => $validated['pickup_lat'],
                'pickup_lng' => $validated['pickup_lng'],
                'dropoff_address' => $validated['dropoff_address'],
                'dropoff_lat' => $validated['dropoff_lat'],
                'dropoff_lng' => $validated['dropoff_lng'],
                'pickup_time' => Carbon::parse($validated['pickup_time']),
                'pax' => $validated['pax'],
                'luggage' => $validated['luggage'],
                'vehicle_id' => $vehicle->id,
                'child_seat_count' => $validated['child_seat_count'] ?? 0,
                'meet_greet' => $validated['meet_greet'] ?? false,
                'flight_number' => $validated['flight_number'],
                'price' => $priceEstimate,
                'notes' => $validated['notes'],
                'status' => 'new',
            ]);

            // Update customer stats if logged in
            if ($customer) {
                $customer->updateBookingStats();
            }

            DB::commit();

            // Send confirmation email
            try {
                Mail::to($booking->customer_email)->send(new BookingConfirmation($booking));
                Log::info('Booking confirmation email sent', [
                    'booking_id' => $booking->id,
                    'email' => $booking->customer_email,
                ]);
            } catch (\Exception $e) {
                Log::error('Failed to send booking confirmation email', [
                    'booking_id' => $booking->id,
                    'email' => $booking->customer_email,
                    'error' => $e->getMessage(),
                ]);
                // Don't fail the booking if email fails
            }

            // Log the booking
            Log::info('New booking created', [
                'booking_id' => $booking->id,
                'customer_email' => $booking->customer_email,
                'pickup_time' => $booking->pickup_time,
            ]);

            return redirect()->route('booking.confirm', $booking)
                           ->with('success', 'Votre réservation a été créée avec succès ! Un email de confirmation vous a été envoyé.');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Booking creation failed', [
                'error' => $e->getMessage(),
                'data' => $validated
            ]);

            return back()->withErrors(['general' => 'Une erreur est survenue lors de la création de votre réservation. Veuillez réessayer.']);
        }
    }

    public function confirm(Booking $booking)
    {
        // Ensure user can only see their own bookings
        if (Auth::check() && $booking->user_id !== Auth::id()) {
            abort(403);
        }

        return view('booking.confirm', compact('booking'));
    }

    /**
     * Calculate estimated price using actual distance from Google Distance Matrix API
     */
    private function calculatePriceEstimate(array $data, Vehicle $vehicle): float
{
    $baseRate   = $vehicle->base_rate;
    $perKm      = $vehicle->per_km ?? 1.50;
    $perMinute  = $vehicle->per_min ?? 0.50;

    $distanceKm      = 0;
    $durationMinutes = 0;

    try {
        // we just use full addresses here
        $origin      = $data['pickup_address'];
        $destination = $data['dropoff_address'];

        $apiKey = env('GOOGLE_MAPS_API_KEY');
        $url    = 'https://maps.googleapis.com/maps/api/distancematrix/json';

        $response = Http::get($url, [
            'origins'      => $origin,
            'destinations' => $destination,
            'key'          => $apiKey,
        ]);

        if ($response->successful()) {
            $json = $response->json();

            if (
                isset($json['rows'][0]['elements'][0]['status']) &&
                $json['rows'][0]['elements'][0]['status'] === 'OK'
            ) {
                $distanceKm      = $json['rows'][0]['elements'][0]['distance']['value'] / 1000; // m → km
                $durationMinutes = $json['rows'][0]['elements'][0]['duration']['value'] / 60;   // s → min
            }
        }
    } catch (\Exception $e) {
        Log::warning('Failed to get distance data for price calculation', [
            'error' => $e->getMessage(),
            'data'  => $data,
        ]);
        // fallback values
        $distanceKm      = 25;
        $durationMinutes = 45;
    }

    $price = $baseRate + ($distanceKm * $perKm) + ($durationMinutes * $perMinute);

    // Extras
    if (($data['child_seat_count'] ?? 0) > 0) {
        $price += ($data['child_seat_count'] * 10);
    }

    if (!empty($data['meet_greet'])) {
        $price += 15;
    }

    return round($price, 2);
}
    /**
     * Get distance data from Google Distance Matrix API
     */
    private function getDistanceData(float $originLat, float $originLng, float $destinationLat, float $destinationLng): ?array
    {
        $origin = $originLat . ',' . $originLng;
        $destination = $destinationLat . ',' . $destinationLng;

        $apiKey = env('GOOGLE_MAP_KEY');
        $url = 'https://maps.googleapis.com/maps/api/distancematrix/json';

        $response = Http::get($url, [
            'origins' => $origin,
            'destinations' => $destination,
            'key' => $apiKey,
        ]);

        if ($response->successful()) {
            $data = $response->json();

            if (isset($data['rows'][0]['elements'][0]['status']) && $data['rows'][0]['elements'][0]['status'] === 'OK') {
                return [
                    "success" => true,
                    "message" => "success",
                    "data" => [
                        'distance_text' => $data['rows'][0]['elements'][0]['distance']['text'],
                        'distance_value' => $data['rows'][0]['elements'][0]['distance']['value'],
                        'duration_text' => $data['rows'][0]['elements'][0]['duration']['text'],
                        'duration_value' => $data['rows'][0]['elements'][0]['duration']['value']
                    ]
                ];
            }
        }

        return null;
    }

    /**
     * Calculate distance and duration using Google Distance Matrix API
     */
    public function showDistance(Request $request)
    {
        $request->validate([
            'origin'      => 'required|string|max:255',
            'destination' => 'required|string|max:255',
        ]);
    
        $origin      = $request->origin;
        $destination = $request->destination;
    
        $apiKey = env('GOOGLE_MAPS_API_KEY'); // use the same key as in .env
        $url    = 'https://maps.googleapis.com/maps/api/distancematrix/json';
    
        $response = Http::get($url, [
            'origins'      => $origin,
            'destinations' => $destination,
            'key'          => $apiKey,
        ]);
    
        if ($response->successful()) {
            $data = $response->json();
    
            if (
                isset($data['rows'][0]['elements'][0]['status']) &&
                $data['rows'][0]['elements'][0]['status'] === 'OK'
            ) {
                return response()->json([
                    'success' => true,
                    'message' => 'success',
                    'data'    => [
                        'distance_text'  => $data['rows'][0]['elements'][0]['distance']['text'],
                        'distance_value' => $data['rows'][0]['elements'][0]['distance']['value'], // meters
                        'duration_text'  => $data['rows'][0]['elements'][0]['duration']['text'],
                        'duration_value' => $data['rows'][0]['elements'][0]['duration']['value'], // seconds
                    ],
                ]);
            }
        }
    
        return response()->json([
            'success' => false,
            'message' => 'Impossible de calculer la distance.',
        ], 422);
    }
    /**
     * Send booking confirmation (placeholder)
     */
    private function sendBookingConfirmation(Booking $booking): void
    {
        // TODO: Implement email sending
        // For now, just log it
        Log::info('Booking confirmation email would be sent', [
            'booking_id' => $booking->id,
            'email' => $booking->customer_email,
        ]);
    }
}
