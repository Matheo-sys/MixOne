<?php

namespace App\Actions\Reservation;

use App\DTOs\ReservationDTO;
use App\Models\Reservation;
use Exception;

use Illuminate\Support\Facades\DB;

class CreateReservationAction
{
    public function execute(ReservationDTO $dto): Reservation
    {
        // Double check availability — ignore cancelled reservations
        $existingReservation = Reservation::where('studio_id', $dto->studio_id)
            ->where('date', $dto->date)
            ->where('time_slot', $dto->time_slot)
            ->whereNotIn('status', ['Annulée'])
            ->exists();

        if ($existingReservation) {
            throw new Exception('Ce créneau horaire est déjà réservé.');
        }

        return DB::transaction(function () use ($dto) {
            $user = auth()->user();
            $wallet = $user->wallet;

            if (!$wallet) {
                // Si l'utilisateur n'a pas de portefeuille, on lui en crée un vide.
                // Dans le cas réel, ça sera fait à l'inscription.
                $wallet = $user->wallet()->create();
            }

            if (!$wallet->hasSufficientBalance($dto->price)) {
                throw new Exception("Solde insuffisant dans votre portefeuille. Veuillez le recharger.");
            }

            $reservation = Reservation::create($dto->toArray());

            // Bloquer les fonds pour cette réservation
            $wallet->hold($dto->price, $reservation->id, 'Réservation du studio N°' . $dto->studio_id);

            return $reservation;
        });
    }
}
