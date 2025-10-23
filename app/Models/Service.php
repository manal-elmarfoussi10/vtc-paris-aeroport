<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'slug', 'name', 'subtitle', 'description', 'icon', 'order', 'is_active',
    ];
}