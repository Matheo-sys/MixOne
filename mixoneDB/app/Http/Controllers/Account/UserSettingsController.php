<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;

use App\Actions\UserSettings\UpdateProfileAction;
use App\Actions\UserSettings\UpdatePasswordAction;
use App\Actions\UserSettings\DeleteAccountAction;
use App\Http\Requests\UserSettings\UpdateProfileRequest;
use App\Http\Requests\UserSettings\UpdatePasswordRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;

class UserSettingsController extends Controller
{
    public function __construct(
        private readonly UpdateProfileAction $actionMiseAJourProfil,
        private readonly UpdatePasswordAction $actionMiseAJourMotDePasse,
        private readonly DeleteAccountAction $actionSuppressionCompte
    ) {}

    /**
     * Affiche le formulaire d'édition du profil.
     *
     * @return View
     */
    public function modifier(): View
    {
        return view('dashboard.artist.settings', ['user' => Auth::user()]);
    }

    /**
     * Met à jour le profil de l'utilisateur.
     *
     * @param UpdateProfileRequest $requete
     * @return RedirectResponse|JsonResponse
     */
    public function mettreAJour(UpdateProfileRequest $requete): RedirectResponse|JsonResponse
    {
        try {
            $this->actionMiseAJourProfil->executer(Auth::user(), $requete->versDTO());

            if ($requete->ajax()) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Profil mis à jour avec succès !',
                    'avatar_url' => Auth::user()->avatar ? asset('storage/' . Auth::user()->avatar) : asset('media/img/misc/avatar-default.png')
                ]);
            }

            return redirect()->back()->with('success', 'Profil mis à jour avec succès !');
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error("Erreur mise à jour profil: " . $e->getMessage());
            
            $msg = "Erreur lors de la mise à jour : " . $e->getMessage();
            if ($requete->ajax()) {
                return response()->json(['status' => 'error', 'message' => $msg], 422);
            }
            return redirect()->back()->with('error', $msg);
        }
    }

    /**
     * Met à jour le mot de passe de l'utilisateur.
     *
     * @param UpdatePasswordRequest $requete
     * @return RedirectResponse|JsonResponse
     */
    public function mettreAJourMotDePasse(UpdatePasswordRequest $requete): RedirectResponse|JsonResponse
    {
        try {
            $this->actionMiseAJourMotDePasse->executer(
                Auth::user(),
                $requete->current_password,
                $requete->password
            );

            if ($requete->ajax()) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Mot de passe mis à jour avec succès'
                ]);
            }

            return redirect()->back()->with('success', 'Mot de passe mis à jour avec succès');
        } catch (\Exception $e) {
            $msg = "Erreur : " . $e->getMessage();
            if ($requete->ajax()) {
                return response()->json([
                    'status' => 'error',
                    'message' => $msg
                ], 422);
            }
            return back()->withErrors(['password_error' => $msg]);
        }
    }

    /**
     * Supprime le compte de l'utilisateur.
     *
     * @return RedirectResponse
     */
    public function supprimer(): RedirectResponse
    {
        $utilisateur = Auth::user();
        $this->actionSuppressionCompte->executer($utilisateur);

        Auth::logout();

        return redirect()->route('home')->with('success', 'Votre compte a été supprimé avec succès.');
    }

    /**
     * Exporte les données personnelles de l'utilisateur (Droit à la portabilité).
     *
     * @return JsonResponse
     */
    public function exporterDonnees(): JsonResponse
    {
        $user = Auth::user()->load(['portefeuille', 'listesDeSouhaits']);
        
        $data = [
            'identite' => [
                'username' => $user->username,
                'nom' => $user->last_name,
                'prenom' => $user->first_name,
                'email' => $user->email,
                'telephone' => $user->phone,
                'date_naissance' => $user->birth_date,
            ],
            'adresse' => [
                'ligne1' => $user->address_line1,
                'ligne2' => $user->address_line2,
                'ville' => $user->city,
                'etat' => $user->state,
                'code_postal' => $user->zipcode,
                'pays' => $user->country,
            ],
            'compte' => [
                'cree_le' => $user->created_at->toIso8601String(),
                'profile' => $user->profile,
            ]
        ];

        return response()->json($data, 200, [
            'Content-Disposition' => 'attachment; filename="mes_donnees_mixone.json"',
        ]);
    }
}

