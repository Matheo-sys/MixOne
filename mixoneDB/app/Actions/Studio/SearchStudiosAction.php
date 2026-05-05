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

        $query = Studio::query()
            ->with('user')
            ->withCount('completedReservations')
            ->withAvg('completedReservations', 'rating')
            ->where('is_verified', true);

        if ($dto->min_hours !== null) {
            $query->where('min_hours', '<=', $dto->min_hours);
        }

        // Filtre par équipement : ne retourne que les studios ayant TOUS les équipements sélectionnés
        if (!empty($dto->equipment)) {
            foreach ($dto->equipment as $item) {
                $query->whereJsonContains('equipment', $item);
            }
        }

        if ($dto->date) {
            $dayOfWeek = strtolower(\Carbon\Carbon::parse($dto->date)->format('l'));
            $query->where(function($q) use ($dayOfWeek) {
                $q->whereJsonContains("opening_hours->{$dayOfWeek}->is_open", "1")
                  ->orWhereJsonContains("opening_hours->{$dayOfWeek}->is_open", true);
            });
        }

        if ($latitude && $longitude) {
            $query->select('studios.*')
                ->selectRaw("(6371 * acos(
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

        $mapStudios = (clone $query)->get();

        return [
            'studios' => $query->paginate(20),
            'map_studios' => $mapStudios,
            'latitude' => $latitude,
            'longitude' => $longitude,
        ];
    }
}
