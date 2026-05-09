<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Studio;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\StudioValidatedMail;
use App\Mail\StudioRejectedMail;

class StudioController extends Controller
{
    /**
     * Liste des studios.
     */
    public function liste(): View
    {
        $studios = Studio::with('proprietaire')->orderBy('created_at', 'desc')->paginate(20);
        return view('admin.studios.index', compact('studios'));
    }

    /**
     * Supprimer un studio.
     */
    public function supprimer(Studio $studio): RedirectResponse
    {
        $studio->delete();
        return redirect()->route('admin.studios.index')->with('success', 'Studio supprimé avec succès.');
    }

    /**
     * Activer/Désactiver la vérification d'un studio.
     */
    public function basculerVerification(Studio $studio): RedirectResponse
    {
        $studio->is_verified = !$studio->is_verified;
        $studio->save();

        // Envoyer l'email si le studio vient d'être validé
        if ($studio->is_verified) {
            $studio->load('proprietaire');
            if ($studio->proprietaire && $studio->proprietaire->email) {
                try {
                    Mail::to($studio->proprietaire->email)->queue(new StudioValidatedMail($studio));
                } catch (\Exception $e) {
                    report($e);
                }
            }
        } else {
            // Envoyer l'email de refus/modification
            $studio->load('proprietaire');
            if ($studio->proprietaire && $studio->proprietaire->email) {
                try {
                    Mail::to($studio->proprietaire->email)->queue(new StudioRejectedMail($studio));
                } catch (\Exception $e) {
                    report($e);
                }
            }
        }

        $statut = $studio->is_verified ? 'vérifié' : 'non vérifié';
        return redirect()->back()->with('success', "Le studio est désormais $statut.");
    }
}

