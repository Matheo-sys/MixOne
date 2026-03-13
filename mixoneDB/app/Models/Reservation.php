<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'studio_id',
        'date',
        'time_slot',
        'number_of_hours',
        'price',
        'status',
        'rating',
        'comment'
    ];

    // Relation avec l'utilisateur
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relation avec le studio
    public function studio()
    {
        return $this->belongsTo(Studio::class);
    }

    public static function getReservations() {
        return self::from('reservations as R')
            ->leftJoin('studios as S', 'S.id', 'R.studio_id')
            ->where('S.user_id', auth()->id())
            ->select('R.*')
            ->orderBy('id', 'desc')
            ->get();
    }


    public static function getReservationArtist() {

        return self::from('reservations as R')
            ->where('user_id', auth()->id())
            ->select('R.*')
            ->orderBy('id', 'desc')
            ->get();
    }
}
