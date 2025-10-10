<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Airport extends Model
{
    protected $fillable = [
        'slug', 'code', 'name', 'seo_title', 'seo_text', 'base_rate_to_paris', 'is_active',
    ];
}