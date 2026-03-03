<?php

namespace App\Http\Controllers;

use App\Actions\UserSettings\UpdateProfileAction;
use App\Actions\UserSettings\UpdatePasswordAction;
use App\Http\Requests\UserSettings\UpdateProfileRequest;
use App\Http\Requests\UserSettings\UpdatePasswordRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;

class UserSettingsController extends Controller
{
    public function __construct(
        private UpdateProfileAction $updateProfileAction,
        private UpdatePasswordAction $updatePasswordAction
    ) {}

    public function edit(): View
    {
        return view('dashboard.artist.settings', ['user' => Auth::user()]);
    }

    public function update(UpdateProfileRequest $request): RedirectResponse|JsonResponse
    {
        $this->updateProfileAction->execute(Auth::user(), $request->toDTO());

        if ($request->ajax()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Profil mis à jour avec succès',
                'avatar_url' => Auth::user()->avatar ? asset('storage/' . Auth::user()->avatar) : asset('media/img/misc/avatar-default.png')
            ]);
        }

        return redirect()->back()->with('success', 'Profil mis à jour avec succès');
    }

    public function updatePassword(UpdatePasswordRequest $request): RedirectResponse|JsonResponse
    {
        try {
            $this->updatePasswordAction->execute(
                Auth::user(),
                $request->current_password,
                $request->password
            );

            if ($request->ajax()) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Mot de passe mis à jour avec succès'
                ]);
            }

            return redirect()->back()->with('success', 'Mot de passe mis à jour avec succès');
        } catch (\Exception $e) {
            if ($request->ajax()) {
                return response()->json([
                    'status' => 'error',
                    'message' => $e->getMessage()
                ], 422);
            }
            return back()->withErrors(['current_password' => $e->getMessage()]);
        }
    }
}
