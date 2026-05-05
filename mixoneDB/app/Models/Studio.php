<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Studio extends Model
{
    use HasFactory;

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
        'image4',
        'is_verified'
    ];

    protected $casts = [
        'equipment' => 'array',
        'is_verified' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function favoritedBy()
    {
        return $this->belongsToMany(User::class, 'wishlists', 'studio_id', 'user_id');
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    public function completedReservations()
    {
        return $this->hasMany(Reservation::class)
            ->whereNotNull('rating')
            ->where('status', \App\Enums\ReservationStatus::Completed);
    }

    public function reviews()
    {
        return $this->completedReservations();
    }

    public function getAverageRatingAttribute()
    {
        // Use eager loaded average if available
        if (isset($this->attributes['completed_reservations_avg_rating'])) {
            return round((float) $this->attributes['completed_reservations_avg_rating'], 1);
        }
        return round($this->reviews()->avg('rating') ?: 0, 1);
    }

    public function getReviewsCountAttribute()
    {
        // Use eager loaded count if available
        if (isset($this->attributes['completed_reservations_count'])) {
            return (int) $this->attributes['completed_reservations_count'];
        }
        return $this->reviews()->count();
    }
}
