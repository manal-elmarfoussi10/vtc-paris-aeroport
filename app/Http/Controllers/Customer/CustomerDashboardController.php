<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CustomerDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $bookings = $user->bookings()->latest()->limit(10)->get();
        return view('customer.dashboard', compact('bookings'));
    }

    public function bookings()
    {
        $bookings = auth()->user()->bookings()->latest()->paginate(20);
        return view('customer.bookings.index', compact('bookings'));
    }

    public function show($id)
    {
        $booking = auth()->user()->bookings()->findOrFail($id);
        return view('customer.bookings.show', compact('booking'));
    }
}