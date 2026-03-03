<?php

namespace App\Actions\Studio;

use App\DTOs\StudioDTO;
use App\Models\Studio;
use Illuminate\Support\Facades\Storage;

class CreateStudioAction
{
    public function __construct(
        private GetCoordinatesAction $getCoordinatesAction
    ) {}

    public function execute(StudioDTO $dto): Studio
    {
        $data = $dto->toArray();

        // Handle image uploads
        foreach ($dto->images as $field => $file) {
            if ($file) {
                $data[$field] = $file->store('uploads/studios', 'public');
            }
        }

        // Handle geocoding
        $fullAddress = trim("{$dto->address}, {$dto->city}, {$dto->zipcode}, {$dto->country}");
        $coordinates = $this->getCoordinatesAction->execute($fullAddress);

        if ($coordinates) {
            $data['latitude'] = $coordinates['latitude'];
            $data['longitude'] = $coordinates['longitude'];
        }

        return Studio::create($data);
    }
}
