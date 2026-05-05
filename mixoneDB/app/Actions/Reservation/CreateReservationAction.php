<?php

namespace App\Actions\Reservation;

use App\DTOs\ReservationDTO;
use App\Enums\ReservationStatus;
use App\Models\Reservation;
use Exception;
use Illuminate\Support\Facades\DB;

class CreateReservationAction
{
    /**
     * Crée une réservation en statut "En attente" avec paiement pending.
     * L'artiste sera ensuite redirigé vers Stripe Checkout.
     */
    public function execute(ReservationDTO $dto): Reservation
    {
        // Vérifier la disponibilité du créneau
        $existingReservation = Reservation::where('studio_id', $dto->studio_id)
            ->where('date', $dto->date)
            ->where('time_slot', $dto->time_slot)
            ->where('status', '!=', ReservationStatus::Cancelled)
            ->exists();

        if ($existingReservation) {
            throw new Exception('Ce créneau horaire est déjà réservé.');
        }

        return DB::transaction(function () use ($dto) {
            return Reservation::create([
                'studio_id'        => $dto->studio_id,
                'user_id'          => $dto->user_id,
                'date'             => $dto->date,
                'time_slot'        => $dto->time_slot,
                'number_of_hours'  => $dto->number_of_hours,
                'price'            => $dto->price,
                'status'           => ReservationStatus::Pending,
                'payment_status'   => 'pending',
                'pin_code'         => str_pad((string)random_int(0, 9999), 4, '0', STR_PAD_LEFT),
            ]);
        });
    }
}
