<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PayoutRequest extends Model
{
    protected $fillable = [
        'user_id',
        'amount',
        'iban',
        'status',
        'notes',
    ];

    /**
     * Relation avec l'utilisateur ayant fait la demande.
     */
    public function utilisateur()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
