<?php

namespace App\Actions\Reservation;

use App\Models\Reservation;
use Exception;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;

class UpdateReservationStatusAction
{
    /**
     * Transitions autorisées :
     * - "En attente" → "Confirmée"  (studio confirme)
     * - "En attente" → "Refusée"    (studio refuse)
     * - "En attente" → "Annulée"    (artiste annule)
     * - "Confirmée"  → "Annulée"    (studio annule après confirmation, ou artiste demande annulation)
     * - "Confirmée"  → "Terminée"   (studio marque comme terminée après la session)
     */
    private const ALLOWED_TRANSITIONS = [
        'En attente' => ['Confirmée', 'Refusée', 'Annulée'],
        'Confirmée'  => ['Annulée', 'Terminée'],
    ];

    public function execute(Reservation $reservation, string $newStatus, string $role = 'studio'): bool
    {
        // Normaliser les statuts pour la recherche dans les transitions autorisées (multi-byte safe)
        $currentStatus = \Illuminate\Support\Str::ucfirst(\Illuminate\Support\Str::lower($reservation->status));
        $newStatusNormalized = \Illuminate\Support\Str::ucfirst(\Illuminate\Support\Str::lower($newStatus));
        
        $allowed = self::ALLOWED_TRANSITIONS[$currentStatus] ?? [];

        if (!in_array($newStatusNormalized, $allowed)) {
            throw new Exception("Impossible de passer de « {$currentStatus} » à « {$newStatusNormalized} ».");
        }

        // Utiliser le statut normalisé pour la suite
        $newStatus = $newStatusNormalized;

        // Vérification de propriété
        $user = Auth::user();

        if ($role === 'artist') {
            // L'artiste ne peut annuler que SES réservations
            if ($reservation->user_id !== $user->id) {
                throw new Exception("Vous n'êtes pas autorisé à modifier cette réservation.");
            }
            // L'artiste ne peut qu'annuler
            if ($newStatus !== 'Annulée') {
                throw new Exception("Action non autorisée.");
            }
        } else {
            // Le studio ne peut agir que sur les réservations de SES studios
            $studioOwnerId = $reservation->studio->user_id ?? null;
            if ($studioOwnerId !== $user->id) {
                throw new Exception("Vous n'êtes pas autorisé à modifier cette réservation.");
            }
        }

        return DB::transaction(function () use ($reservation, $newStatus) {
            $artistWallet = $reservation->user->wallet;
            $studioWallet = $reservation->studio->user->wallet;
            
            // Gestion de l'argent selon le nouveau statut
            if (in_array($newStatus, ['Annulée', 'Refusée'])) {
                // Rembourser l'artiste de son pending_balance
                if ($artistWallet) {
                    $artistWallet->refund($reservation->price, $reservation->id, 'Remboursement pour la réservation N°' . $reservation->id . ' (' . $newStatus . ')');
                }
            } elseif ($newStatus === 'Terminée') {
                // Créer le portefeuille studio s'il n'existe pas
                if (!$studioWallet) {
                    $studioWallet = $reservation->studio->user->wallet()->create();
                }
                
                // Déduire du pending de l'artiste
                if ($artistWallet) {
                    $artistWallet->pending_balance -= $reservation->price;
                    $artistWallet->save();
                    
                    // On pourrait aussi ajouter une ligne 'release' pour l'artiste, mais on passe par 'payment' déjà
                }

                // Créditer le studio
                $studioWallet->earned($reservation->price, $reservation->id, 'Gains pour la session N°' . $reservation->id);
            }

            return $reservation->update(['status' => $newStatus]);
        });
    }
}
