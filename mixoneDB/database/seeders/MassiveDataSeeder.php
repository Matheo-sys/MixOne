<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Studio;
use App\Models\Reservation;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MassiveDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command->info('Génération massive de données en cours...');

        // 1. Créer 2000 utilisateurs
        $this->command->info('Création de 2000 utilisateurs...');
        $users = User::factory(2000)->create();

        // 2. Créer 1000 studios (répartis sur les utilisateurs existants)
        $this->command->info('Création de 1000 studios...');
        $studios = Studio::factory(1000)->recycle($users)->create();

        // 3. Créer 20 000 réservations (beaucoup de données !)
        $this->command->info('Création de 20 000 réservations...');
        
        $batchSize = 2000;
        for ($i = 0; $i < 10; $i++) {
            Reservation::factory($batchSize)->recycle($users)->recycle($studios)->create();
            $this->command->info("Batch " . ($i+1) . "/10 terminé.");
        }

        $this->command->info('Données générées avec succès !');
    }
}
