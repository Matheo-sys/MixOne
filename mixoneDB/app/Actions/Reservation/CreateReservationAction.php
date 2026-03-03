<?php

namespace App\Actions\Reservation;

use App\DTOs\ReservationDTO;
use App\Models\Reservation;
use Exception;

class CreateReservationAction
{
    public function execute(ReservationDTO $dto): Reservation
    {
        // Double check availability
        $existingReservation = Reservation::where('studio_id', $dto->studio_id)
            ->where('date', $dto->date)
            ->where('time_slot', $dto->time_slot)
            ->exists();

        if ($existingReservation) {
            throw new Exception('Ce créneau horaire est déjà réservé.');
        }

        return Reservation::create($dto->toArray());
    }
}
