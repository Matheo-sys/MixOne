<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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
        return DB::transaction(function () use ($amount, $description) {
            $this->lockForUpdate();
            $this->balance += $amount;
            $this->save();

            $this->transactions()->create([
                'type' => 'deposit',
                'amount' => $amount,
                'description' => $description,
            ]);
        });
    }

    public function hold($amount, $referenceId = null, $description = null)
    {
        return DB::transaction(function () use ($amount, $referenceId, $description) {
            $this->lockForUpdate();

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
        });
    }

    public function refund($amount, $referenceId = null, $description = null)
    {
        return DB::transaction(function () use ($amount, $referenceId, $description) {
            $this->lockForUpdate();
            $this->pending_balance -= $amount;
            $this->balance += $amount;
            $this->save();

            $this->transactions()->create([
                'type' => 'refund',
                'amount' => $amount,
                'reference_id' => $referenceId,
                'description' => $description,
            ]);
        });
    }

    public function earned($amount, $referenceId = null, $description = null)
    {
        return DB::transaction(function () use ($amount, $referenceId, $description) {
            $this->lockForUpdate();
            $this->balance += $amount;
            $this->save();

            $this->transactions()->create([
                'type' => 'earned',
                'amount' => $amount,
                'reference_id' => $referenceId,
                'description' => $description,
            ]);
        });
    }

    /**
     * MARKETPLACE METHODS (Sellers/Studios)
     */

    public function creditPending($amount, $referenceId = null, $description = null)
    {
        return DB::transaction(function () use ($amount, $referenceId, $description) {
            $this->lockForUpdate();
            $this->pending_balance += $amount;
            $this->save();

            $this->transactions()->create([
                'type' => 'deposit',
                'status' => 'pending',
                'amount' => $amount,
                'reference_id' => $referenceId,
                'description' => $description,
            ]);
        });
    }

    public function confirmPending($amount, $referenceId = null, $description = null)
    {
        return DB::transaction(function () use ($amount, $referenceId, $description) {
            $this->lockForUpdate();

            if ($this->pending_balance < $amount) {
                Log::warning('confirmPending : montant demandé supérieur au pending_balance', [
                    'wallet_id' => $this->id,
                    'requested' => $amount,
                    'pending' => $this->pending_balance,
                ]);
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
        });
    }

    public function cancelPending($amount, $referenceId = null, $description = null)
    {
        return DB::transaction(function () use ($amount, $referenceId, $description) {
            $this->lockForUpdate();
            $this->pending_balance = max(0, $this->pending_balance - $amount);
            $this->save();

            $this->transactions()->create([
                'type' => 'refund',
                'status' => 'completed',
                'amount' => -$amount,
                'reference_id' => $referenceId,
                'description' => $description ?: 'Gains annulés',
            ]);
        });
    }

    public function requestPayout($amount, $iban, $notes = null)
    {
        return DB::transaction(function () use ($amount, $iban, $notes) {
            $this->lockForUpdate();

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
        });
    }
}
