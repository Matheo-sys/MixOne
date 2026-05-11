<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StudioImageRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ModerationController extends Controller
{
    /**
     * Liste des demandes de modération d'images.
     */
    public function index()
    {
        $requests = StudioImageRequest::with('studio.proprietaire')
            ->where('status', 'pending')
            ->latest()
            ->get();

        return view('admin.moderation.index', compact('requests'));
    }

    /**
     * Approuver une demande.
     */
    public function approve(StudioImageRequest $imageRequest)
    {
        $studio = $imageRequest->studio;
        
        $updates = [];
        foreach (['image1', 'image2', 'image3', 'image4', 'image5'] as $imgKey) {
            if ($imageRequest->$imgKey) {
                // Supprimer l'ancienne image physique si elle existe
                if ($studio->$imgKey) {
                    Storage::delete($studio->$imgKey);
                }
                $updates[$imgKey] = $imageRequest->$imgKey;
            }
        }

        if (!empty($updates)) {
            $studio->update($updates);
        }

        $imageRequest->update(['status' => 'approved']);

        return redirect()->back()->with('success', "Les images du studio {$studio->name} ont été approuvées et mises en ligne.");
    }

    /**
     * Refuser une demande.
     */
    public function reject(Request $request, StudioImageRequest $imageRequest)
    {
        $request->validate([
            'admin_comment' => 'required|string|max:500'
        ]);

        $imageRequest->update([
            'status' => 'rejected',
            'admin_comment' => $request->admin_comment
        ]);

        // On supprime les images physiques refusées pour ne pas encombrer le serveur
        foreach (['image1', 'image2', 'image3', 'image4', 'image5'] as $imgKey) {
            if ($imageRequest->$imgKey) {
                Storage::delete($imageRequest->$imgKey);
            }
        }

        return redirect()->back()->with('error', "La demande pour le studio {$imageRequest->studio->name} a été refusée.");
    }
}
