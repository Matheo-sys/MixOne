<?php

namespace App\Actions\Studio;

use App\DTOs\StudioSearchDTO;
use App\Models\Studio;
use Illuminate\Database\Eloquent\Collection;

class SearchStudiosAction
{
    /**
     * @param GetCoordinatesAction $actionRecupererCoordonnees
     */
    public function __construct(
        private GetCoordinatesAction $actionRecupererCoordonnees
    ) {}

    /**
     * @param StudioSearchDTO $dto
     * @return array
     */
    public function executer(StudioSearchDTO $dto): array
    {
        $latitude = $dto->latitude;
        $longitude = $dto->longitude;

        // Géocoder la ville si elle est fournie mais sans coordonnées
        if ($dto->ville && (!$latitude || !$longitude)) {
            $coordonnees = $this->actionRecupererCoordonnees->executer($dto->ville);
            if ($coordonnees) {
                $latitude = $coordonnees['latitude'];
                $longitude = $coordonnees['longitude'];
            }
        }

        $requete = Studio::query()
            ->with('proprietaire:id,first_name,last_name,email,stripe_account_id,avatar')
            ->withCount('reservationsTerminees')
            ->withAvg('reservationsTerminees', 'rating')
            ->where('is_verified', true)
            ->whereHas('proprietaire', function($q) {
                $q->whereNotNull('stripe_account_id');
            });


        if ($dto->heures_min !== null) {
            $requete->where('min_hours', '<=', $dto->heures_min);
        }

        // Filtre par équipement : ne retourne que les studios ayant TOUS les équipements sélectionnés
        if (!empty($dto->equipements)) {
            foreach ($dto->equipements as $element) {
                $requete->whereJsonContains('equipment', $element);
            }
        }

        if ($dto->date) {
            $jourSemaine = strtolower(\Carbon\Carbon::parse($dto->date)->format('l'));
            $requete->where(function($q) use ($jourSemaine) {
                $q->whereJsonContains("opening_hours->{$jourSemaine}->is_open", "1")
                  ->orWhereJsonContains("opening_hours->{$jourSemaine}->is_open", true);
            });
        }

        if ($latitude && $longitude) {
            $requete->select('studios.*')
                ->selectRaw("(6371 * acos(
                    cos(radians(?)) * cos(radians(latitude)) * cos(radians(longitude) - radians(?)) +
                    sin(radians(?)) * sin(radians(latitude))
                )) AS distance", [$latitude, $longitude, $latitude])
                ->having('distance', '<=', $dto->distance);
        }

        switch ($dto->trier_par) {
            case 'price':
                $requete->orderBy('hourly_rate', $dto->direction_tri);
                break;
            case 'distance':
            default:
                if ($latitude && $longitude) {
                    $requete->orderBy('distance', 'asc');
                }
                break;
        }

        // Optimisation : utiliser la même requête clonée pour éviter la double exécution
        // Limite les résultats carte à 200 pour les performances front-end
        $studiosCarte = (clone $requete)->select(
            'studios.id', 'studios.uuid', 'studios.name', 'studios.slug',
            'studios.latitude', 'studios.longitude', 'studios.city',
            'studios.hourly_rate', 'studios.image1'
        )->when($latitude && $longitude, function($q) use ($latitude, $longitude) {
            $q->selectRaw("(6371 * acos(
                cos(radians(?)) * cos(radians(latitude)) * cos(radians(longitude) - radians(?)) +
                sin(radians(?)) * sin(radians(latitude))
            )) AS distance", [$latitude, $longitude, $latitude]);
        })->limit(200)->get();

        return [
            'studios' => $requete->paginate(20),
            'studiosCarte' => $studiosCarte,
            'latitude' => $latitude,
            'longitude' => $longitude,
        ];

    }
}
