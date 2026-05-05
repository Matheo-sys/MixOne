<?php

namespace App\Policies;

use App\Models\Reservation;
use App\Models\User;

class ReservationPolicy
{
    /**
     * Seul l'artiste ayant fait la réservation peut la noter.
     */
    public function rate(User $user, Reservation $reservation): bool
    {
        return $user->id === $reservation->user_id;
    }

    /**
     * Le studio propriétaire peut confirmer/refuser/compléter.
     */
    public function manageAsStudio(User $user, Reservation $reservation): bool
    {
        return $user->id === ($reservation->studio->user_id ?? null);
    }

    /**
     * L'artiste peut annuler sa propre réservation si les conditions de délai sont respectées.
     */
    public function cancelAsArtist(User $user, Reservation $reservation): bool
    {
        if ($user->id !== $reservation->user_id) {
            return false;
        }

        // Si la réservation est déjà passée ou en cours, interdiction d'annuler
        if ($reservation->status === \App\Enums\ReservationStatus::Completed) {
            return false;
        }

        // Si la réservation est confirmée, on impose un délai de 24h avant le début
        if ($reservation->status === \App\Enums\ReservationStatus::Confirmed) {
            $startTimeString = explode(' - ', $reservation->time_slot)[0];
            $startDateTime = \Carbon\Carbon::parse($reservation->date->format('Y-m-d') . ' ' . $startTimeString);
            
            if (now()->addHours(24)->greaterThan($startDateTime)) {
                return false; // Trop tard pour annuler automatiquement
            }
        }

        return true;
    }
}
