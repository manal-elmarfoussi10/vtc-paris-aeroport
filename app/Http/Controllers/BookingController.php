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
        // adapt filters to your schema
        $vehicles = Vehicle::where('is_active', true)->orderBy('sort_order')->get();

        return view('booking.index', compact('vehicles'));
    }

    public function create()
    {
        $vehicles = Vehicle::where('is_active', true)->orderBy('sort_order')->get();

        return view('booking.create', compact('vehicles'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            // Trajet
            'pickup_address'   => 'required|string|max:255',
            'pickup_lat'       => 'nullable|numeric',
            'pickup_lng'       => 'nullable|numeric',
            'pickup_postal'    => 'nullable|string|max:20',
            'pickup_city'      => 'nullable|string|max:100',
            'pickup_note'      => 'nullable|string|max:255',

            'dropoff_address'  => 'required|string|max:255',
            'dropoff_lat'      => 'nullable|numeric',
            'dropoff_lng'      => 'nullable|numeric',
            'dropoff_postal'   => 'nullable|string|max:20',
            'dropoff_city'     => 'nullable|string|max:100',
            'dropoff_note'     => 'nullable|string|max:255',

            'pickup_time'      => 'required|date',
            'pax'              => 'required|integer|min:1|max:8',
            'luggage'          => 'required|integer|min:0|max:8',

            // Véhicule
            'vehicle_class'    => 'required|string',

            // Client
            'customer_name'    => 'required|string|max:255',
            'customer_email'   => 'required|email|max:255',
            'customer_phone'   => 'nullable|string|max:50',

            // Options
            'child_seat_count' => 'nullable',
            'meet_greet'       => 'nullable',

            // Commentaires
            'notes'            => 'nullable|string',
        ]);

        $booking = Booking::create([
            // Trajet
            'pickup_address'   => $validated['pickup_address'],
            'pickup_lat'       => $validated['pickup_lat'] ?? null,
            'pickup_lng'       => $validated['pickup_lng'] ?? null,
            'pickup_postal'    => $validated['pickup_postal'] ?? null,
            'pickup_city'      => $validated['pickup_city'] ?? null,
            'pickup_note'      => $validated['pickup_note'] ?? null,

            'dropoff_address'  => $validated['dropoff_address'],
            'dropoff_lat'      => $validated['dropoff_lat'] ?? null,
            'dropoff_lng'      => $validated['dropoff_lng'] ?? null,
            'dropoff_postal'   => $validated['dropoff_postal'] ?? null,
            'dropoff_city'     => $validated['dropoff_city'] ?? null,
            'dropoff_note'     => $validated['dropoff_note'] ?? null,

            'pickup_time'      => $validated['pickup_time'],
            'pax'              => $validated['pax'],
            'luggage'          => $validated['luggage'],

            // Véhicule
            'vehicle_class'    => $validated['vehicle_class'],

            // Client
            'customer_name'    => $validated['customer_name'],
            'customer_email'   => $validated['customer_email'],
            'customer_phone'   => $validated['customer_phone'] ?? null,

            // Options
            'child_seat_count' => $request->boolean('child_seat_count'),
            'meet_greet'       => $request->boolean('meet_greet'),

            // Commentaires
            'notes'            => $validated['notes'] ?? null,
        ]);

        // Optionnel : envoyer un mail de confirmation
        // $this->sendBookingConfirmation($booking);

        return redirect()
            ->route('booking')
            ->with('status', 'Votre réservation a bien été enregistrée. Nous vous contacterons rapidement.');
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

            $apiKey = config('services.google.maps_key');
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
     * Get distance data from Google Distance Matrix API (using coords)
     */
    private function getDistanceData(float $originLat, float $originLng, float $destinationLat, float $destinationLng): ?array
    {
        $origin      = $originLat . ',' . $originLng;
        $destination = $destinationLat . ',' . $destinationLng;

        $apiKey = config('services.google.maps_key');
        $url    = 'https://maps.googleapis.com/maps/api/distancematrix/json';

        $response = Http::get($url, [
            'origins'      => $origin,
            'destinations' => $destination,
            'key'          => $apiKey,
        ]);

        if ($response->successful()) {
            $data = $response->json();

            if (isset($data['rows'][0]['elements'][0]['status'])
                && $data['rows'][0]['elements'][0]['status'] === 'OK'
            ) {
                return [
                    "success" => true,
                    "message" => "success",
                    "data" => [
                        'distance_text'   => $data['rows'][0]['elements'][0]['distance']['text'],
                        'distance_value'  => $data['rows'][0]['elements'][0]['distance']['value'],
                        'duration_text'   => $data['rows'][0]['elements'][0]['duration']['text'],
                        'duration_value'  => $data['rows'][0]['elements'][0]['duration']['value'],
                    ],
                ];
            }
        }

        return null;
    }

    /**
     * Calculate distance and duration using Google Distance Matrix API
     * (used by AJAX route booking.distance)
     */
    public function showDistance(Request $request)
    {
        $request->validate([
            'origin'      => 'required|string',
            'destination' => 'required|string',
        ]);

        $apiKey = config('services.google.maps_key', env('GOOGLE_MAPS_API_KEY'));

        try {
            $response = Http::get('https://maps.googleapis.com/maps/api/distancematrix/json', [
                'origins'      => $request->origin,
                'destinations' => $request->destination,
                'mode'         => 'driving',
                'units'        => 'metric',
                'language'     => 'fr',
                'key'          => $apiKey,
            ]);

            if (! $response->successful()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Erreur API Google.',
                ], 500);
            }

            $data = $response->json();

            if (
                empty($data['rows'][0]['elements'][0]) ||
                $data['rows'][0]['elements'][0]['status'] === 'ZERO_RESULTS'
            ) {
                return response()->json([
                    'success' => false,
                    'message' => 'Trajet introuvable.',
                ], 422);
            }

            $element = $data['rows'][0]['elements'][0];

            return response()->json([
                'success' => true,
                'data'    => [
                    'distance_text'  => $element['distance']['text'],
                    'distance_value' => $element['distance']['value'],
                    'duration_text'  => $element['duration']['text'],
                    'duration_value' => $element['duration']['value'],
                ],
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur de calcul de distance.',
            ], 500);
        }
    }

    /**
     * Send booking confirmation (placeholder)
     */
    private function sendBookingConfirmation(Booking $booking): void
    {
        // TODO: Implement email sending
        Log::info('Booking confirmation email would be sent', [
            'booking_id' => $booking->id,
            'email'      => $booking->customer_email,
        ]);
    }
}