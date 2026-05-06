<?php

namespace App\Http\Controllers;

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
        $this->actionMiseAJourProfil->executer(Auth::user(), $requete->versDTO());

        if ($requete->ajax()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Profil mis à jour avec succès',
                'avatar_url' => Auth::user()->avatar ? asset('storage/' . Auth::user()->avatar) : asset('media/img/misc/avatar-default.png')
            ]);
        }

        return redirect()->back()->with('success', 'Profil mis à jour avec succès');
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
            if ($requete->ajax()) {
                return response()->json([
                    'status' => 'error',
                    'message' => $e->getMessage()
                ], 422);
            }
            return back()->withErrors(['current_password' => $e->getMessage()]);
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

        return redirect('/')->with('success', 'Votre compte a été supprimé avec succès.');
    }
}

