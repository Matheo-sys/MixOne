<?php

namespace App\Actions\Reservation;

use App\Models\Reservation;
use Exception;

class UpdateReservationStatusAction
{
    public function execute(Reservation $reservation, string $status): bool
    {
        // Basic business rule: can only update from 'En attente'
        if ($reservation->status !== 'en attente' && $reservation->status !== 'En attente') {
             throw new Exception('Action non autorisée sur une réservation avec le statut : ' . $reservation->status);
        }

        return $reservation->update(['status' => $status]);
    }
}
