<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $fillable = [
        'slug',
        'name',
        'class',
        'capacity_pax',
        'capacity_luggage',
        'base_rate',
        'per_km',
        'per_min',
        'image',
        'photo_path',
        'is_active',
        'description'
    ];

    protected $casts = [
        'base_rate' => 'decimal:2',
        'per_km' => 'decimal:2',
        'per_min' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    /**
     * Get the bookings for the vehicle
     */
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    /**
     * Get the class label in French
     */
    public function getClassLabelAttribute(): string
    {
        return match($this->class ?? 'sedan') {
            'sedan' => 'Berline et S Class',
            'business' => 'Business',
            'van' => 'Van et V Class',
            'eco' => 'Eco',
            'electric' => 'Électrique',
            default => $this->class,
        };
    }

    /**
     * Scope a query to only include active vehicles
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope a query to only include sedan vehicles
     */
    public function scopeSedan($query)
    {
        return $query->where('class', 'sedan');
    }

    /**
     * Scope a query to only include business vehicles
     */
    public function scopeBusiness($query)
    {
        return $query->where('class', 'business');
    }

    /**
     * Scope a query to only include van vehicles
     */
    public function scopeVan($query)
    {
        return $query->where('class', 'van');
    }
}
