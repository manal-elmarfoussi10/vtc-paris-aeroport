<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Today's stats
        $today = Carbon::today();
        $weekStart = Carbon::now()->startOfWeek();
        $weekEnd = Carbon::now()->endOfWeek();

        $stats = [
            'today_bookings' => Booking::whereDate('pickup_time', $today)->count(),
            'today_revenue' => Booking::whereDate('pickup_time', $today)
                ->whereNotNull('price')
                ->sum('price'),
            'week_bookings' => Booking::whereBetween('pickup_time', [$weekStart, $weekEnd])->count(),
            'total_customers' => User::where('role', 'customer')->count(),
            'pending_bookings' => Booking::where('status', 'new')->count(),
        ];

        // Upcoming pickups (next 24 hours)
        $upcomingPickups = Booking::with('user', 'vehicle')
            ->where('status', 'confirmed')
            ->where('pickup_time', '>', now())
            ->where('pickup_time', '<', now()->addDay())
            ->orderBy('pickup_time')
            ->limit(10)
            ->get();

        // Recent bookings
        $recentBookings = Booking::with('user', 'vehicle')
            ->latest()
            ->limit(10)
            ->get();

        return view('admin.dashboard', compact('stats', 'upcomingPickups', 'recentBookings'));
    }

    public function calendar()
    {
        // Get bookings for calendar (current month + some buffer)
        $start = Carbon::now()->startOfMonth()->subDays(7);
        $end = Carbon::now()->endOfMonth()->addDays(7);

        $bookings = Booking::with('user', 'vehicle')
            ->whereBetween('pickup_time', [$start, $end])
            ->whereIn('status', ['new', 'confirmed'])
            ->get()
            ->map(function ($booking) {
                return [
                    'id' => $booking->id,
                    'title' => $booking->customer_name . ' - ' . $booking->vehicle->name,
                    'start' => $booking->pickup_time->toISOString(),
                    'end' => $booking->pickup_time->copy()->addMinutes(60)->toISOString(), // Assume 1 hour duration
                    'backgroundColor' => $booking->status === 'confirmed' ? '#10B981' : '#F59E0B',
                    'borderColor' => $booking->status === 'confirmed' ? '#059669' : '#D97706',
                    'url' => route('admin.bookings.show', $booking),
                ];
            });

        return view('admin.calendar', compact('bookings'));
    }
}
