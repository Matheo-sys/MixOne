<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Studio extends Model
{
    protected $table = 'studios';
    protected $fillable = [
        'user_id',
        'name',
        'description',
        'video_url',
        'address',
        'zipcode',
        'city',
        'country',
        'hourly_rate',
        'min_hours'
    ];
}
