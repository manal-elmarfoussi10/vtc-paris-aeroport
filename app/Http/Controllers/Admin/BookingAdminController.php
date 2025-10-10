<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class BookingAdminController extends Controller
{
    public function index()  { $bookings = Booking::latest()->paginate(20); return view('admin.bookings.index', compact('bookings')); }
    public function create() { return view('admin.bookings.create'); }
    public function store(Request $r) { /* TODO */ return back()->with('success', 'Booking created'); }
    public function show(Booking $booking) { return view('admin.bookings.show', compact('booking')); }
    public function edit(Booking $booking) { return view('admin.bookings.edit', compact('booking')); }
    public function update(Request $r, Booking $booking) { /* TODO */ return back()->with('success','Updated'); }
    public function destroy(Booking $booking) { $booking->delete(); return back()->with('success','Deleted'); }
}