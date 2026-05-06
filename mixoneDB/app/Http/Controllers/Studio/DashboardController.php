<?php

namespace App\Http\Controllers\Studio;

use App\Enums\ReservationStatus;
use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Models\Studio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\View\View;

class DashboardController extends Controller
{
    /**
     * Affiche l'accueil du tableau de bord studio.
     *
     * @return View
     */
    public function afficher(): View
    {
        $utilisateur = Auth::user();
        $reservations = Reservation::pourProprietaireStudio($utilisateur->id)
            ->with(['studio', 'client'])
            ->get();

        // Portefeuille du studio
        $portefeuille = $utilisateur->portefeuille;

        // Gains totaux = réservations terminées
        $totalGagne = $reservations
            ->filter(fn ($r) => $r->status === ReservationStatus::Completed)
            ->sum('price');

        $totalEnAttente = $reservations
            ->filter(fn ($r) => in_array($r->status, [ReservationStatus::Confirmed, ReservationStatus::Pending]))
            ->sum('price');

        // Préparation des données pour le graphe de gains par mois
        $donneesGraphique = $reservations
            ->filter(fn ($r) => $r->status === ReservationStatus::Completed)
            ->groupBy(fn ($r) => $r->created_at->format('M'))
            ->map(fn ($row) => $row->sum('price'));

        return view('dashboard.studio.dashboard', [
            'reservations' => $reservations,
            'portefeuille' => $portefeuille,
            'totalEarned' => $totalGagne,
            'totalPending' => $totalEnAttente,
            'chartData' => $donneesGraphique
        ]);
    }

    /**
     * Affiche la liste des réservations du studio avec filtrage.
     *
     * @param Request $requete
     * @return View
     */
    public function reservations(Request $requete): View
    {
        $recherche = $requete->get('query');

        $requeteBase = Reservation::pourProprietaireStudio(Auth::id())
            ->with(['client', 'studio']);

        if ($recherche) {
            $requeteBase->where(function ($q) use ($recherche) {
                $q->where('reservations.id', 'LIKE', "%{$recherche}%")
                    ->orWhereHas('client', function ($userQuery) use ($recherche) {
                        $userQuery->where('email', 'LIKE', "%{$recherche}%")
                            ->orWhere('first_name', 'LIKE', "%{$recherche}%")
                            ->orWhere('last_name', 'LIKE', "%{$recherche}%");
                    })
                    ->orWhere('reservations.status', 'LIKE', "%{$recherche}%")
                    ->orWhere('reservations.price', 'LIKE', "%{$recherche}%");
            });
        }

        $reservations = $requeteBase->get();

        return view('dashboard.studio.booking', [
            'reservations' => $reservations,
            'query' => $recherche
        ]);
    }

    /**
     * Affiche la liste des studios possédés par l'utilisateur.
     *
     * @return View
     */
    public function listeStudios(): View
    {
        $studios = Studio::where('user_id', Auth::id())->orderBy('created_at', 'desc')->get();
        return view('dashboard.studio.myStudios', compact('studios'));
    }

}
