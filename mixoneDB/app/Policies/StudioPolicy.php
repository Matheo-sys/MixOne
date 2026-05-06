<?php

namespace App\Policies;

use App\Models\Studio;
use App\Models\User;

class StudioPolicy
{
    /**
     * Seul le propriétaire peut modifier son studio.
     */
    public function mettreAJour(User $utilisateur, Studio $studio): bool
    {
        return $utilisateur->id === $studio->user_id;
    }

    /**
     * Seul le propriétaire peut supprimer son studio.
     */
    public function supprimer(User $utilisateur, Studio $studio): bool
    {
        return $utilisateur->id === $studio->user_id;
    }
}

