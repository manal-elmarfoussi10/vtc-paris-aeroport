<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $fillable = [
        'slug', 'name', 'capacity_pax', 'capacity_luggage',
        'base_rate', 'per_km', 'per_min', 'image', 'is_active',
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}