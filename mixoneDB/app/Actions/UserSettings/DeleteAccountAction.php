<?php

namespace App\Actions\UserSettings;

use App\Models\User;
use Illuminate\Support\Facades\Storage;
use App\Models\Studio;

class DeleteAccountAction
{
    /**
     * Exécute l'anonymisation du compte (Suppression RGPD).
     */
    public function executer(User $utilisateur): void
    {
        // 1. Supprimer l'avatar de l'utilisateur s'il existe
        if ($utilisateur->avatar) {
            Storage::delete($utilisateur->avatar);
        }

        // 2. Anonymiser les données personnelles
        $utilisateur->username      = 'user_' . uniqid();
        $utilisateur->first_name    = 'Utilisateur';
        $utilisateur->last_name     = 'Anonyme';
        $utilisateur->email         = 'deleted_' . uniqid() . '@mixone.fr';
        $utilisateur->phone         = null;
        $utilisateur->birth_date    = null;
        $utilisateur->about         = null;
        $utilisateur->avatar        = null;
        $utilisateur->address_line1 = null;
        $utilisateur->address_line2 = null;
        $utilisateur->city          = null;
        $utilisateur->state         = null;
        $utilisateur->zipcode       = null;
        
        // Sécuriser l'accès aux colonnes bancaires (au cas où elles n'existeraient pas ou poseraient problème)
        if (isset($utilisateur->bank_name)) $utilisateur->bank_name = null;
        if (isset($utilisateur->iban)) $utilisateur->iban = null;
        if (isset($utilisateur->bic)) $utilisateur->bic = null;
        
        $utilisateur->password      = bcrypt(\Illuminate\Support\Str::random(40)); // Verrouille le compte
        $utilisateur->banned_at     = now(); // On utilise banned_at pour empêcher toute connexion future
        $utilisateur->save();

        // 3. Désactiver ses studios s'il en a (on les cache mais on garde la data pour les factures)
        \App\Models\Studio::where('user_id', $utilisateur->id)->update(['is_verified' => false]);
    }
}

