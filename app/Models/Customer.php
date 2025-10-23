<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'user_id',
        'notes',
        'total_bookings',
        'last_booking_at'
    ];

    protected $casts = [
        'last_booking_at' => 'datetime',
    ];

    /**
     * Get the user that owns the customer profile
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the bookings for the customer
     */
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    /**
     * Update the total bookings count
     */
    public function updateBookingStats()
    {
        $this->total_bookings = $this->bookings()->count();
        $this->last_booking_at = $this->bookings()->latest('pickup_time')->first()?->pickup_time;
        $this->save();
    }
}
