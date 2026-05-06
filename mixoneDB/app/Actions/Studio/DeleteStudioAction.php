<?php

namespace App\Actions\Studio;

use App\Models\Studio;
use Illuminate\Support\Facades\Storage;

class DeleteStudioAction
{
    /**
     * Supprime un studio et nettoie les images associées.
     *
     * @param Studio $studio
     * @return bool
     */
    public function executer(Studio $studio): bool
    {
        // Nettoyage des images
        for ($i = 1; $i <= 4; $i++) {
            $champ = "image{$i}";
            if ($studio->$champ) {
                Storage::delete($studio->$champ);
            }
        }

        return $studio->delete();
    }
}

