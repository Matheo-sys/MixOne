<?php

namespace Database\Factories;

use App\Models\Studio;
use App\Models\User;
use App\Enums\PaymentStatus;
use App\Enums\ReservationStatus;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reservation>
 */
class ReservationFactory extends Factory
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
            'studio_id' => Studio::factory(),
            'date' => $this->faker->dateTimeBetween('-1 month', '+1 month'),
            'time_slot' => $this->faker->numberBetween(8, 20) . ':00 - ' . $this->faker->numberBetween(8, 20) . ':00',
            'number_of_hours' => $this->faker->numberBetween(1, 4),
            'price' => $this->faker->numberBetween(50, 500),
            'status' => $this->faker->randomElement(ReservationStatus::cases()),
            'payment_status' => $this->faker->randomElement(PaymentStatus::cases()),
            'pin_code' => Str::random(6),
            'rating' => $this->faker->optional(0.7)->numberBetween(1, 5),
            'comment' => $this->faker->optional(0.5)->sentence(),
        ];
    }
}
