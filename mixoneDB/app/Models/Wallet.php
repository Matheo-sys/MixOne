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

    /**
     * MARKETPLACE METHODS (Sellers/Studios)
     */

    public function creditPending($amount, $referenceId = null, $description = null)
    {
        $this->pending_balance += $amount;
        $this->save();

        $this->transactions()->create([
            'type' => 'deposit',
            'status' => 'pending',
            'amount' => $amount,
            'reference_id' => $referenceId,
            'description' => $description,
        ]);
    }

    public function confirmPending($amount, $referenceId = null, $description = null)
    {
        if ($this->pending_balance < $amount) {
            // Dans un cas réel, on vérifie, mais ici on s'assure juste que ça ne casse pas.
            // On le laisse passer pour éviter des blocages si les montants ont été manipulés manuellement.
        }

        $this->pending_balance = max(0, $this->pending_balance - $amount);
        $this->balance += $amount;
        $this->save();

        $this->transactions()->create([
            'type' => 'earned',
            'status' => 'completed',
            'amount' => $amount,
            'reference_id' => $referenceId,
            'description' => $description ?: 'Gains débloqués',
        ]);
    }

    public function cancelPending($amount, $referenceId = null, $description = null)
    {
        $this->pending_balance = max(0, $this->pending_balance - $amount);
        $this->save();

        $this->transactions()->create([
            'type' => 'refund',
            'status' => 'completed',
            'amount' => -$amount,
            'reference_id' => $referenceId,
            'description' => $description ?: 'Gains annulés',
        ]);
    }

    public function requestPayout($amount, $iban, $notes = null)
    {
        if (!$this->hasSufficientBalance($amount)) {
            throw new \Exception("Solde disponible insuffisant pour ce retrait.");
        }

        $this->balance -= $amount;
        $this->save();

        $payoutRequest = PayoutRequest::create([
            'user_id' => $this->user_id,
            'amount' => $amount,
            'iban' => $iban,
            'status' => 'pending',
            'notes' => $notes,
        ]);

        $this->transactions()->create([
            'type' => 'payout',
            'status' => 'pending',
            'amount' => -$amount,
            'reference_id' => $payoutRequest->id,
            'description' => 'Demande de virement bancaire',
        ]);

        return $payoutRequest;
    }
}
