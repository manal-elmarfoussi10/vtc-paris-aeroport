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
            'pickup_address'  => 'required|string|max:255',
            'pickup_lat'      => 'nullable|numeric',
            'pickup_lng'      => 'nullable|numeric',
            'dropoff_address' => 'required|string|max:255',
            'dropoff_lat'     => 'nullable|numeric',
            'dropoff_lng'     => 'nullable|numeric',
            'pickup_time'     => 'required|date',   // 👈 use pickup_time
            'pax'             => 'required|integer|min:1|max:8',
            'luggage'         => 'required|integer|min:0|max:8',
            'vehicle_class'   => 'required|string',
            'customer_name'   => 'required|string|max:255',
            'child_seat_count'=> 'nullable',
            'meet_greet'      => 'nullable',
            'notes'           => 'nullable|string',
        ]);
    
        $booking = Booking::create([
            'pickup_address'  => $validated['pickup_address'],
            'dropoff_address' => $validated['dropoff_address'],
            'pickup_time'     => $validated['pickup_time'],   // 👈 save it
            'pax'             => $validated['pax'],
            'luggage'         => $validated['luggage'],
            'vehicle_class'   => $validated['vehicle_class'],
            'customer_name'   => $validated['customer_name'],
            'child_seat_count'=> $request->boolean('child_seat_count'),
            'meet_greet'      => $request->boolean('meet_greet'),
            'notes'           => $validated['notes'] ?? null,
        ]);

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
     * Get distance data from Google Distance Matrix API
     */
    private function getDistanceData(float $originLat, float $originLng, float $destinationLat, float $destinationLng): ?array
    {
        $origin = $originLat . ',' . $originLng;
        $destination = $destinationLat . ',' . $destinationLng;

        $apiKey = config('services.google.maps_key');
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
        // For now, just log it
        Log::info('Booking confirmation email would be sent', [
            'booking_id' => $booking->id,
            'email' => $booking->customer_email,
        ]);
    }
}
