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
    public function liste(Request $request): View
    {
        $query = Studio::with('proprietaire');

        // Filtre Recherche
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('city', 'like', "%{$search}%")
                  ->orWhereHas('proprietaire', function($qProp) use ($search) {
                      $qProp->where('first_name', 'like', "%{$search}%")
                            ->orWhere('last_name', 'like', "%{$search}%")
                            ->orWhere('username', 'like', "%{$search}%");
                  });
            });
        }

        // Filtre Statut Validation
        if ($request->filled('status')) {
            if ($request->status === 'verified') {
                $query->where('is_verified', true);
            } elseif ($request->status === 'unverified') {
                $query->where('is_verified', false);
            }
        }

        $studios = $query->orderBy('created_at', 'desc')->paginate(20)->withQueryString();
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

