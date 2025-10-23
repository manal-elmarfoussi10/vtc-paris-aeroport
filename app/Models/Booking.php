<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Booking extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'customer_id',
        'customer_name',
        'customer_email',
        'customer_phone',
        'pickup_address',
        'pickup_lat',
        'pickup_lng',
        'dropoff_address',
        'dropoff_lat',
        'dropoff_lng',
        'pickup_time',
        'pax',
        'luggage',
        'vehicle_id',
        'child_seat_count',
        'meet_greet',
        'flight_number',
        'price',
        'currency',
        'status',
        'notes'
    ];

    protected $casts = [
        'pickup_time' => 'datetime',
        'meet_greet' => 'boolean',
    ];

    /**
     * Get the user that owns the booking
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the customer that owns the booking
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * Get the vehicle for the booking
     */
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    /**
     * Scope a query to only include new bookings
     */
    public function scopeNew($query)
    {
        return $query->where('status', 'new');
    }

    /**
     * Scope a query to only include confirmed bookings
     */
    public function scopeConfirmed($query)
    {
        return $query->where('status', 'confirmed');
    }

    /**
     * Scope a query to only include completed bookings
     */
    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    /**
     * Scope a query to only include cancelled bookings
     */
    public function scopeCancelled($query)
    {
        return $query->where('status', 'cancelled');
    }

    /**
     * Scope a query to only include upcoming bookings
     */
    public function scopeUpcoming($query)
    {
        return $query->where('pickup_time', '>', now())
                    ->whereIn('status', ['new', 'confirmed'])
                    ->orderBy('pickup_time', 'asc');
    }

    /**
     * Scope a query to only include past bookings
     */
    public function scopePast($query)
    {
        return $query->where('pickup_time', '<', now())
                    ->orderBy('pickup_time', 'desc');
    }

    /**
     * Get the status badge color
     */
    public function getStatusColorAttribute(): string
    {
        return match($this->status) {
            'new' => 'blue',
            'confirmed' => 'green',
            'completed' => 'gray',
            'cancelled' => 'red',
            default => 'gray',
        };
    }

    /**
     * Get the status label in French
     */
    public function getStatusLabelAttribute(): string
    {
        return match($this->status) {
            'new' => 'Nouvelle',
            'confirmed' => 'Confirmée',
            'completed' => 'Terminée',
            'cancelled' => 'Annulée',
            default => 'Inconnue',
        };
    }

    /**
     * Check if booking can be cancelled
     */
    public function canBeCancelled(): bool
    {
        // Can cancel if status is new or confirmed and pickup is more than 24h away
        return in_array($this->status, ['new', 'confirmed']) 
            && $this->pickup_time->isFuture() 
            && $this->pickup_time->diffInHours(now()) > 24;
    }
}
