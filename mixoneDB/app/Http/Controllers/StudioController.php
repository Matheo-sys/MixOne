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
    /**
     * @param CreateStudioAction $actionCreerStudio
     * @param UpdateStudioAction $actionMettreAJourStudio
     * @param DeleteStudioAction $actionSupprimerStudio
     * @param SearchStudiosAction $actionRechercherStudios
     */
    public function __construct(
        private readonly CreateStudioAction $actionCreerStudio,
        private readonly UpdateStudioAction $actionMettreAJourStudio,
        private readonly DeleteStudioAction $actionSupprimerStudio,
        private readonly SearchStudiosAction $actionRechercherStudios
    ) {}

    /**
     * Afficher la page d'un studio.
     *
     * @param Studio $studio
     * @return View
     */
    public function afficher(Studio $studio): View
    {
        $studio->load(['proprietaire', 'avis.proprietaire']);
        
        // Par défaut, on regarde pour aujourd'hui
        $jourSemaine = strtolower(now()->format('l'));
        $horairesOuverture = $studio->opening_hours[$jourSemaine] ?? null;
        
        $creneauxHoraires = [];
        if ($horairesOuverture && ($horairesOuverture['is_open'] ?? false)) {
            $debut = $horairesOuverture['start'] ?? '08:00';
            $fin = $horairesOuverture['end'] ?? '22:00';
            
            $tempsDebut = \Carbon\Carbon::createFromFormat('H:i', $debut);
            $tempsFin = \Carbon\Carbon::createFromFormat('H:i', $fin);
            
            while ($tempsDebut->lt($tempsFin)) {
                $creneauxHoraires[] = $tempsDebut->format('H:i');
                $tempsDebut->addHour();
            }
        }

        return view('pages.studio.show', compact('studio', 'creneauxHoraires'));
    }

    /**
     * API pour récupérer les créneaux disponibles selon la date.
     *
     * @param Studio $studio
     * @param Request $requete
     * @return JsonResponse
     */
    public function recupererCreneauxDisponibles(Studio $studio, Request $requete): JsonResponse
    {
        $date = $requete->get('date');
        if (!$date) return response()->json([]);

        $jourSemaine = strtolower(\Carbon\Carbon::parse($date)->format('l'));
        $horairesOuverture = $studio->opening_hours[$jourSemaine] ?? null;

        $creneauxHoraires = [];
        if ($horairesOuverture && ($horairesOuverture['is_open'] ?? false)) {
            $debut = $horairesOuverture['start'] ?? '09:00';
            $fin = $horairesOuverture['end'] ?? '20:00';

            $tempsDebut = \Carbon\Carbon::createFromFormat('H:i', $debut);
            $tempsFin = \Carbon\Carbon::createFromFormat('H:i', $fin);

            while ($tempsDebut->lt($tempsFin)) {
                $creneauxHoraires[] = $tempsDebut->format('H:i');
                $tempsDebut->addHour();
            }
        }

        return response()->json($creneauxHoraires);
    }

    /**
     * Enregistrer un studio.
     *
     * @param CreateRequest $requete
     * @return RedirectResponse|JsonResponse
     */
    public function enregistrer(CreateRequest $requete): RedirectResponse|JsonResponse
    {
        try {
            $studio = $this->actionCreerStudio->executer($requete->versDTO());
            $studio->load('proprietaire');

            // Notifier les Admins
            $administrateurs = User::where('is_admin', true)->get();
            Notification::send($administrateurs, new NewStudioCreated($studio));

            if ($requete->ajax()) {
                return response()->json(['status' => 'success', 'message' => 'Votre studio a été ajouté avec succès !', 'redirect' => route('dashboard.studio.myStudios')]);
            }
            return redirect()->route('dashboard.studio.myStudios')
                ->with('success', 'Votre studio a été ajouté avec succès !');
        } catch (\Exception $e) {
            if ($requete->ajax()) {
                return response()->json(['status' => 'error', 'message' => 'Erreur lors de la création du studio. Veuillez vérifier les informations.'], 422);
            }
            return redirect()->route('studio.create')
                ->withInput()
                ->with('active_tab', '2')
                ->withErrors(['address_not_found' => 'Erreur lors de la création du studio. Veuillez vérifier les informations.']);
        }
    }

    /**
     * Afficher tous les studios (sans filtre).
     *
     * @return View
     */
    public function index(): View
    {
        $requeteBase = Studio::with('proprietaire')
            ->withCount('reservationsTerminees')
            ->withAvg('reservationsTerminees', 'rating')
            ->where('is_verified', true);

        $studios = (clone $requeteBase)->paginate(20);
        $studiosCarte = (clone $requeteBase)->get();

        $idsFavoris = auth()->check() ? auth()->user()->studiosFavoris()->pluck('studios.id')->toArray() : [];

        return view('pages.studio_list', [
            'studios'           => $studios,
            'studiosCarte'      => $studiosCarte,
            'idsFavoris'        => $idsFavoris,
            'latitude'          => 0,
            'longitude'         => 0,
            'distance'          => 50,
            'heuresMin'         => null,
            'ville'             => '',
            'trierPar'          => 'distance',
            'directionTri'      => 'asc',
            'equipementsSelectionnes' => [],
        ]);
    }

    /**
     * Rechercher des studios en fonction des filtres.
     *
     * @param SearchRequest $requete
     * @return View
     */
    public function rechercher(SearchRequest $requete): View
    {
        $resultat = $this->actionRechercherStudios->executer($requete->versDTO());
        $dto = $requete->versDTO();

        $idsFavoris = auth()->check() ? auth()->user()->studiosFavoris()->pluck('studios.id')->toArray() : [];

        return view('pages.studio_list', array_merge($resultat, [
            'idsFavoris'        => $idsFavoris,
            'distance'          => $dto->distance,
            'heuresMin'         => $dto->heures_min,
            'ville'             => $dto->ville,
            'trierPar'          => $dto->trier_par,
            'directionTri'      => $dto->direction_tri,
            'equipementsSelectionnes' => $dto->equipements,
        ]));
    }

    /**
     * Proxy de recherche géo (Nom -> Coords).
     *
     * @param Request $requete
     * @return JsonResponse
     */
    public function rechercherGeocode(Request $requete): JsonResponse
    {
        $requete->validate(['q' => 'required|string|max:255']);

        $recherche = $requete->get('q');

        $reponse = Http::withHeaders(['User-Agent' => 'MixOne/1.0'])
            ->timeout(5)
            ->get("https://nominatim.openstreetmap.org/search", [
                'q' => $recherche,
                'format' => 'json',
                'limit' => 1,
            ]);

        return response()->json($reponse->json());
    }

    /**
     * Proxy de recherche inverse (Coords -> Nom).
     *
     * @param Request $requete
     * @return JsonResponse
     */
    public function geocodeInverse(Request $requete): JsonResponse
    {
        $requete->validate([
            'lat' => 'required|numeric',
            'lon' => 'required|numeric',
        ]);

        $reponse = Http::withHeaders(['User-Agent' => 'MixOne/1.0'])
            ->timeout(5)
            ->get("https://nominatim.openstreetmap.org/reverse", [
                'lat' => $requete->get('lat'),
                'lon' => $requete->get('lon'),
                'format' => 'json',
                'addressdetails' => 1,
            ]);

        return response()->json($reponse->json());
    }

    /**
     * @param Studio $studio
     * @return RedirectResponse
     */
    public function supprimer(Studio $studio): RedirectResponse
    {
        Gate::authorize('supprimer', $studio);

        $this->actionSupprimerStudio->executer($studio);
        return redirect()->route('dashboard.studio.myStudios')->with('success', 'Studio supprimé avec succès.');
    }

    /**
     * @return View
     */
    public function creer(): View
    {
        return view('dashboard.studio.create');
    }

    /**
     * @param Studio $studio
     * @return View|RedirectResponse
     */
    public function modifier(Studio $studio): View|RedirectResponse
    {
        Gate::authorize('mettreAJour', $studio);

        return view('dashboard.studio.edit', compact('studio'));
    }

    /**
     * @param UpdateRequest $requete
     * @param Studio $studio
     * @return RedirectResponse|JsonResponse
     */
    public function mettreAJour(UpdateRequest $requete, Studio $studio): RedirectResponse|JsonResponse
    {
        Gate::authorize('mettreAJour', $studio);

        try {
            $this->actionMettreAJourStudio->executer($studio, $requete->versDTO());
            if ($requete->ajax()) {
                return response()->json(['status' => 'success', 'message' => 'Studio modifié avec succès !']);
            }
            return redirect()->route('dashboard.studio.edit', $studio)->with('success', 'Studio modifié avec succès !');
        } catch (\Exception $e) {
            if ($requete->ajax()) {
                return response()->json(['status' => 'error', 'message' => 'Erreur lors de la mise à jour du studio.'], 422);
            }
            return back()->withErrors(['update_error' => 'Erreur lors de la mise à jour du studio.']);
        }
    }
}

