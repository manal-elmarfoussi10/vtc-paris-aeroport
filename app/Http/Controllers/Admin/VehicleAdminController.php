<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class VehicleAdminController extends Controller
{
    public function index()
    {
        $vehicles = Vehicle::orderBy('class')->orderBy('name')->get();
        return view('admin.vehicles.index', compact('vehicles'));
    }

    public function create()
    {
        return view('admin.vehicles.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'class' => 'required|in:sedan,business,van,berline,suv,luxury',
            'capacity_pax' => 'required|integer|min:1|max:8',
            'capacity_luggage' => 'required|integer|min:0|max:8',
            'base_rate' => 'required|numeric|min:0',
            'per_km' => 'nullable|numeric|min:0',
            'per_min' => 'nullable|numeric|min:0',
            'description' => 'nullable|string|max:1000',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_active' => 'nullable|boolean',
        ]);

        // Handle photo upload
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('vehicles', 'public');
            $validated['photo_path'] = $photoPath;
        }

        $validated['is_active'] = $request->boolean('is_active', true);

        // Generate slug from name
        $validated['slug'] = Str::slug($validated['name']);

        Vehicle::create($validated);

        return redirect()->route('admin.vehicles.index')
                        ->with('success', 'Véhicule créé avec succès.');
    }

    public function show(Vehicle $vehicle)
    {
        return view('admin.vehicles.show', compact('vehicle'));
    }

    public function edit(Vehicle $vehicle)
    {
        return view('admin.vehicles.edit', compact('vehicle'));
    }

    public function update(Request $request, Vehicle $vehicle)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'class' => 'required|in:sedan,business,van,berline,suv,luxury',
            'capacity_pax' => 'required|integer|min:1|max:8',
            'capacity_luggage' => 'required|integer|min:0|max:8',
            'base_rate' => 'required|numeric|min:0',
            'per_km' => 'nullable|numeric|min:0',
            'per_min' => 'nullable|numeric|min:0',
            'description' => 'nullable|string|max:1000',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_active' => 'nullable|boolean',
        ]);

        // Handle photo upload
        if ($request->hasFile('photo')) {
            // Delete old photo if exists
            if ($vehicle->photo_path && Storage::disk('public')->exists($vehicle->photo_path)) {
                Storage::disk('public')->delete($vehicle->photo_path);
            }

            $photoPath = $request->file('photo')->store('vehicles', 'public');
            $validated['photo_path'] = $photoPath;
        }

        $validated['is_active'] = $request->boolean('is_active', true);

        // Generate slug from name if name is being updated
        if (isset($validated['name'])) {
            $validated['slug'] = Str::slug($validated['name']);
        }

        $vehicle->update($validated);

        return redirect()->route('admin.vehicles.show', $vehicle)
                        ->with('success', 'Véhicule mis à jour avec succès.');
    }

    public function destroy(Vehicle $vehicle)
    {
        // Check if vehicle has active bookings
        $activeBookings = $vehicle->bookings()
            ->whereIn('status', ['new', 'confirmed'])
            ->where('pickup_time', '>', now())
            ->count();

        if ($activeBookings > 0) {
            return back()->withErrors([
                'vehicle' => 'Impossible de supprimer ce véhicule car il a des réservations actives.'
            ]);
        }

        // Delete photo if exists
        if ($vehicle->photo_path && Storage::disk('public')->exists($vehicle->photo_path)) {
            Storage::disk('public')->delete($vehicle->photo_path);
        }

        $vehicle->delete();

        return redirect()->route('admin.vehicles.index')
                        ->with('success', 'Véhicule supprimé avec succès.');
    }

    public function toggleActive(Vehicle $vehicle)
    {
        $vehicle->update(['is_active' => !$vehicle->is_active]);

        $status = $vehicle->is_active ? 'activé' : 'désactivé';

        return back()->with('success', "Véhicule {$status} avec succès.");
    }

    public function apiIndex()
    {
        return Vehicle::select('id', 'name')->get();
    }
}
