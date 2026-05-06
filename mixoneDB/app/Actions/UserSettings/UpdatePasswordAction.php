<?php

namespace App\Actions\UserSettings;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Exception;

class UpdatePasswordAction
{
    /**
     * Exécute la mise à jour du mot de passe.
     */
    public function executer(User $utilisateur, string $motDePasseActuel, string $nouveauMotDePasse): bool
    {
        if (!Hash::check($motDePasseActuel, $utilisateur->password)) {
            throw new Exception('Le mot de passe actuel est incorrect');
        }

        return $utilisateur->update([
            'password' => Hash::make($nouveauMotDePasse)
        ]);
    }
}

