<?php

namespace App\Actions\Studio;

use App\DTOs\StudioDTO;
use App\Models\Studio;
use Illuminate\Support\Facades\Storage;

class UpdateStudioAction
{
    public function __construct(
        private GetCoordinatesAction $getCoordinatesAction
    ) {}

    public function execute(Studio $studio, StudioDTO $dto): bool
    {
        $data = $dto->toArray();

        // Handle geocoding
        $fullAddress = trim("{$dto->address}, {$dto->city}, {$dto->zipcode}, {$dto->country}");
        $coordinates = $this->getCoordinatesAction->execute($fullAddress);

        if ($coordinates) {
            $data['latitude'] = $coordinates['latitude'];
            $data['longitude'] = $coordinates['longitude'];
        }

        // Handle image removals and updates
        foreach ($dto->remove_images as $field => $shouldRemove) {
            if ($shouldRemove) {
                if ($studio->$field) {
                    Storage::disk('public')->delete($studio->$field);
                }
                $data[$field] = null;
            }
        }

        foreach ($dto->images as $field => $file) {
            if ($file) {
                // Delete old image if exists
                if ($studio->$field) {
                    Storage::disk('public')->delete($studio->$field);
                }
                $data[$field] = $file->store('uploads/studios', 'public');
            }
        }

        return $studio->update($data);
    }
}
