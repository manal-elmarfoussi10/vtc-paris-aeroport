<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CustomerDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Get upcoming bookings
        $upcomingBookings = $user->bookings()
            ->upcoming()
            ->limit(5)
            ->get();

        // Get recent bookings
        $recentBookings = $user->bookings()
            ->past()
            ->limit(5)
            ->get();

        // Get customer stats
        $customer = $user->customer;
        $stats = [
            'total_bookings' => $customer?->total_bookings ?? 0,
            'last_booking' => $customer?->last_booking_at,
        ];

        return view('customer.dashboard', compact('upcomingBookings', 'recentBookings', 'stats'));
    }

    public function bookings(Request $request)
    {
        $query = auth()->user()->bookings()->with('vehicle');

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by date range
        if ($request->filled('date_from')) {
            $query->whereDate('pickup_time', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('pickup_time', '<=', $request->date_to);
        }

        $bookings = $query->latest()->paginate(20);

        return view('customer.bookings.index', compact('bookings'));
    }

    public function show($id)
    {
        $booking = auth()->user()->bookings()
            ->with('vehicle')
            ->findOrFail($id);

        return view('customer.bookings.show', compact('booking'));
    }

    public function cancel(Request $request, $id)
    {
        $booking = auth()->user()->bookings()->findOrFail($id);

        // Check if booking can be cancelled
        if (!$booking->canBeCancelled()) {
            return back()->withErrors(['booking' => 'Cette réservation ne peut pas être annulée.']);
        }

        try {
            DB::beginTransaction();

            $booking->update(['status' => 'cancelled']);

            // Update customer stats
            if ($booking->customer) {
                $booking->customer->updateBookingStats();
            }

            DB::commit();

            return back()->with('success', 'Votre réservation a été annulée avec succès.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['booking' => 'Une erreur est survenue lors de l\'annulation.']);
        }
    }
}
