<?php

namespace App\Actions\Studio;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GetCoordinatesAction
{
    /**
     * Récupère les coordonnées d'une adresse via Nominatim.
     *
     * @param string $adresse
     * @return array|null
     */
    public function executer(string $adresse): ?array
    {
        try {
            Log::info('Requête Nominatim pour l\'adresse', ['address' => $adresse]);

            $reponse = Http::withHeaders([
                'User-Agent' => 'MixOne/1.0'
            ])->timeout(5)->get("https://nominatim.openstreetmap.org/search", [
                'q' => $adresse,
                'format' => 'json',
                'limit' => 1,
            ]);

            if (!$reponse->successful()) {
                Log::error('Erreur API Nominatim', ['response' => $reponse->body()]);
                return null;
            }

            $donnees = $reponse->json();

            if (!empty($donnees)) {
                return [
                    'latitude' => $donnees[0]['lat'],
                    'longitude' => $donnees[0]['lon'],
                ];
            }

            Log::warning('Aucune coordonnée trouvée pour cette adresse', ['location' => $adresse]);
            return null;

        } catch (\Exception $e) {
            Log::error('Échec de la requête à Nominatim', ['error' => $e->getMessage()]);
            return null;
        }
    }
}

