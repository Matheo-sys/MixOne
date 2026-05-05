<?php

namespace App\DTOs;

use Illuminate\Http\Request;

class ReservationDTO
{
    public function __construct(
        public readonly int $studio_id,
        public readonly string $date,
        public readonly string $time_slot,
        public readonly int $number_of_hours,
        public readonly float $price,
        public readonly ?int $user_id = null
    ) {}

    public static function fromRequest(Request $request): self
    {
        return new self(
            studio_id: (int) $request->validated('studio_id'),
            date: $request->validated('date'),
            time_slot: $request->validated('time_slot'),
            number_of_hours: (int) $request->validated('number_of_hours'),
            price: (float) $request->validated('total_price'),
            user_id: auth()->id()
        );
    }

    public function toArray(): array
    {
        return [
            'studio_id' => $this->studio_id,
            'user_id' => $this->user_id,
            'date' => $this->date,
            'time_slot' => $this->time_slot,
            'number_of_hours' => $this->number_of_hours,
            'price' => $this->price,
            'status' => 'En attente',
        ];
    }
}
