<?php

namespace App\Actions\UserSettings;

use App\Models\User;
use Illuminate\Support\Facades\Storage;
use App\Models\Studio;

class DeleteAccountAction
{
    /**
     * Exécute la suppression du compte.
     */
    public function executer(User $utilisateur): void
    {
        // 1. Supprimer l'avatar de l'utilisateur s'il existe
        if ($utilisateur->avatar) {
            Storage::delete($utilisateur->avatar);
        }

        // 2. Supprimer les images de tous les studios possédés par l'utilisateur
        $studios = Studio::where('user_id', $utilisateur->id)->get();
        foreach ($studios as $studio) {
            if ($studio->image_path) {
                Storage::delete($studio->image_path);
            }
        }

        // 3. Supprimer l'utilisateur (les cascades en base de données gèrent le reste)
        $utilisateur->delete();
    }
}

