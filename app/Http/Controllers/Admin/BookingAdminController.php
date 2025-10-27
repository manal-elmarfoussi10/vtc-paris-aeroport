<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Vehicle;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class BookingAdminController extends Controller
{
    public function index(Request $request)
    {
        $query = Booking::with('user', 'vehicle', 'customer');

        // Filters
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('vehicle_id')) {
            $query->where('vehicle_id', $request->vehicle_id);
        }

        if ($request->filled('date_from')) {
            $query->whereDate('pickup_time', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('pickup_time', '<=', $request->date_to);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('customer_name', 'like', "%{$search}%")
                  ->orWhere('customer_email', 'like', "%{$search}%")
                  ->orWhere('pickup_address', 'like', "%{$search}%")
                  ->orWhere('dropoff_address', 'like', "%{$search}%");
            });
        }

        $bookings = $query->latest()->paginate(20);

        $vehicles = Vehicle::active()->get();

        return view('admin.bookings.index', compact('bookings', 'vehicles'));
    }

    public function create()
    {
        $vehicles = Vehicle::active()->get();
        $customers = User::where('role', 'customer')->get();

        return view('admin.bookings.create', compact('vehicles', 'customers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'nullable|exists:users,id',
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email|max:255',
            'customer_phone' => 'nullable|string|max:20',
            'pickup_address' => 'required|string|max:255',
            'dropoff_address' => 'required|string|max:255',
            'pickup_time' => 'required|date|after:now',
            'pax' => 'required|integer|min:1|max:8',
            'luggage' => 'required|integer|min:0|max:8',
            'vehicle_id' => 'required|exists:vehicles,id',
            'child_seat_count' => 'nullable|integer|min:0|max:4',
            'meet_greet' => 'nullable|boolean',
            'flight_number' => 'nullable|string|max:20',
            'price' => 'nullable|numeric|min:0',
            'notes' => 'nullable|string|max:1000',
            'status' => 'required|in:new,confirmed,completed,cancelled',
        ]);

        try {
            DB::beginTransaction();

            $booking = Booking::create($validated);

            // Update customer stats if user is associated
            if ($booking->user && $booking->user->customer) {
                $booking->user->customer->updateBookingStats();
            }

            DB::commit();

            Log::info('Booking created by admin', [
                'booking_id' => $booking->id,
                'admin_id' => auth()->id(),
            ]);

            return redirect()->route('admin.bookings.show', $booking)
                           ->with('success', 'Réservation créée avec succès.');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Admin booking creation failed', [
                'error' => $e->getMessage(),
                'data' => $validated
            ]);

            return back()->withErrors(['general' => 'Erreur lors de la création de la réservation.']);
        }
    }

    public function show(Booking $booking)
    {
        $booking->load('user', 'vehicle', 'customer');
        return view('admin.bookings.show', compact('booking'));
    }

    public function edit(Booking $booking)
    {
        $booking->load('user', 'vehicle');
        $vehicles = Vehicle::active()->get();
        $customers = User::where('role', 'customer')->get();

        return view('admin.bookings.edit', compact('booking', 'vehicles', 'customers'));
    }

    public function update(Request $request, Booking $booking)
    {
        $validated = $request->validate([
            'user_id' => 'nullable|exists:users,id',
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email|max:255',
            'customer_phone' => 'nullable|string|max:20',
            'pickup_address' => 'required|string|max:255',
            'dropoff_address' => 'required|string|max:255',
            'pickup_time' => 'required|date',
            'pax' => 'required|integer|min:1|max:8',
            'luggage' => 'required|integer|min:0|max:8',
            'vehicle_id' => 'required|exists:vehicles,id',
            'child_seat_count' => 'nullable|integer|min:0|max:4',
            'meet_greet' => 'nullable|boolean',
            'flight_number' => 'nullable|string|max:20',
            'price' => 'nullable|numeric|min:0',
            'notes' => 'nullable|string|max:1000',
            'status' => 'required|in:new,confirmed,completed,cancelled',
        ]);

        try {
            DB::beginTransaction();

            $oldStatus = $booking->status;
            $booking->update($validated);

            // Update customer stats if status changed and user is associated
            if ($oldStatus !== $validated['status'] && $booking->user && $booking->user->customer) {
                $booking->user->customer->updateBookingStats();
            }

            DB::commit();

            Log::info('Booking updated by admin', [
                'booking_id' => $booking->id,
                'admin_id' => auth()->id(),
                'old_status' => $oldStatus,
                'new_status' => $validated['status'],
            ]);

            return redirect()->route('admin.bookings.show', $booking)
                           ->with('success', 'Réservation mise à jour avec succès.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['general' => 'Erreur lors de la mise à jour.']);
        }
    }

    public function destroy(Booking $booking)
    {
        try {
            $booking->delete();

            Log::info('Booking deleted by admin', [
                'booking_id' => $booking->id,
                'admin_id' => auth()->id(),
            ]);

            return redirect()->route('admin.bookings.index')
                           ->with('success', 'Réservation supprimée avec succès.');

        } catch (\Exception $e) {
            return back()->withErrors(['general' => 'Erreur lors de la suppression.']);
        }
    }

    public function export(Request $request)
    {
        // Simple CSV export for bookings
        $query = Booking::with('user', 'vehicle');

        if ($request->filled('date_from') && $request->filled('date_to')) {
            $query->whereBetween('pickup_time', [
                Carbon::parse($request->date_from)->startOfDay(),
                Carbon::parse($request->date_to)->endOfDay()
            ]);
        }

        $bookings = $query->get();

        $filename = 'bookings_' . now()->format('Y-m-d_H-i-s') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ];

        $callback = function () use ($bookings) {
            $file = fopen('php://output', 'w');

            // CSV headers
            fputcsv($file, [
                'ID', 'Client', 'Email', 'Téléphone', 'Prise en charge',
                'Destination', 'Date/Heure', 'Passagers', 'Bagages',
                'Véhicule', 'Prix', 'Statut', 'Créé le'
            ]);

            // CSV data
            foreach ($bookings as $booking) {
                fputcsv($file, [
                    $booking->id,
                    $booking->customer_name,
                    $booking->customer_email,
                    $booking->customer_phone,
                    $booking->pickup_address,
                    $booking->dropoff_address,
                    $booking->pickup_time->format('d/m/Y H:i'),
                    $booking->pax,
                    $booking->luggage,
                    $booking->vehicle?->name,
                    $booking->price ? number_format($booking->price, 2, ',', ' ') . ' €' : '',
                    $booking->status_label,
                    $booking->created_at->format('d/m/Y H:i'),
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
    public function apiShow(Booking $booking)
    {
        return $booking->load('user', 'vehicle');
    }
}
