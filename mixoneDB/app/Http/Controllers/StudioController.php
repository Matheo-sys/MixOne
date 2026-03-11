<?php

namespace App\Http\Controllers;

use App\Actions\Studio\CreateStudioAction;
use App\Actions\Studio\DeleteStudioAction;
use App\Actions\Studio\SearchStudiosAction;
use App\Actions\Studio\UpdateStudioAction;
use App\Http\Requests\Studio\CreateRequest;
use App\Http\Requests\Studio\SearchRequest;
use App\Http\Requests\Studio\UpdateRequest;
use App\Models\Reservation;
use App\Models\Studio;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class StudioController extends Controller
{
    public function __construct(
        private CreateStudioAction $createStudioAction,
        private UpdateStudioAction $updateStudioAction,
        private DeleteStudioAction $deleteStudioAction,
        private SearchStudiosAction $searchStudiosAction
    ) {}

    /**
     * Afficher la page d'un studio
     */
    public function show(Studio $studio): View
    {
        $timeSlots = ["08:00", "10:00", "14:00", "16:00"];

        return view('pages.studio.show', compact('studio', 'timeSlots'));
    }

    /**
     * Create a studio
     */
    public function store(CreateRequest $request): RedirectResponse|JsonResponse
    {
        try {
            $studio = $this->createStudioAction->execute($request->toDTO());

            if ($request->ajax()) {
                return response()->json(['status' => 'success', 'message' => 'Votre studio a été ajouté avec succès !', 'redirect' => route('dashboard.studio.myStudios')]);
            }
            return redirect()->route('dashboard.studio.myStudios')
                ->with('success', 'Votre studio a été ajouté avec succès !');
        } catch (\Exception $e) {
            if ($request->ajax()) {
                return response()->json(['status' => 'error', 'message' => 'Erreur lors de la création du studio. Veuillez vérifier les informations.'], 422);
            }
            return redirect()->route('studio.create')
                ->withInput()
                ->with('active_tab', '2')
                ->withErrors(['address_not_found' => 'Erreur lors de la création du studio. Veuillez vérifier les informations.']);
        }
    }

    /**
     * Afficher tous les studios (sans filtre)
     */
    public function index(): View
    {
        $studios = Studio::paginate(20);
        return view('pages.studio_list', [
            'studios'           => $studios,
            'latitude'          => 0,
            'longitude'         => 0,
            'distance'          => 50,
            'min_hours'         => null,
            'city'              => '',
            'sort_by'           => 'distance',
            'sort_direction'    => 'asc',
            'selectedEquipment' => [],
        ]);
    }

    /**
     * Rechercher des studios en fonction des filtres
     */
    public function search(SearchRequest $request): View
    {
        $result = $this->searchStudiosAction->execute($request->toDTO());
        $dto = $request->toDTO();

        return view('pages.studio_list', array_merge($result, [
            'distance'          => $dto->distance,
            'min_hours'         => $dto->min_hours,
            'city'              => $dto->city,
            'sort_by'           => $dto->sort_by,
            'sort_direction'    => $dto->sort_direction,
            'selectedEquipment' => $dto->equipment,
        ]));
    }

    /**
     * Proxy de recherche géo (Nom -> Coords)
     */
    public function searchGeocode(Request $request)
    {
        $q = $request->get('q');
        if (!$q) return response()->json([]);

        $response = Http::withHeaders(['User-Agent' => 'MixOne/1.0'])
            ->get("https://nominatim.openstreetmap.org/search", [
                'q' => $q,
                'format' => 'json',
                'limit' => 1,
            ]);

        return response()->json($response->json());
    }

    /**
     * Proxy de recherche inverse (Coords -> Nom)
     */
    public function reverseGeocode(Request $request)
    {
        $lat = $request->get('lat');
        $lon = $request->get('lon');
        if (!$lat || !$lon) return response()->json([]);

        $response = Http::withHeaders(['User-Agent' => 'MixOne/1.0'])
            ->get("https://nominatim.openstreetmap.org/reverse", [
                'lat' => $lat,
                'lon' => $lon,
                'format' => 'json',
                'addressdetails' => 1,
            ]);

        return response()->json($response->json());
    }

    public function destroy(Studio $studio): RedirectResponse
    {
        if ($studio->user_id !== Auth::id()) {
            return redirect()->route('dashboard.studio.myStudios')->with('error', 'Action non autorisée.');
        }

        $this->deleteStudioAction->execute($studio);
        return redirect()->route('dashboard.studio.myStudios')->with('success', 'Studio deleted successfully.');
    }

    public function create(): View
    {
        return view('dashboard.studio.create');
    }

    public function edit(Studio $studio): View|RedirectResponse
    {
        if ($studio->user_id !== Auth::id()) {
            return redirect()->route('dashboard.studio.myStudios')->with('error', 'Vous n\'êtes pas autorisé à modifier ce studio.');
        }

        return view('dashboard.studio.edit', compact('studio'));
    }

    public function update(UpdateRequest $request, Studio $studio): RedirectResponse|JsonResponse
    {
        if ($studio->user_id !== Auth::id()) {
            if ($request->ajax()) {
                return response()->json(['status' => 'error', 'message' => 'Action non autorisée.'], 403);
            }
            return redirect()->route('dashboard.studio.myStudios')->with('error', 'Vous n\'êtes pas autorisé à modifier ce studio.');
        }

        try {
            $this->updateStudioAction->execute($studio, $request->toDTO());
            if ($request->ajax()) {
                return response()->json(['status' => 'success', 'message' => 'Studio modifié avec succès !']);
            }
            return redirect()->route('dashboard.studio.edit', $studio)->with('success', 'Studio modifié avec succès !');
        } catch (\Exception $e) {
            if ($request->ajax()) {
                return response()->json(['status' => 'error', 'message' => 'Erreur lors de la mise à jour du studio.'], 422);
            }
            return back()->withErrors(['update_error' => 'Erreur lors de la mise à jour du studio.']);
        }
    }
}
