<?php

namespace App\Actions\Wishlist;

use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;

class ToggleWishlistAction
{
    /**
     * Bascule l'état d'un studio dans la liste de souhaits.
     */
    public function executer(int $idStudio): string
    {
        $idUtilisateur = Auth::id();

        $favori = Wishlist::where('user_id', $idUtilisateur)
            ->where('studio_id', $idStudio)
            ->first();

        if ($favori) {
            $favori->delete();
            return 'removed';
        }

        Wishlist::create([
            'user_id' => $idUtilisateur,
            'studio_id' => $idStudio
        ]);

        return 'added';
    }
}

