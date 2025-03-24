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
use Illuminate\Support\Facades\Storage;

class StudioController extends Controller
{
    /**
     * Afficher la page d'un studio
     *
     * @return Factory|View|Application
     */
    public function show(Studio $studio)
    {

        $timeSlots = [
            "08:00",
            "10:00",
            "14:00",
            "16:00",
        ];


        return view('studios.single', [
            'studio' => $studio,
            'timeSlots' => $timeSlots,
            compact('studio', 'timeSlots')
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

        // Gestion des uploads pour les 4 images
        for ($i = 1; $i <= 4; $i++) {
            $fieldName = "image{$i}";

            if ($request->hasFile($fieldName)) {
                $path = $request->file($fieldName)->store(
                    'uploads/studios',
                    'public'
                );
                $formData[$fieldName] = $path;
            }
        }

        // Génération de l'adresse et géolocalisation
        $fullAddress = trim("{$formData['address']}, {$formData['city']}, {$formData['zipcode']}, {$formData['country']}");
        $location = $this->getCoordinates($fullAddress);

        if ($location) {
            $formData['latitude'] = $location['latitude'];
            $formData['longitude'] = $location['longitude'];
            $formData['user_id'] = Auth::id();

            Studio::create($formData);

            return redirect()->route('studio.create')
                ->with('success', 'Votre studio a été ajouté avec succès !');
        }

        return redirect()->route('studio.create')
            ->withInput()
            ->with('active_tab', '2')
            ->withErrors(['address_not_found' => 'Adresse non trouvée. Veuillez vérifier les informations saisies.']);
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
        $max_distance = 50;
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
        // Initialiser les variables
        $latitude = $request->input('latitude', 0);
        $longitude = $request->input('longitude', 0);
        $distance = $request->input('distance', 50);
        $min_hours = $request->input('min_hours', 1);
        $city = $request->input('city', '');
        $sort_by = $request->input('sort_by', 'distance');
        $sort_direction = $request->input('sort_direction', 'asc');

        // Si une ville est spécifiée, obtenir ses coordonnées
        if (!empty($city) && (!$latitude || !$longitude)) {
            $location = $this->getCoordinates($city);
            if ($location) {
                $latitude = $location['latitude'];
                $longitude = $location['longitude'];
            }
        }

        $query = Studio::query();

        if ($min_hours) {
            $query->where('min_hours', '<=', $min_hours);
        }

        if ($latitude && $longitude) {
            $query->selectRaw("*, (6371 * acos(
            cos(radians(?)) * cos(radians(latitude)) * cos(radians(longitude) - radians(?)) +
            sin(radians(?)) * sin(radians(latitude))
        )) AS distance", [$latitude, $longitude, $latitude])
                ->having('distance', '<=', $distance);
        }

        switch ($sort_by) {
            case 'price':
                $query->orderBy('hourly_rate', $sort_direction);
                break;
            case 'distance':
            default:
                if ($latitude && $longitude) {
                    $query->orderBy('distance', 'asc');
                }
                break;
        }

        $studios = $query->get();


        return view('pages.studio_list', compact(
            'studios',
            'latitude',
            'longitude',
            'distance',
            'min_hours',
            'city',
            'sort_by',
            'sort_direction'
        ));
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
                \Log::info('Réponse Nominatim', ['data' => $data]);
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


    /**
     * Afficher le formulaire d'ajout d'un studio
     *
     * @return Factory|View|Application
     */
    public function create()
    {
        return view('dashboard.studio.create');
    }

    /**
     * Afficher le formulaire de modification d'un studio
     *
     * @param Studio $studio
     * @return Application|Factory|View
     */
    public function edit(Studio $studio)
    {
        // Vérifier que l'utilisateur est bien le propriétaire du studio
        if ($studio->user_id !== Auth::id()) {
            return redirect()->route('dashboard.studios')->with('error', 'Vous n\'êtes pas autorisé à modifier ce studio.');
        }

        return view('dashboard.studio.edit', compact('studio'));
    }

    /**
     * Mettre à jour un studio
     *
     * @param Request $request
     * @param Studio $studio
     * @return RedirectResponse
     */
    public function update(Request $request, Studio $studio): RedirectResponse
    {
        if ($studio->user_id !== Auth::id()) {
            return redirect()->route('dashboard.studios')->with('error', 'Vous n\'êtes pas autorisé à modifier ce studio.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'zipcode' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'hourly_rate' => 'required|numeric|min:0',
            'min_hours' => 'required|integer|min:1',
            'description' => 'nullable|string',
            'image1' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'image2' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'image3' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'image4' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'remove_image1' => 'nullable|boolean',
            'remove_image2' => 'nullable|boolean',
            'remove_image3' => 'nullable|boolean',
            'remove_image4' => 'nullable|boolean',
        ]);

        $data = $request->only([
            'name', 'address', 'zipcode', 'city', 'country',
            'hourly_rate', 'min_hours', 'description'
        ]);

        $fullAddress = trim("{$data['address']}, {$data['city']}, {$data['zipcode']}, {$data['country']}");

        $location = $this->getCoordinates($fullAddress);

        if ($location) {
            $data['latitude'] = $location['latitude'];
            $data['longitude'] = $location['longitude'];
        }

        // Traitement des images
        for ($i = 1; $i <= 4; $i++) {
            $imageField = "image{$i}";
            $removeField = "remove_image{$i}";

            if ($request->has($removeField) && $request->boolean($removeField)) {
                if ($studio->$imageField && Storage::disk('public')->exists($studio->$imageField)) {
                    Storage::disk('public')->delete($studio->$imageField);
                }
                $data[$imageField] = null;
            }
            elseif ($request->hasFile($imageField)) {
                if ($studio->$imageField && Storage::disk('public')->exists($studio->$imageField)) {
                    Storage::disk('public')->delete($studio->$imageField);
                }

                $data[$imageField] = $request->file($imageField)->store('uploads/studios', 'public');
            }
        }

        $studio->update($data);
        
        return redirect()->route('dashboard.studio.edit', $studio)->with('success', 'Studio modifié avec succès !');
    }
}
