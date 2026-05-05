<?php

namespace App\Actions\Reservation;

use App\DTOs\ReservationDTO;
use App\Enums\ReservationStatus;
use App\Enums\PaymentStatus;
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
        // Calculer l'heure de début et de fin de la nouvelle réservation
        $newStart = \Carbon\Carbon::createFromFormat('H:i', $dto->time_slot);
        $newEnd = (clone $newStart)->addHours($dto->number_of_hours);

        // Récupérer les réservations existantes pour ce studio et ce jour (non annulées)
        $existingReservations = Reservation::where('studio_id', $dto->studio_id)
            ->where('date', $dto->date)
            ->whereIn('status', [ReservationStatus::Confirmed, ReservationStatus::Pending, ReservationStatus::Completed])
            ->get();

        foreach ($existingReservations as $res) {
            $resStart = \Carbon\Carbon::createFromFormat('H:i', $res->time_slot);
            $resEnd = (clone $resStart)->addHours($res->number_of_hours);

            // Vérifier s'il y a un chevauchement
            // (StartA < EndB) et (EndA > StartB)
            if ($newStart->lt($resEnd) && $newEnd->gt($resStart)) {
                throw new Exception("Ce créneau horaire chevauche une réservation existante ($res->time_slot pour $res->number_of_hours" . "h).");
            }
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
                'payment_status'   => PaymentStatus::Pending,
                'pin_code'         => str_pad((string)random_int(0, 9999), 4, '0', STR_PAD_LEFT),
            ]);
        });
    }
}
