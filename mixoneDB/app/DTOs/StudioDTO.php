<?php

namespace App\DTOs;

use Illuminate\Http\Request;

class StudioDTO
{
    public function __construct(
        public string $name,
        public string $address,
        public string $zipcode,
        public string $city,
        public string $country,
        public float $hourly_rate,
        public int $min_hours,
        public string $description,
        public array $equipment = [],
        public ?int $user_id = null,
        public array $images = [],
        public array $remove_images = []
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
            'user_id' => $this->user_id,
        ];
    }
}
