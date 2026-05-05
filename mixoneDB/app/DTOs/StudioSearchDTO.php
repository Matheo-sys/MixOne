<?php

namespace App\DTOs;

use Illuminate\Http\Request;

class StudioSearchDTO
{
    public function __construct(
        public readonly float $latitude = 0,
        public readonly float $longitude = 0,
        public readonly int $distance = 50,
        public readonly ?int $min_hours = null,
        public readonly string $city = '',
        public readonly string $sort_by = 'distance',
        public readonly string $sort_direction = 'asc',
        public readonly array $equipment = []
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
