<?php

namespace App\Actions\Studio;

use App\DTOs\StudioSearchDTO;
use App\Models\Studio;
use Illuminate\Database\Eloquent\Collection;

class SearchStudiosAction
{
    public function __construct(
        private GetCoordinatesAction $getCoordinatesAction
    ) {}

    public function execute(StudioSearchDTO $dto): array
    {
        $latitude = $dto->latitude;
        $longitude = $dto->longitude;

        // Geocode city if provided but no coords
        if ($dto->city && (!$latitude || !$longitude)) {
            $coordinates = $this->getCoordinatesAction->execute($dto->city);
            if ($coordinates) {
                $latitude = $coordinates['latitude'];
                $longitude = $coordinates['longitude'];
            }
        }

        $query = Studio::query();

        if ($dto->min_hours !== null) {
            $query->where('min_hours', '<=', $dto->min_hours);
        }

        // Filtre par équipement : ne retourne que les studios ayant TOUS les équipements sélectionnés
        if (!empty($dto->equipment)) {
            foreach ($dto->equipment as $item) {
                $query->whereJsonContains('equipment', $item);
            }
        }

        if ($latitude && $longitude) {
            $query->selectRaw("*, (6371 * acos(
                cos(radians(?)) * cos(radians(latitude)) * cos(radians(longitude) - radians(?)) +
                sin(radians(?)) * sin(radians(latitude))
            )) AS distance", [$latitude, $longitude, $latitude])
                ->having('distance', '<=', $dto->distance);
        }

        switch ($dto->sort_by) {
            case 'price':
                $query->orderBy('hourly_rate', $dto->sort_direction);
                break;
            case 'distance':
            default:
                if ($latitude && $longitude) {
                    $query->orderBy('distance', 'asc');
                }
                break;
        }

        return [
            'studios' => $query->get(),
            'latitude' => $latitude,
            'longitude' => $longitude,
        ];
    }
}
