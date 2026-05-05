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
        // 1. Création des utilisateurs de base
        $admin = User::firstOrCreate(
            ['email' => 'admin@mixone.com'],
            [
                'username' => 'admin',
                'first_name' => 'Admin',
                'last_name' => 'MixOne',
                'password' => Hash::make('password'),
                'profile' => 'artist',
                'is_admin' => true,
                'email_verified_at' => now(),
            ]
        );

        $studioUser = User::firstOrCreate(
            ['email' => 'studio@test.com'],
            [
                'username' => 'studiotest',
                'first_name' => 'Marc',
                'last_name' => 'Studio',
                'password' => Hash::make('password'),
                'profile' => 'studio',
                'email_verified_at' => now(),
            ]
        );

        // 2. Définition des horaires par défaut
        $defaultOpeningHours = [
            'monday'    => ['is_open' => true,  'start' => '09:00', 'end' => '20:00'],
            'tuesday'   => ['is_open' => true,  'start' => '09:00', 'end' => '20:00'],
            'wednesday' => ['is_open' => true,  'start' => '09:00', 'end' => '20:00'],
            'thursday'  => ['is_open' => true,  'start' => '09:00', 'end' => '20:00'],
            'friday'    => ['is_open' => true,  'start' => '09:00', 'end' => '23:00'],
            'saturday'  => ['is_open' => true,  'start' => '10:00', 'end' => '19:00'],
            'sunday'    => ['is_open' => false, 'start' => '09:00', 'end' => '20:00'],
        ];

        // 3. Création de studios ultra-complets avec les CLÉS reconnues par le frontend
        $studios = [
            [
                'name' => 'MixOne Signature Paris',
                'description' => 'Notre studio phare. Une acoustique traitée par les meilleurs ingénieurs, idéale pour le mixage et le mastering de haute précision. Équipé d\'un système de monitoring Focal haut de gamme.',
                'address' => '42 Rue du Louvre',
                'city' => 'Paris',
                'zipcode' => '75001',
                'country' => 'France',
                'latitude' => 48.8631,
                'longitude' => 2.3412,
                'hourly_rate' => 95.00,
                'min_hours' => 3,
                'equipment' => [
                    'console_analog', 'mic_neumann', 'mic_akg', 'monitor_focal', 'compressor_hardware', 'eq_hardware', 'booth', 'wifi', 'air_conditioning'
                ],
            ],
            [
                'name' => 'The Blue Room',
                'description' => 'Un espace intimiste et chaleureux, parfait pour les sessions de chant et le songwriting. Ambiance tamisée et matériel haut de gamme pour capturer l\'émotion pure.',
                'address' => '15 Rue de Charonne',
                'city' => 'Paris',
                'zipcode' => '75011',
                'country' => 'France',
                'latitude' => 48.8521,
                'longitude' => 2.3734,
                'hourly_rate' => 45.00,
                'min_hours' => 1,
                'equipment' => [
                    'mic_neumann', 'mic_shure', 'monitor_yamaha', 'headphones_dj', 'plugin_bundle', 'wifi', 'lounge'
                ],
            ],
            [
                'name' => 'Underground Beatmaker Lab',
                'description' => 'Le temple du Hip-Hop et de l\'Électro. Des basses qui cognent et tout le nécessaire pour produire vos prochains hits urbains.',
                'address' => '8 Rue de la Ferronnerie',
                'city' => 'Paris',
                'zipcode' => '75001',
                'country' => 'France',
                'latitude' => 48.8604,
                'longitude' => 2.3472,
                'hourly_rate' => 35.00,
                'min_hours' => 2,
                'equipment' => [
                    'monitor_adam', 'subwoofer', 'mic_shure', 'plugin_bundle', 'wifi', 'air_conditioning'
                ],
            ],
            [
                'name' => 'Vintage Sound Factory',
                'description' => 'Amoureux du son analogique, ce studio est pour vous. Magnétophones à bandes, compresseurs à lampes et instruments d\'époque pour une texture sonore inimitable.',
                'address' => '12 Rue des Petites Écuries',
                'city' => 'Paris',
                'zipcode' => '75010',
                'country' => 'France',
                'latitude' => 48.8723,
                'longitude' => 2.3512,
                'hourly_rate' => 65.00,
                'min_hours' => 2,
                'equipment' => [
                    'console_analog', 'reverb_hardware', 'compressor_hardware', 'mic_neumann', 'monitor_yamaha', 'booth', 'wifi'
                ],
            ],
        ];

        foreach ($studios as $data) {
            Studio::create(array_merge($data, [
                'user_id' => $studioUser->id,
                'opening_hours' => $defaultOpeningHours,
                'is_verified' => true,
            ]));
        }
    }
}
