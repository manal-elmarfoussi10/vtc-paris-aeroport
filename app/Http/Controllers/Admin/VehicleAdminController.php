<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class VehicleAdminController extends Controller
{
    public function index()  { $vehicles = Vehicle::orderBy('name')->get(); return view('admin.vehicles.index', compact('vehicles')); }
    public function create() { return view('admin.vehicles.create'); }
    public function store(Request $r) { /* TODO */ return back()->with('success','Vehicle saved'); }
    public function show(Vehicle $vehicle) { return view('admin.vehicles.show', compact('vehicle')); }
    public function edit(Vehicle $vehicle) { return view('admin.vehicles.edit', compact('vehicle')); }
    public function update(Request $r, Vehicle $vehicle) { /* TODO */ return back()->with('success','Updated'); }
    public function destroy(Vehicle $vehicle) { $vehicle->delete(); return back()->with('success','Deleted'); }
}