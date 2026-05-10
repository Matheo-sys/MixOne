<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'uuid',
        'username',
        'last_name',
        'first_name',
        'email',
        'phone',
        'birth_date',
        'about',
        'avatar',
        'address_line1',
        'address_line2',
        'city',
        'state',
        'country',
        'zipcode',
        'banned_at',
        'bank_name',
        'iban',
        'bic',
        'profile',
        'is_admin',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'banned_at' => 'datetime',
            'is_admin' => 'boolean',
        ];
    }

    protected static function booted()
    {
        static::creating(function ($user) {
            if (empty($user->uuid)) {
                $user->uuid = (string) \Illuminate\Support\Str::uuid();
            }
        });
    }

    public function getRouteKeyName()
    {
        return 'uuid';
    }

    /**
     * Relation avec le portefeuille de l'utilisateur.
     */
    public function portefeuille()
    {
        return $this->hasOne(Wallet::class);
    }

    /**
     * Relation avec les listes de souhaits de l'utilisateur.
     */
    public function listesDeSouhaits()
    {
        return $this->hasMany(Wishlist::class);
    }

    /**
     * Liste des studios mis en favoris par l'utilisateur.
     */
    public function studiosFavoris()
    {
        return $this->belongsToMany(Studio::class, 'wishlists', 'user_id', 'studio_id');
    }

    public function sendEmailVerificationNotification()
    {
        try {
            // On utilise notre version "Queued" pour ne pas bloquer l'inscription
            $this->notify(new \App\Notifications\VerifyEmailQueued);
        } catch (\Throwable $e) {
            // Si ça échoue, on ne bloque surtout pas l'inscription
            \Illuminate\Support\Facades\Log::error("Erreur envoi mail vérification: " . $e->getMessage());
        }
    }

}
