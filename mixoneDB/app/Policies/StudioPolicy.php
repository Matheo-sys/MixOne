<?php

namespace App\Policies;

use App\Models\Studio;
use App\Models\User;

class StudioPolicy
{
    /**
     * Seul le propriétaire peut modifier son studio.
     */
    public function update(User $user, Studio $studio): bool
    {
        return $user->id === $studio->user_id;
    }

    /**
     * Seul le propriétaire peut supprimer son studio.
     */
    public function delete(User $user, Studio $studio): bool
    {
        return $user->id === $studio->user_id;
    }
}
