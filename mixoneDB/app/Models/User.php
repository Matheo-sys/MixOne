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

    public function wallet()
    {
        return $this->hasOne(Wallet::class);
    }

    public function wishlists()
    {
        return $this->hasMany(Wishlist::class);
    }

    public function favoriteStudios()
    {
        return $this->belongsToMany(Studio::class, 'wishlists', 'user_id', 'studio_id');
    }
}
