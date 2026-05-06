<?php

namespace App\Actions\Studio;

use App\DTOs\StudioDTO;
use App\Models\Studio;
use Illuminate\Support\Facades\Storage;

class UpdateStudioAction
{
    /**
     * @param GetCoordinatesAction $actionRecupererCoordonnees
     */
    public function __construct(
        private GetCoordinatesAction $actionRecupererCoordonnees
    ) {}

    /**
     * @param Studio $studio
     * @param StudioDTO $dto
     * @return bool
     */
    public function executer(Studio $studio, StudioDTO $dto): bool
    {
        $donnees = $dto->enTableau();

        // Gérer le géocodage
        $adresseComplete = trim("{$dto->adresse}, {$dto->ville}, {$dto->code_postal}, {$dto->pays}");
        $coordonnees = $this->actionRecupererCoordonnees->executer($adresseComplete);

        if ($coordonnees) {
            $donnees['latitude'] = $coordonnees['latitude'];
            $donnees['longitude'] = $coordonnees['longitude'];
        }

        // Gérer les suppressions et mises à jour d'images
        foreach ($dto->images_a_supprimer as $champ => $doitSupprimer) {
            if ($doitSupprimer) {
                if ($studio->$champ) {
                    Storage::delete($studio->$champ);
                }
                $donnees[$champ] = null;
            }
        }

        foreach ($dto->images as $champ => $fichier) {
            if ($fichier) {
                // Supprimer l'ancienne image si elle existe
                if ($studio->$champ) {
                    Storage::delete($studio->$champ);
                }
                $donnees[$champ] = $fichier->store('uploads/studios');
            }
        }

        return $studio->update($donnees);
    }
}

