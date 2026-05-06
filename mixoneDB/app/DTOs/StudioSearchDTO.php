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
        public readonly float $latitude = 0,
        public readonly float $longitude = 0,
        public readonly int $distance = 50,
        public readonly ?int $heures_min = null,
        public readonly string $ville = '',
        public readonly string $trier_par = 'distance',
        public readonly string $direction_tri = 'asc',
        public readonly array $equipements = [],
        public readonly ?string $date = null
    ) {}

    /**
     * Crée une instance depuis une requête.
     */
    public static function depuisRequete(Request $requete): self
    {
        return new self(
            latitude: (float) $requete->input('latitude', 0),
            longitude: (float) $requete->input('longitude', 0),
            distance: (int) $requete->input('distance', 50),
            heures_min: $requete->filled('min_hours') ? (int) $requete->input('min_hours') : null,
            ville: $requete->input('city', '') ?? '',
            trier_par: $requete->input('sort_by', 'distance'),
            direction_tri: $requete->input('sort_direction', 'asc'),
            equipements: $requete->input('equipment', []),
            date: $requete->input('date')
        );
    }
}

