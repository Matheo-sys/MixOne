<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;

use App\Models\Reservation;
use App\Models\Studio;
use App\Models\User;
use Illuminate\Contracts\View\View;

class AboutController extends Controller
{
    /**
     * Affiche la page "À propos" avec les statistiques de la plateforme.
     *
     * @return View
     */
    public function afficher(): View
    {
        $nombreStudios = Studio::count();
        $nombreUtilisateurs = User::count();
        $nombreReservations = Reservation::count();

        // Agrégation SQL directe pour les évaluations
        $totalEvaluations = Reservation::whereNotNull('rating')->count();
        $evaluationsSatisfaites = Reservation::whereNotNull('rating')->where('rating', '>=', 4)->count();

        $pourcentageSatisfaction = $totalEvaluations > 0
            ? round(($evaluationsSatisfaites / $totalEvaluations) * 100)
            : 99; // Valeur par défaut si aucune évaluation

        return view('pages.about', [
            'nombreStudios' => $nombreStudios,
            'nombreUtilisateurs' => $nombreUtilisateurs,
            'nombreReservations' => $nombreReservations,
            'pourcentageSatisfaction' => $pourcentageSatisfaction
        ]);

    }

}
