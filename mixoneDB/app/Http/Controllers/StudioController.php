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
        // Retrieve all form data
        $formData = $request->all();

        // Remove _token from the array
        unset($formData['_token']);

        // Add id user to the form data
        $formData['user_id'] = auth()->user()->id;

        // Get city coordinates from GeoNames API
        $location = $this->getCityCoordinates($formData['city']);

        if ($location) {
            $formData['latitude'] = $location['latitude'];
            $formData['longitude'] = $location['longitude'];
        } else {
            // Handle the case where the city coordinates are not found
            return redirect()->back()->withErrors(['city' => 'City coordinates not found.']);
        }

        // Create the studio
        $studio = Studio::create($formData);

        return redirect()->route('home', ['studio' => $studio]);
    }

    /**
     * Afficher la page d'accueil avec les studios par défaut
     *
     * @return Factory|View|Application
     */
    public function index(): Factory|View|Application
    {

        $defaultStudios = Studio::all();

        return  view('pages.home', compact('defaultStudios'));
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
     * @return RedirectResponse
     */
    public function search(Request $request): View
    {
        $query = Studio::query();

        if ($request->has('city')) {
            $query->where('city', 'like', '%' . $request->input('city') . '%');
        }

        if ($request->has('date')) {
            $query->where('available_date', $request->input('date'));
        }

        if ($request->has('min_hours')) {
            $query->where('min_hours', '<=', $request->input('min_hours'));
        }

        $studios = $query->get();

        if ($studios->isEmpty() && $request->has('city')) {
            $city = $request->input('city');
            $location = $this->getCityCoordinates($city);

            if ($location) {
                $latitude = $location['latitude'];
                $longitude = $location['longitude'];

                $studios = Studio::selectRaw(
                    "*, ( 6371 * acos( cos( radians(?) ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians(?) ) + sin( radians(?) ) * sin( radians( latitude ) ) ) ) AS distance",
                    [$latitude, $longitude, $latitude]
                )
                    ->orderBy('distance')
                    ->limit(10)
                    ->get();
            } else {
                return view('pages.home', ['studios' => collect(), 'error' => 'Ville non trouvée.']);
            }
        }

        return view('pages.home', compact('studios'));
    }

    private function getCityCoordinates(string $city): ?array
    {
        $username = 'elias.l94';
        $response = Http::get("http://api.geonames.org/searchJSON", [
            'q' => $city,
            'maxRows' => 1,
            'username' => $username,
        ]);

        if ($response->successful() && isset($response['geonames'][0])) {
            return [
                'latitude' => $response['geonames'][0]['lat'],
                'longitude' => $response['geonames'][0]['lng'],
            ];
        }

        return null;
    }
}

