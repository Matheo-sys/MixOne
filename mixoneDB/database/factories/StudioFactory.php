<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Studio>
 */
class StudioFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'name' => $this->faker->company() . " Studio",
            'description' => $this->faker->paragraphs(3, true),
            'address' => $this->faker->streetAddress(),
            'zipcode' => $this->faker->postcode(),
            'city' => $this->faker->city(),
            'country' => 'France',
            'hourly_rate' => $this->faker->numberBetween(30, 150),
            'min_hours' => $this->faker->numberBetween(1, 4),
            'latitude' => $this->faker->latitude(48.5, 49.0),
            'longitude' => $this->faker->longitude(2.0, 2.6),
            'equipment' => ['Microphone', 'Moniteurs', 'Casque', 'Interface Audio'],
            'is_verified' => $this->faker->boolean(50),
            'opening_hours' => [
                'monday'    => ['is_open' => true,  'start' => '09:00', 'end' => '20:00'],
                'tuesday'   => ['is_open' => true,  'start' => '09:00', 'end' => '20:00'],
                'wednesday' => ['is_open' => true,  'start' => '09:00', 'end' => '20:00'],
                'thursday'  => ['is_open' => true,  'start' => '09:00', 'end' => '20:00'],
                'friday'    => ['is_open' => true,  'start' => '09:00', 'end' => '20:00'],
                'saturday'  => ['is_open' => true,  'start' => '10:00', 'end' => '18:00'],
                'sunday'    => ['is_open' => false, 'start' => '09:00', 'end' => '20:00'],
            ],
        ];
    }
}
