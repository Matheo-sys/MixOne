<?php

namespace App\Console\Commands;

use App\Actions\Reservation\UpdateReservationStatusAction;
use App\Enums\ReservationStatus;
use App\Models\Reservation;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class CancelExpiredReservations extends Command
{
    /**
     * @var string
     */
    protected $signature = 'reservations:cancel-expired';

    /**
     * @var string
     */
    protected $description = 'Annule et rembourse les réservations en attente dont l\'heure de début est passée.';

    /**
     * @param UpdateReservationStatusAction $updateAction
     */
    public function __construct(
        private readonly UpdateReservationStatusAction $updateAction
    ) {
        parent::__construct();
    }

    /**
     * @return int
     */
    public function handle(): int
    {
        $this->info('Vérification des réservations expirées...');

        // Récupérer les réservations "En attente"
        $reservations = Reservation::where('status', ReservationStatus::Pending)
            ->get();

        $count = 0;
        foreach ($reservations as $reservation) {
            try {
                // Créer un objet Carbon combinant la date et l'heure de début
                $startDateTime = Carbon::parse($reservation->date->format('Y-m-d') . ' ' . $reservation->time_slot);

                // Si l'heure de début est déjà passée (on peut ajouter une petite marge de 5 min)
                if ($startDateTime->lt(now())) {
                    $this->warn("Annulation de la réservation #{$reservation->id} (expirée le {$startDateTime})");
                    
                    $this->updateAction->executer($reservation, ReservationStatus::Cancelled, 'system');
                    
                    $count++;
                }
            } catch (\Exception $e) {
                $this->error("Erreur lors de l'annulation de #{$reservation->id}: " . $e->getMessage());
                Log::error("Cron Expired Reservations: " . $e->getMessage());
            }
        }

        if ($count > 0) {
            $this->info("{$count} réservation(s) expirée(s) annulée(s).");
        } else {
            $this->info("Aucune réservation expirée trouvée.");
        }

        return 0;
    }
}
