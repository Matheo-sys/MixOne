<?php

namespace App\DTOs;

use Illuminate\Http\Request;

class StudioSearchDTO
{
    /**
     * @param float $latitude
     * @param float $longitude
     * @param int $distance
     * @param int|null $heures_min
     * @param string $ville
     * @param string $trier_par
     * @param string $direction_tri
     * @param array $equipements
     * @param string|null $date
     */
    public function __construct(
        public readonly float $latitude,
        public readonly float $longitude,
        public readonly int $distance,
        public readonly ?int $heures_min,
        public readonly string $ville,
        public readonly string $trier_par,
        public readonly string $direction_tri,
        public readonly array $equipements,
        public readonly ?string $date
    ) {}

    /**
     * Crée une instance depuis une requête.
     */
    public static function depuisRequete(Request $requete): self
    {
        return new self(
            latitude: (float) $requete->input('latitude', 0),
            longitude: (float) $requete->input('longitude', 0),
            distance: (int) $requete->input('distance', 100),
            heures_min: $requete->filled('min_hours') ? (int) $requete->input('min_hours') : null,
            ville: (string) ($requete->input('city', '') ?? ''),
            trier_par: (string) ($requete->input('sort_by', 'distance') ?? 'distance'),
            direction_tri: (string) ($requete->input('sort_direction', 'asc') ?? 'asc'),
            equipements: (array) ($requete->input('equipment', []) ?? []),
            date: $requete->input('date')
        );
    }
}
