<?php

namespace App\DTOs;

use Illuminate\Http\Request;

class StudioDTO
{
    public function __construct(
        public readonly string $name,
        public readonly string $address,
        public readonly string $zipcode,
        public readonly string $city,
        public readonly string $country,
        public readonly float $hourly_rate,
        public readonly int $min_hours,
        public readonly string $description,
        public readonly array $equipment = [],
        public readonly array $opening_hours = [],
        public readonly ?int $user_id = null,
        public readonly array $images = [],
        public readonly array $remove_images = []
    ) {}

    public static function fromRequest(Request $request): self
    {
        return new self(
            name: $request->validated('name'),
            address: $request->validated('address'),
            zipcode: $request->validated('zipcode'),
            city: $request->validated('city'),
            country: $request->validated('country'),
            hourly_rate: (float) $request->validated('hourly_rate'),
            min_hours: (int) $request->validated('min_hours'),
            description: $request->validated('description'),
            equipment: $request->input('equipment', []),
            opening_hours: $request->input('opening_hours', []),
            user_id: auth()->id(),
            images: [
                'image1' => $request->file('image1'),
                'image2' => $request->file('image2'),
                'image3' => $request->file('image3'),
                'image4' => $request->file('image4'),
            ],
            remove_images: [
                'image1' => $request->boolean('remove_image1'),
                'image2' => $request->boolean('remove_image2'),
                'image3' => $request->boolean('remove_image3'),
                'image4' => $request->boolean('remove_image4'),
            ]
        );
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'address' => $this->address,
            'zipcode' => $this->zipcode,
            'city' => $this->city,
            'country' => $this->country,
            'hourly_rate' => $this->hourly_rate,
            'min_hours' => $this->min_hours,
            'description' => $this->description,
            'equipment' => $this->equipment,
            'opening_hours' => $this->opening_hours,
            'user_id' => $this->user_id,
        ];
    }
}
