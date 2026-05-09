<?php

namespace Database\Seeders;

use App\Models\Studio;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class StudioSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Création du compte administrateur principal
        User::firstOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'username' => 'admin',
                'first_name' => 'Admin',
                'last_name' => 'MixOne',
                'password' => 'password',
                'profile' => 'artist',
                'is_admin' => true,
                'email_verified_at' => now(),
            ]
        );

        // On ne crée aucun studio pour le moment comme demandé
    }
}
