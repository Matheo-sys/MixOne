<?php

namespace App\Actions\Studio;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GetCoordinatesAction
{
    /**
     * Récupère les coordonnées d'une adresse via LocationIQ (ou Nominatim par défaut).
     *
     * @param string $adresse
     * @return array|null
     */
    public function executer(string $adresse): ?array
    {
        try {
            $token = config('services.locationiq.token');
            
            // Si pas de token, on fallback sur Nominatim (pour le dev), sinon LocationIQ
            $url = $token 
                ? "https://us1.locationiq.com/v1/search.php" 
                : "https://nominatim.openstreetmap.org/search";

            Log::info('Requête Géocodage pour l\'adresse', ['address' => $adresse, 'service' => $token ? 'LocationIQ' : 'Nominatim']);

            $params = [
                'q' => $adresse,
                'format' => 'json',
                'limit' => 1,
            ];

            if ($token) {
                $params['key'] = $token;
            }

            $reponse = Http::withHeaders([
                'User-Agent' => 'MixOne-App-Production'
            ])->timeout(10)->get($url, $params);

            if (!$reponse->successful()) {
                Log::error('Erreur API Géocodage', ['status' => $reponse->status(), 'body' => $reponse->body()]);
                return null;
            }

            $donnees = $reponse->json();

            if (!empty($donnees)) {
                // Nominatim et LocationIQ ont la même structure de réponse
                return [
                    'latitude' => $donnees[0]['lat'],
                    'longitude' => $donnees[0]['lon'],
                ];
            }

            Log::warning('Aucune coordonnée trouvée pour cette adresse', ['location' => $adresse]);
            return null;

        } catch (\Exception $e) {
            Log::error('Échec de la requête de géocodage', ['error' => $e->getMessage()]);
            return null;
        }
    }
}
