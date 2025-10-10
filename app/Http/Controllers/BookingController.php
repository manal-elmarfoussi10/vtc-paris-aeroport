<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
    {
        return view('pages.booking');
    }

    public function store(Request $request)
    {
        // TODO: validate & create Booking
        return back()->with('success', 'Votre demande a été envoyée.');
    }
}