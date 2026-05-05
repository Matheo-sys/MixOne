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
        ];
    }

    // ─── Relations ──────────────────────────────────────────────

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function studio(): BelongsTo
    {
        return $this->belongsTo(Studio::class);
    }

    // ─── Scopes (remplacent les méthodes statiques) ─────────────

    /**
     * Réservations de l'artiste (par user_id).
     */
    public function scopeForArtist(Builder $query, int $userId): Builder
    {
        return $query->where('user_id', $userId)->orderBy('id', 'desc');
    }

    /**
     * Réservations des studios appartenant à un propriétaire donné.
     */
    public function scopeForStudioOwner(Builder $query, int $ownerId): Builder
    {
        return $query->whereHas('studio', fn (Builder $q) => $q->where('user_id', $ownerId))
                     ->orderBy('id', 'desc');
    }
}
