<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class BookingController extends Controller
{
    /**
     * Show booking page (single-page flow with steps 1–3)
     */
    public function index()
    {
        $vehicles = Vehicle::where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        return view('booking.index', compact('vehicles'));
    }

    /**
     * (Optional) If you use /booking/create separately
     */
    public function create()
    {
        $vehicles = Vehicle::where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        // same view as index
        return view('booking.index', compact('vehicles'));
    }

    /**
     * Store a new booking from the multi-step form.
     */
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

            // Options (checkbox)
            'child_seat_count' => 'nullable',
            'meet_greet'       => 'nullable',

            // Commentaires
            'notes'            => 'nullable|string',
        ]);

        // Find the vehicle by "class" (eco / berline / van / electric)
        $vehicle = Vehicle::where('class', $validated['vehicle_class'])->first();

        // Calculate price estimate
        $price = $vehicle ? $this->calculatePriceEstimate($validated, $vehicle) : 0;

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
            'vehicle_id'       => $vehicle ? $vehicle->id : null,

            // Client
            'customer_name'    => $validated['customer_name'],
            'customer_email'   => $validated['customer_email'],
            'customer_phone'   => $validated['customer_phone'] ?? null,

            // Options (checkbox => bool)
            'child_seat_count' => $request->boolean('child_seat_count'),
            'meet_greet'       => $request->boolean('meet_greet'),

            // Commentaires
            'notes'            => $validated['notes'] ?? null,

            // Pricing
            'price'            => $price,
        ]);

        // Send booking confirmation emails
        $this->sendBookingConfirmation($booking);

        return redirect()
            ->route('booking')
            ->with('status', 'Votre réservation a bien été enregistrée. Nous vous contacterons rapidement.');
    }

    /**
     * Optional confirmation page if you want /booking/{booking}/confirm
     */
    public function confirm(Booking $booking)
    {
        // Ensure user can only see their own bookings, if you link bookings to users
        if (Auth::check() && $booking->user_id && $booking->user_id !== Auth::id()) {
            abort(403);
        }

        return view('booking.confirm', compact('booking'));
    }

    /**
     * Calculate estimated price using Google Distance Matrix API
     * Uses the SERVER distance key (GOOGLE_DISTANCE_MATRIX_KEY).
     */
    private function calculatePriceEstimate(array $data, Vehicle $vehicle): float
    {
        $distanceKm = 0;

        try {
            $origin      = $data['pickup_address'];
            $destination = $data['dropoff_address'];

            // ✅ SERVER KEY (no referrer restriction)
            $apiKey = config('services.google.distance_key', env('GOOGLE_DISTANCE_MATRIX_KEY'));
            $url    = 'https://maps.googleapis.com/maps/api/distancematrix/json';

            $response = Http::get($url, [
                'origins'      => $origin,
                'destinations' => $destination,
                'mode'         => 'driving',
                'units'        => 'metric',
                'language'     => 'fr',
                'key'          => $apiKey,
            ]);

            if ($response->successful()) {
                $json = $response->json();

                if (
                    isset($json['rows'][0]['elements'][0]['status']) &&
                    $json['rows'][0]['elements'][0]['status'] === 'OK'
                ) {
                    $distanceKm = $json['rows'][0]['elements'][0]['distance']['value'] / 1000; // m → km
                } else {
                    Log::warning('DistanceMatrix price calc bad element status', [
                        'body' => $json,
                    ]);
                }
            } else {
                Log::warning('DistanceMatrix price calc HTTP error', [
                    'status' => $response->status(),
                    'body'   => $response->body(),
                ]);
            }
        } catch (\Exception $e) {
            Log::warning('Failed to get distance data for price calculation', [
                'error' => $e->getMessage(),
                'data'  => $data,
            ]);
            $distanceKm = 0;
        }

        // Same tariffs as in JS
        $rates = [
            'eco'      => ['perKm' => 1.80, 'minPrice' => 35],
            'berline'  => ['perKm' => 2.20, 'minPrice' => 55],
            'van'      => ['perKm' => 2.75, 'minPrice' => 65],
            'electric' => ['perKm' => 1.90, 'minPrice' => 50],
        ];

        $vehicleClass = $data['vehicle_class'] ?? $vehicle->class;

        if (isset($rates[$vehicleClass])) {
            $perKm    = $rates[$vehicleClass]['perKm'];
            $minPrice = $rates[$vehicleClass]['minPrice'];
        } else {
            $perKm    = 1.80;
            $minPrice = 35;
        }

        $total = 0;

        if ($distanceKm > 0) {
            $total = $distanceKm * $perKm;

            if ($total < $minPrice) {
                $total = $minPrice;
            }
        }

        // Options (same as JS: +15€ siège enfant, +10€ meet & greet)
        if (!empty($data['child_seat_count'])) {
            $total += 15;
        }

        if (!empty($data['meet_greet'])) {
            $total += 10;
        }

        return round($total, 2);
    }

    /**
     * AJAX endpoint used by JS route('booking.distance')
     * Returns distance + duration for live estimation.
     * Uses SERVER distance key as well.
     */
    public function showDistance(Request $request)
    {
        $request->validate([
            'origin'      => 'required|string',
            'destination' => 'required|string',
        ]);

        // ✅ SERVER KEY
        $apiKey = config('services.google.distance_key', env('GOOGLE_DISTANCE_MATRIX_KEY'));

        Log::info('Distance calculation requested', [
            'origin'      => $request->origin,
            'destination' => $request->destination,
            'api_key_set' => !empty($apiKey),
        ]);

        if (empty($apiKey)) {
            Log::error('Google Distance Matrix API key is not set');
            return response()->json([
                'success' => false,
                'message' => 'NO_API_KEY',
                'data'    => [
                    'distance_text'  => '0 km',
                    'distance_value' => 0,
                    'duration_text'  => '0 min',
                    'duration_value' => 0,
                ],
            ], 400);
        }

        try {
            $response = Http::get('https://maps.googleapis.com/maps/api/distancematrix/json', [
                'origins'      => $request->origin,
                'destinations' => $request->destination,
                'mode'         => 'driving',
                'units'        => 'metric',
                'language'     => 'fr',
                'key'          => $apiKey,
            ]);

            Log::info('Google DistanceMatrix raw response', [
                'status'      => $response->status(),
                'successful'  => $response->successful(),
                'body'        => $response->body(),
            ]);

            $data = $response->json();

            // Global API status
            if (($data['status'] ?? null) !== 'OK') {
                return response()->json([
                    'success'       => false,
                    'message'       => $data['status'] ?? 'NO_STATUS',
                    'error_message' => $data['error_message'] ?? null,
                    'raw'           => $data,
                ], 400);
            }

            // Element status
            $element = $data['rows'][0]['elements'][0] ?? null;

            if (!$element || ($element['status'] ?? null) !== 'OK') {
                return response()->json([
                    'success' => false,
                    'message' => $element['status'] ?? 'NO_ELEMENT_STATUS',
                    'raw'     => $data,
                ], 400);
            }

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
            Log::error('DistanceMatrix AJAX error', [
                'error'       => $e->getMessage(),
                'origin'      => $request->origin,
                'destination' => $request->destination,
            ]);

            return response()->json([
                'success' => false,
                'message' => 'EXCEPTION',
                'error'   => $e->getMessage(),
                'data'    => [
                    'distance_text'  => '0 km',
                    'distance_value' => 0,
                    'duration_text'  => '0 min',
                    'duration_value' => 0,
                ],
            ], 500);
        }
    }

    /**
     * Send booking confirmation email to client + admin.
     */
    private function sendBookingConfirmation(Booking $booking): void
    {
        try {
            Mail::to($booking->customer_email)
                ->send(new \App\Mail\BookingConfirmation($booking));

            // Optionally send to your admin / from address
            if (config('mail.from.address')) {
                Mail::to(config('mail.from.address'))
                    ->send(new \App\Mail\BookingConfirmation($booking));
            }
        } catch (\Exception $e) {
            Log::error('Failed to send booking confirmation email: ' . $e->getMessage(), [
                'booking_id' => $booking->id,
                'email'      => $booking->customer_email,
            ]);
        }
    }
}