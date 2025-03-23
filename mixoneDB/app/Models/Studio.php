<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Studio extends Model
{
    protected $table = 'studios';
    protected $fillable = [
        'user_id',
        'name',
        'address',
        'zipcode',
        'city',
        'country',
        'hourly_rate',
        'min_hours',
        'description',
        'latitude',
        'longitude',
        'image1',
        'image2',
        'image3',
        'image4'
    ];

    public function favoritedBy()
    {
        return $this->belongsToMany(User::class, 'wishlists', 'studio_id', 'user_id');
    }
}
