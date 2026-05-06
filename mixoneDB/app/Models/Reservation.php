<?php

namespace App\Models;

use App\Enums\ReservationStatus;
use App\Enums\PaymentStatus;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
        'payment_status',
        'stripe_session_id',
        'stripe_payment_id',
        'pin_code',
        'disputed_at',
        'dispute_reason',
        'dispute_description',
        'dispute_image',
        'admin_notes',
        'rating',
        'comment'
    ];

    protected function casts(): array
    {
        return [
            'status'         => ReservationStatus::class,
            'payment_status' => PaymentStatus::class,
            'price'          => 'decimal:2',
            'date'           => 'date',
            'disputed_at'    => 'datetime',
        ];
    }

    // ─── Relations ──────────────────────────────────────────────

    public function client(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function studio(): BelongsTo
    {
        return $this->belongsTo(Studio::class);
    }

    // ─── Scopes (recherches personnalisées) ─────────────────────

    /**
     * Réservations de l'artiste (par user_id).
     */
    public function scopePourArtiste(Builder $requete, int $idUtilisateur): Builder
    {
        return $requete->where('user_id', $idUtilisateur)->orderBy('id', 'desc');
    }

    /**
     * Réservations des studios appartenant à un propriétaire donné.
     */
    public function scopePourProprietaireStudio(Builder $requete, int $idProprietaire): Builder
    {
        return $requete->whereHas('studio', fn (Builder $q) => $q->where('user_id', $idProprietaire))
                     ->orderBy('id', 'desc');
    }
}
