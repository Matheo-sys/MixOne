<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    protected $fillable = ['user_id', 'balance', 'pending_balance'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function hasSufficientBalance($amount)
    {
        return $this->balance >= $amount;
    }

    public function deposit($amount, $description = null)
    {
        $this->balance += $amount;
        $this->save();

        $this->transactions()->create([
            'type' => 'deposit',
            'amount' => $amount,
            'description' => $description,
        ]);
    }

    public function hold($amount, $referenceId = null, $description = null)
    {
        if (!$this->hasSufficientBalance($amount)) {
            throw new \Exception("Solde insuffisant.");
        }

        $this->balance -= $amount;
        $this->pending_balance += $amount;
        $this->save();

        $this->transactions()->create([
            'type' => 'payment',
            'status' => 'pending',
            'amount' => -$amount,
            'reference_id' => $referenceId,
            'description' => $description,
        ]);
    }

    public function refund($amount, $referenceId = null, $description = null)
    {
        $this->pending_balance -= $amount;
        $this->balance += $amount;
        $this->save();

        $this->transactions()->create([
            'type' => 'refund',
            'amount' => $amount,
            'reference_id' => $referenceId,
            'description' => $description,
        ]);
    }

    public function earned($amount, $referenceId = null, $description = null)
    {
        $this->balance += $amount;
        $this->save();

        $this->transactions()->create([
            'type' => 'earned',
            'amount' => $amount,
            'reference_id' => $referenceId,
            'description' => $description,
        ]);
    }
}
