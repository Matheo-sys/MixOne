<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CompleteExpiredReservations extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mixone:auto-complete-reservations';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Valide automatiquement les réservations passées de plus de 48h sans litige.';

    /**
     * Execute the console command.
     */
    public function handle(\App\Actions\Reservation\UpdateReservationStatusAction $updateAction)
    {
        $this->info('Vérification des réservations expirées...');

        $threshold = now()->subHours(48);

        // Trouver les réservations confirmées dont la date + heure + durée est passée de plus de 48h
        // et qui n'ont pas de litige
        $reservations = \App\Models\Reservation::where('status', \App\Enums\ReservationStatus::Confirmed)
            ->whereNull('disputed_at')
            ->get()
            ->filter(function ($reservation) use ($threshold) {
                // Calculer la fin de la session
                $endTime = \Carbon\Carbon::parse($reservation->time_slot)->addHours($reservation->number_of_hours);
                return $endTime->lessThan($threshold);
            });

        $count = 0;
        foreach ($reservations as $reservation) {
            try {
                // On passe le rôle 'admin' ou on ignore la Gate dans la commande (UpdateAction ne vérifie Auth que si c'est 'artist' ou 'studio')
                // Mais wait, UpdateReservationStatusAction utilise Auth::user().
                // On doit d'abord modifier UpdateAction pour autoriser le système (role = 'system').
                $updateAction->execute($reservation, \App\Enums\ReservationStatus::Completed, 'system');
                $count++;
            } catch (\Exception $e) {
                \Illuminate\Support\Facades\Log::error("Erreur auto-complete reservation #{$reservation->id}: " . $e->getMessage());
            }
        }

        $this->info("Terminé. {$count} réservations auto-validées.");
    }
}
