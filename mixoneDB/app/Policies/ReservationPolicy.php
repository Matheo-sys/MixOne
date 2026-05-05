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
     * L'artiste peut annuler sa propre réservation.
     */
    public function cancelAsArtist(User $user, Reservation $reservation): bool
    {
        return $user->id === $reservation->user_id;
    }
}
