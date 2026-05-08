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
        'opening_hours',
        'latitude',
        'longitude',
        'image1',
        'image2',
        'image3',
        'image4',
        'image5',
        'other_equipment',
        'is_verified'
    ];

    protected $casts = [
        'equipment' => 'array',
        'opening_hours' => 'array',
        'is_verified' => 'boolean',
    ];

    /**
     * Relation avec le propriétaire du studio.
     */
    public function proprietaire()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Liste des utilisateurs ayant mis ce studio en favoris.
     */
    public function favorisePar()
    {
        return $this->belongsToMany(User::class, 'wishlists', 'studio_id', 'user_id');
    }

    /**
     * Liste de toutes les réservations du studio.
     */
    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    /**
     * Liste des réservations terminées avec avis.
     */
    public function reservationsTerminees()
    {
        return $this->hasMany(Reservation::class)
            ->whereNotNull('rating')
            ->where('status', \App\Enums\ReservationStatus::Completed);
    }

    /**
     * Alias pour les réservations terminées (avis).
     */
    public function avis()
    {
        return $this->reservationsTerminees();
    }

    /**
     * Calcul de la note moyenne du studio.
     * Accesseur : $studio->note_moyenne
     */
    public function getNoteMoyenneAttribute()
    {
        // Utilise la moyenne chargée via eager loading si disponible
        if (isset($this->attributes['completed_reservations_avg_rating'])) {
            return round((float) $this->attributes['completed_reservations_avg_rating'], 1);
        }
        return round($this->avis()->avg('rating') ?: 0, 1);
    }

    /**
     * Nombre total d'avis.
     * Accesseur : $studio->nombre_avis
     */
    public function getNombreAvisAttribute()
    {
        // Utilise le compte chargé via eager loading si disponible
        if (isset($this->attributes['completed_reservations_count'])) {
            return (int) $this->attributes['completed_reservations_count'];
        }
        return $this->avis()->count();
    }
}

