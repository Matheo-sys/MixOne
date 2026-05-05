<?php

namespace App\Http\Controllers;

use App\Actions\Studio\CreateStudioAction;
use App\Actions\Studio\DeleteStudioAction;
use App\Actions\Studio\SearchStudiosAction;
use App\Actions\Studio\UpdateStudioAction;
use App\Http\Requests\Studio\CreateRequest;
use App\Http\Requests\Studio\SearchRequest;
use App\Http\Requests\Studio\UpdateRequest;
use App\Models\Studio;
use App\Models\User;
use App\Notifications\NewStudioCreated;
use Illuminate\Support\Facades\Notification;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Http;

class StudioController extends Controller
{
    public function __construct(
        private readonly CreateStudioAction $createStudioAction,
        private readonly UpdateStudioAction $updateStudioAction,
        private readonly DeleteStudioAction $deleteStudioAction,
        private readonly SearchStudiosAction $searchStudiosAction
    ) {}

    /**
     * Afficher la page d'un studio
     */
    public function show(Studio $studio): View
    {
        $studio->load(['user', 'reviews.user']);
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
            $studio->load('user');

            // Notify Admins
            $admins = User::where('is_admin', true)->get();
            Notification::send($admins, new NewStudioCreated($studio));

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
        $baseQuery = Studio::with('user')
            ->withCount('completedReservations')
            ->withAvg('completedReservations', 'rating')
            ->where('is_verified', true);

        $studios = (clone $baseQuery)->paginate(20);
        $mapStudios = (clone $baseQuery)->get();

        $favoriteIds = auth()->check() ? auth()->user()->favoriteStudios()->pluck('studios.id')->toArray() : [];

        return view('pages.studio_list', [
            'studios'           => $studios,
            'map_studios'       => $mapStudios,
            'favoriteIds'       => $favoriteIds,
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

        $favoriteIds = auth()->check() ? auth()->user()->favoriteStudios()->pluck('studios.id')->toArray() : [];

        return view('pages.studio_list', array_merge($result, [
            'favoriteIds'       => $favoriteIds,
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
    public function searchGeocode(Request $request): JsonResponse
    {
        $request->validate(['q' => 'required|string|max:255']);

        $q = $request->get('q');

        $response = Http::withHeaders(['User-Agent' => 'MixOne/1.0'])
            ->timeout(5)
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
    public function reverseGeocode(Request $request): JsonResponse
    {
        $request->validate([
            'lat' => 'required|numeric',
            'lon' => 'required|numeric',
        ]);

        $response = Http::withHeaders(['User-Agent' => 'MixOne/1.0'])
            ->timeout(5)
            ->get("https://nominatim.openstreetmap.org/reverse", [
                'lat' => $request->get('lat'),
                'lon' => $request->get('lon'),
                'format' => 'json',
                'addressdetails' => 1,
            ]);

        return response()->json($response->json());
    }

    public function destroy(Studio $studio): RedirectResponse
    {
        Gate::authorize('delete', $studio);

        $this->deleteStudioAction->execute($studio);
        return redirect()->route('dashboard.studio.myStudios')->with('success', 'Studio supprimé avec succès.');
    }

    public function create(): View
    {
        return view('dashboard.studio.create');
    }

    public function edit(Studio $studio): View|RedirectResponse
    {
        Gate::authorize('update', $studio);

        return view('dashboard.studio.edit', compact('studio'));
    }

    public function update(UpdateRequest $request, Studio $studio): RedirectResponse|JsonResponse
    {
        Gate::authorize('update', $studio);

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
