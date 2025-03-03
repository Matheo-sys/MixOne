<?php

namespace App\Http\Controllers;

use App\Http\Requests\Studio\CreateRequest;
use App\Models\Studio;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class StudioController extends Controller
{
    /**
     * Afficher la page d'un studio
     *
     * @return Factory|View|Application
     */
    public function show(Studio $studio) {
        return view('studios.single', [
            'studio' => $studio,
        ]);
    }

    /**
     * Create a studio
     * @param CreateRequest $request
     * @return RedirectResponse
     */
    public function store(CreateRequest $request): RedirectResponse
    {
        $formData = $request->validated();

        // Gestion des uploads d’images
        $imagePaths = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('uploads/studios', 'public');
                $imagePaths[] = $path;
            }
        }
        $formData['images'] = json_encode($imagePaths);

        // Générer l’adresse complète
        $fullAddress = trim("{$formData['address']}, {$formData['city']}, {$formData['zipcode']}, {$formData['country']}");
        \Log::info('Adresse complète générée', ['fullAddress' => $fullAddress]);

        // Récupération des coordonnées via Nominatim
        $location = $this->getCoordinates($fullAddress);

        if ($location) {
            $formData['latitude'] = $location['latitude'];
            $formData['longitude'] = $location['longitude'];
        } else {
            \Log::error('Coordonnées introuvables pour l\'adresse', ['fullAddress' => $fullAddress]);
            return redirect()->back()->withErrors(['address' => 'Address coordinates not found.']);
        }

        // Ajouter l'ID de l'utilisateur
        $formData['user_id'] = Auth::id();

        // Créer le studio
        Studio::create($formData);

        return redirect()->route('home')->with('success', 'Studio created successfully!');
    }


    /**
     * Afficher la page d'accueil avec les studios par défaut
     *
     * @return Factory|View|Application
     */
    public function index(): Factory|View|Application
    {
        $defaultStudios = Studio::all();

        // Valeurs par défaut pour le formulaire de recherche
        $user_lat = 0;
        $user_lon = 0;
        $max_distance = 50; // Périmètre par défaut en km
        $min_hours = 1;
        $city = '';

        return view('pages.home', compact('defaultStudios', 'user_lat', 'user_lon', 'max_distance', 'min_hours', 'city'));
    }

    public function myStudios()
    {
        $user = auth()->user();
        $studios = Studio::where('user_id', $user->id)->orderBy('created_at', 'desc')->get();
        return view('dashboard.studio.myStudios', compact('studios'));
    }

    /**
     * Rechercher des studios en fonction des filtres
     *
     * @param Request $request
     * @return View
     */
    public function search(Request $request): View
    {
        // Initialiser les variables par défaut
        $latitude = $request->input('latitude', 0);
        $longitude = $request->input('longitude', 0);
        $distance = $request->input('distance', 50);
        $min_hours = $request->input('min_hours', 1);
        $city = $request->input('city', '');

        // Si une ville est spécifiée, obtenir ses coordonnées
        if (!empty($city) && (!$latitude || !$longitude)) {
            $location = $this->getCoordinates($city);
            if ($location) {
                $latitude = $location['latitude'];
                $longitude = $location['longitude'];
            }
        }

        // Requête de base
        $query = Studio::query();

        // Filtrage par heures minimales
        if ($min_hours) {
            $query->where('min_hours', '<=', $min_hours);
        }

        // Si on a des coordonnées, filtrer par distance
        if ($latitude && $longitude) {
            // Formule Haversine pour calculer la distance entre deux points sur une sphère
            $query->selectRaw("*,
                (6371 * acos(
                    cos(radians(?)) *
                    cos(radians(latitude)) *
                    cos(radians(longitude) - radians(?)) +
                    sin(radians(?)) *
                    sin(radians(latitude))
                )) AS distance", [$latitude, $longitude, $latitude])
                ->having('distance', '<=', $distance)
                ->orderBy('distance');
        }

        $studios = $query->get();

        // Préparer les variables pour la vue
        $user_lat = $latitude;
        $user_lon = $longitude;
        $max_distance = $distance;

        return view('pages.home', compact('studios', 'user_lat', 'user_lon', 'max_distance', 'min_hours', 'city'));
    }

    /**
     * Obtenir les coordonnées d'une localisation (ville ou adresse) via Nominatim API
     *
     * @param string $location
     * @return array|null
     */
    private function getCoordinates(string $location): ?array
    {
        try {
            $userAgent = 'OneMixStudioApplication/1.0';

            \Log::info('Requête Nominatim pour l\'adresse', ['address' => $location]);

            $response = Http::withHeaders([
                'User-Agent' => $userAgent
            ])->timeout(5)->get("https://nominatim.openstreetmap.org/search", [
                'q' => $location,
                'format' => 'json',
                'limit' => 1,
            ]);

            if (!$response->successful()) {
                \Log::error('Nominatim API error', ['response' => $response->body()]);
                return null;
            }

            $data = $response->json();

            if (!empty($data)) {
                return [
                    'latitude' => $data[0]['lat'],
                    'longitude' => $data[0]['lon'],
                ];
            }

            \Log::warning('Aucune coordonnée trouvée pour cette adresse', ['location' => $location]);
            return null;

        } catch (\Exception $e) {
            \Log::error('Échec de la requête à Nominatim', ['error' => $e->getMessage()]);
            return null;
        }
    }


    public function destroy(Studio $studio)
    {
        $studio->delete();
        return redirect()->route('dashboard.studios')->with('success', 'Studio deleted successfully.');
    }
}
