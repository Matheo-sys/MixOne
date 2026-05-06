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
     * Crée une réservation en statut "En attente" avec paiement en attente.
     * L'artiste sera ensuite redirigé vers Stripe Checkout.
     *
     * @param ReservationDTO $dto
     * @return Reservation
     * @throws Exception
     */
    public function executer(ReservationDTO $dto): Reservation
    {
        // Calculer l'heure de début et de fin de la nouvelle réservation
        $debutNouveau = \Carbon\Carbon::createFromFormat('H:i', $dto->creneau_horaire);
        $finNouveau = (clone $debutNouveau)->addHours($dto->nombre_heures);

        // Récupérer les réservations existantes pour ce studio et ce jour (non annulées)
        $reservationsExistantes = Reservation::where('studio_id', $dto->id_studio)
            ->where('date', $dto->date)
            ->whereIn('status', [ReservationStatus::Confirmed, ReservationStatus::Pending, ReservationStatus::Completed])
            ->get();

        foreach ($reservationsExistantes as $res) {
            $debutRes = \Carbon\Carbon::createFromFormat('H:i', $res->time_slot);
            $finRes = (clone $debutRes)->addHours($res->number_of_hours);

            // Vérifier s'il y a un chevauchement
            if ($debutNouveau->lt($finRes) && $finNouveau->gt($debutRes)) {
                throw new Exception("Ce créneau horaire chevauche une réservation existante ({$res->time_slot} pour {$res->number_of_hours}h).");
            }
        }

        return DB::transaction(function () use ($dto) {
            return Reservation::create([
                'studio_id'        => $dto->id_studio,
                'user_id'          => $dto->id_utilisateur,
                'date'             => $dto->date,
                'time_slot'        => $dto->creneau_horaire,
                'number_of_hours'  => $dto->nombre_heures,
                'price'            => $dto->prix,
                'status'           => ReservationStatus::Pending,
                'payment_status'   => PaymentStatus::Pending,
                'pin_code'         => str_pad((string)random_int(0, 9999), 4, '0', STR_PAD_LEFT),
            ]);
        });
    }
}

