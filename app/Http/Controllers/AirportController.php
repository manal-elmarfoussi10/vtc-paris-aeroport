<?php

namespace App\Http\Controllers;

use App\Models\Airport;
use App\Models\Setting;

class AirportController extends Controller
{
    public function index()
    {
        $airports = Airport::where('is_active', true)
                          ->orderBy('name')
                          ->get();

        return view('airports.index', compact('airports'));
    }

    public function show(string $slug)
    {
        $airport = Airport::where('slug', $slug)
                         ->where('is_active', true)
                         ->firstOrFail();

        // Get airport-specific pricing and wait rules
        $airportWaitRules = Setting::get('airport_wait_rules_json');
        $pricingRules = Setting::get('pricing_rules_json');

        // Parse JSON settings
        $waitRules = $airportWaitRules ? json_decode($airportWaitRules, true) : [];
        $pricing = $pricingRules ? json_decode($pricingRules, true) : [];

        // Get airport-specific data
        $airportWaitTime = $waitRules[$airport->code] ?? $airport->default_wait_time ?? 60;
        $airportPricing = $pricing[$airport->code] ?? null;

        return view('airports.show', compact('airport', 'airportWaitTime', 'airportPricing'));
    }
}
