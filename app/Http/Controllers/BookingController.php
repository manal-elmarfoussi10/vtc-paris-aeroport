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

            // Send confirmation email (placeholder for now)
            $this->sendBookingConfirmation($booking);

            // Log the booking
            Log::info('New booking created', [
                'booking_id' => $booking->id,
                'customer_email' => $booking->customer_email,
                'pickup_time' => $booking->pickup_time,
            ]);

            return redirect()->route('booking.confirm', $booking)
                           ->with('success', 'Votre réservation a été créée avec succès !');

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
     * Calculate estimated price (simplified version for v1)
     */
    private function calculatePriceEstimate(array $data, Vehicle $vehicle): float
    {
        $baseRate = $vehicle->base_rate;
        $perKm = $vehicle->per_km ?? 1.50;
        $perMinute = $vehicle->per_min ?? 0.50;

        // Simplified calculation - in production, use actual distance/time
        $estimatedKm = 25; // placeholder
        $estimatedMinutes = 45; // placeholder

        $price = $baseRate + ($estimatedKm * $perKm) + ($estimatedMinutes * $perMinute);

        // Add extras
        if (($data['child_seat_count'] ?? 0) > 0) {
            $price += ($data['child_seat_count'] * 10); // €10 per child seat
        }

        if ($data['meet_greet'] ?? false) {
            $price += 15; // €15 for meet & greet
        }

        return round($price, 2);
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
