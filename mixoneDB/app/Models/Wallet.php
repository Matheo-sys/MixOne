<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class Wallet extends Model
{
    protected $fillable = ['user_id', 'balance', 'pending_balance'];

    /**
     * Relation avec l'utilisateur possédant le portefeuille.
     */
    public function utilisateur()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Historique des transactions du portefeuille.
     */
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    /**
     * Vérifie si le solde disponible est suffisant.
     */
    public function aUnSoldeSuffisant($montant)
    {
        return $this->balance >= $montant;
    }

    /**
     * Ajoute des fonds au solde disponible.
     */
    public function deposer($montant, $description = null)
    {
        return DB::transaction(function () use ($montant, $description) {
            $this->lockForUpdate();
            $this->balance += $montant;
            $this->save();

            $this->transactions()->create([
                'type' => 'deposit',
                'amount' => $montant,
                'description' => $description,
            ]);
        });
    }

    /**
     * Met des fonds en réserve (séquestre).
     */
    public function bloquer($montant, $referenceId = null, $description = null)
    {
        return DB::transaction(function () use ($montant, $referenceId, $description) {
            $this->lockForUpdate();

            if (!$this->aUnSoldeSuffisant($montant)) {
                throw new \Exception("Solde insuffisant.");
            }

            $this->balance -= $montant;
            $this->pending_balance += $montant;
            $this->save();

            $this->transactions()->create([
                'type' => 'payment',
                'status' => 'pending',
                'amount' => -$montant,
                'reference_id' => $referenceId,
                'description' => $description,
            ]);
        });
    }

    /**
     * Rembourse des fonds bloqués vers le solde disponible.
     */
    public function rembourser($montant, $referenceId = null, $description = null)
    {
        return DB::transaction(function () use ($montant, $referenceId, $description) {
            $this->lockForUpdate();
            $this->pending_balance -= $montant;
            $this->balance += $montant;
            $this->save();

            $this->transactions()->create([
                'type' => 'refund',
                'amount' => $montant,
                'reference_id' => $referenceId,
                'description' => $description,
            ]);
        });
    }

    /**
     * Encaisse des fonds directement.
     */
    public function encaisser($montant, $referenceId = null, $description = null)
    {
        return DB::transaction(function () use ($montant, $referenceId, $description) {
            $this->lockForUpdate();
            $this->balance += $montant;
            $this->save();

            $this->transactions()->create([
                'type' => 'earned',
                'amount' => $montant,
                'reference_id' => $referenceId,
                'description' => $description,
            ]);
        });
    }

    /**
     * MÉTHODES PLACE DE MARCHÉ (Vendeurs/Studios)
     */

    /**
     * Crédite des gains futurs (en attente).
     */
    public function crediterEnAttente($montant, $referenceId = null, $description = null)
    {
        return DB::transaction(function () use ($montant, $referenceId, $description) {
            $this->lockForUpdate();
            $this->pending_balance += $montant;
            $this->save();

            $this->transactions()->create([
                'type' => 'deposit',
                'status' => 'pending',
                'amount' => $montant,
                'reference_id' => $referenceId,
                'description' => $description,
            ]);
        });
    }

    /**
     * Débloque les gains en attente vers le solde disponible.
     */
    public function confirmerEnAttente($montant, $referenceId = null, $description = null)
    {
        return DB::transaction(function () use ($montant, $referenceId, $description) {
            $this->lockForUpdate();

            if ($this->pending_balance < $montant) {
                Log::warning('confirmerEnAttente : montant demandé supérieur au pending_balance', [
                    'portefeuille_id' => $this->id,
                    'requested' => $montant,
                    'pending' => $this->pending_balance,
                ]);
            }

            $this->pending_balance = max(0, $this->pending_balance - $montant);
            $this->balance += $montant;
            $this->save();

            $this->transactions()->create([
                'type' => 'earned',
                'status' => 'completed',
                'amount' => $montant,
                'reference_id' => $referenceId,
                'description' => $description ?: 'Gains débloqués',
            ]);
        });
    }

    /**
     * Annule des gains en attente (ex: remboursement client).
     */
    public function annulerEnAttente($montant, $referenceId = null, $description = null)
    {
        return DB::transaction(function () use ($montant, $referenceId, $description) {
            $this->lockForUpdate();
            $this->pending_balance = max(0, $this->pending_balance - $montant);
            $this->save();

            $this->transactions()->create([
                'type' => 'refund',
                'status' => 'completed',
                'amount' => -$montant,
                'reference_id' => $referenceId,
                'description' => $description ?: 'Gains annulés',
            ]);
        });
    }

    /**
     * Crée une demande de virement bancaire.
     */
    public function demanderVirement($montant, $iban, $notes = null)
    {
        return DB::transaction(function () use ($montant, $iban, $notes) {
            $this->lockForUpdate();

            if (!$this->aUnSoldeSuffisant($montant)) {
                throw new \Exception("Solde disponible insuffisant pour ce retrait.");
            }

            $this->balance -= $montant;
            $this->save();

            $payoutRequest = PayoutRequest::create([
                'user_id' => $this->user_id,
                'amount' => $montant,
                'iban' => $iban,
                'status' => 'pending',
                'notes' => $notes,
            ]);

            $this->transactions()->create([
                'type' => 'payout',
                'status' => 'pending',
                'amount' => -$montant,
                'reference_id' => $payoutRequest->id,
                'description' => 'Demande de virement bancaire',
            ]);

            return $payoutRequest;
        });
    }
}

