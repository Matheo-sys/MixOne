<?php

namespace App\DTOs;

use Illuminate\Http\Request;

class StudioSearchDTO
{
    public function __construct(
        public float $latitude = 0,
        public float $longitude = 0,
        public int $distance = 50,
        public ?int $min_hours = null,
        public string $city = '',
        public string $sort_by = 'distance',
        public string $sort_direction = 'asc',
        public array $equipment = []
    ) {}

    public static function fromRequest(Request $request): self
    {
        return new self(
            latitude: (float) $request->input('latitude', 0),
            longitude: (float) $request->input('longitude', 0),
            distance: (int) $request->input('distance', 50),
            min_hours: $request->filled('min_hours') ? (int) $request->input('min_hours') : null,
            city: $request->input('city', '') ?? '',
            sort_by: $request->input('sort_by', 'distance'),
            sort_direction: $request->input('sort_direction', 'asc'),
            equipment: $request->input('equipment', [])
        );
    }
}
