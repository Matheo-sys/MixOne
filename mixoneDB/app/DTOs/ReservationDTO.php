<?php

namespace App\DTOs;

use Illuminate\Http\Request;

class ReservationDTO
{
    public function __construct(
        public int $studio_id,
        public string $date,
        public string $time_slot,
        public int $number_of_hours,
        public float $price,
        public ?int $user_id = null
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
            'status' => 'en attente',
        ];
    }
}
