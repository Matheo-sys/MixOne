<?php

namespace App\Actions\Studio;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GetCoordinatesAction
{
    /**
     * @param string $location
     * @return array|null
     */
    public function execute(string $location): ?array
    {
        try {
            Log::info('Requête Nominatim pour l\'adresse', ['address' => $location]);

            $response = Http::withHeaders([
                'User-Agent' => 'MixOne/1.0'
            ])->timeout(5)->get("https://nominatim.openstreetmap.org/search", [
                'q' => $location,
                'format' => 'json',
                'limit' => 1,
            ]);

            if (!$response->successful()) {
                Log::error('Nominatim API error', ['response' => $response->body()]);
                return null;
            }

            $data = $response->json();

            if (!empty($data)) {
                return [
                    'latitude' => $data[0]['lat'],
                    'longitude' => $data[0]['lon'],
                ];
            }

            Log::warning('Aucune coordonnée trouvée pour cette adresse', ['location' => $location]);
            return null;

        } catch (\Exception $e) {
            Log::error('Échec de la requête à Nominatim', ['error' => $e->getMessage()]);
            return null;
        }
    }
}
