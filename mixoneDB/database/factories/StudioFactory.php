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
            'latitude' => $this->faker->latitude(43, 49),
            'longitude' => $this->faker->longitude(-1, 7),
            'equipment' => ['Microphone', 'Moniteurs', 'Casque', 'Interface Audio'],
            'is_verified' => $this->faker->boolean(20),
        ];
    }
}
