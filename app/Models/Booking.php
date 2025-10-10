<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'user_id','customer_id','customer_name','customer_email','customer_phone',
        'pickup_address','pickup_lat','pickup_lng',
        'dropoff_address','dropoff_lat','dropoff_lng',
        'pickup_time','pax','luggage','vehicle_id',
        'child_seat_count','meet_greet','flight_number',
        'price','currency','status','notes'
    ];

    protected $casts = [
        'pickup_time' => 'datetime',
        'meet_greet' => 'boolean',
    ];

    public function user()     { return $this->belongsTo(User::class); }
    public function customer() { return $this->belongsTo(Customer::class); }
    public function vehicle()  { return $this->belongsTo(Vehicle::class); }
}