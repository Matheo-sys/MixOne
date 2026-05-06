<?php

namespace App\Actions\UserSettings;

use App\DTOs\UpdateProfileDTO;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class UpdateProfileAction
{
    /**
     * Exécute la mise à jour du profil.
     */
    public function executer(User $utilisateur, UpdateProfileDTO $dto): bool
    {
        $donnees = $dto->enTableau();

        // Gérer la suppression de l'avatar
        if ($dto->remove_avatar) {
            if ($utilisateur->avatar && $utilisateur->avatar !== 'media/img/misc/avatar-1.png') {
                Storage::delete($utilisateur->avatar);
            }
            $utilisateur->avatar = null;
        }
        // Gérer le téléchargement de l'avatar
        elseif ($dto->avatar) {
            if ($utilisateur->avatar && $utilisateur->avatar !== 'media/img/misc/avatar-1.png') {
                Storage::delete($utilisateur->avatar);
            }
            $utilisateur->avatar = $dto->avatar->store('avatars');
        }

        return $utilisateur->fill($donnees)->save();
    }
}

