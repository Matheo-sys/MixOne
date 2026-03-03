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
        'equipment',
        'latitude',
        'longitude',
        'image1',
        'image2',
        'image3',
        'image4'
    ];

    protected $casts = [
        'equipment' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function favoritedBy()
    {
        return $this->belongsToMany(User::class, 'wishlists', 'studio_id', 'user_id');
    }
}
