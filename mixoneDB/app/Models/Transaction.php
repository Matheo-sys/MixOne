<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = ['wallet_id', 'type', 'amount', 'status', 'reference_id', 'description'];

    /**
     * Relation avec le portefeuille associé à la transaction.
     */
    public function portefeuille()
    {
        return $this->belongsTo(Wallet::class, 'wallet_id');
    }

}
