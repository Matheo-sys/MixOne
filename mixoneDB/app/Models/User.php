<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

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
        'stripe_account_id',
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
                $user->uuid = (string) Str::uuid();
            }

            // Auto-générer un username si non fourni
            if (empty($user->username)) {
                $user->username = static::generateUniqueUsername(
                    $user->first_name,
                    $user->last_name
                );
            }
        });
    }

    /**
     * Génère un username unique basé sur prénom.nom.
     * Ex: "jean.dupont", "jean.dupont1", "jean.dupont2"
     */
    public static function generateUniqueUsername(string $firstName, string $lastName): string
    {
        $base = Str::slug($firstName . '.' . $lastName, '.');
        $base = preg_replace('/[^a-z0-9._]/', '', strtolower($base));

        if (strlen($base) < 3) {
            $base = 'user' . Str::random(4);
        }

        $base = substr($base, 0, 30);
        $username = $base;
        $counter = 1;

        while (static::where('username', $username)->exists()) {
            $suffix = (string) $counter;
            $username = substr($base, 0, 30 - strlen($suffix)) . $suffix;
            $counter++;
        }

        return $username;
    }

    /**
     * Retourne l'identité affichable : @username ou Prénom Nom en fallback.
     */
    public function getDisplayIdentityAttribute(): string
    {
        if (!empty($this->username)) {
            return '@' . $this->username;
        }

        return trim($this->first_name . ' ' . $this->last_name) ?: 'Utilisateur';
    }

    /**
     * Retourne l'URL de l'avatar ou l'avatar par défaut.
     */
    public function getAvatarUrlAttribute(): string
    {
        if ($this->avatar) {
            return function_exists('storage_url')
                ? storage_url($this->avatar)
                : asset('storage/' . $this->avatar);
        }

        return asset('media/img/misc/avatar-default.png');
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
     * Liste des studios possédés par l'utilisateur.
     */
    public function studios()
    {
        return $this->hasMany(Studio::class);
    }

    /**
     * Liste des réservations effectuées par l'utilisateur (en tant qu'artiste).
     */
    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    /**
     * Liste des réservations reçues par l'utilisateur (via ses studios).
     */
    public function reservationsRecues()
    {
        return $this->hasManyThrough(Reservation::class, Studio::class);
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

    /**
     * Envoyer la notification de réinitialisation de mot de passe.
     */
    public function sendPasswordResetNotification($token)
    {
        try {
            $this->notify(new \App\Notifications\ResetPasswordQueued($token));
        } catch (\Throwable $e) {
            \Illuminate\Support\Facades\Log::error("Erreur envoi mail reset password: " . $e->getMessage());
        }
    }
}
