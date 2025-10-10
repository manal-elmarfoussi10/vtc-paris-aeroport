<?php

namespace App\Http\Controllers;

use App\Models\Airport;

class AirportController extends Controller
{
    public function index()
    {
        $airports = Airport::where('is_active', true)->get();
        return view('pages.airports.index', compact('airports'));
    }

    public function show(string $slug)
    {
        $airport = Airport::where('slug', $slug)->firstOrFail();
        return view('pages.airports.show', compact('airport'));
    }
}