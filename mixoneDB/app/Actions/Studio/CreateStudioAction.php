<?php

namespace App\Actions\Studio;

use App\DTOs\StudioDTO;
use App\Models\Studio;
use Illuminate\Support\Facades\Storage;

class CreateStudioAction
{
    /**
     * @param GetCoordinatesAction $actionRecupererCoordonnees
     */
    public function __construct(
        private GetCoordinatesAction $actionRecupererCoordonnees
    ) {}

    /**
     * @param StudioDTO $dto
     * @return Studio
     */
    public function executer(StudioDTO $dto): Studio
    {
        $donnees = $dto->enTableau();

        // Gérer le téléchargement des images
        foreach ($dto->images as $champ => $fichier) {
            if ($fichier) {
                $donnees[$champ] = $fichier->store('uploads/studios');
            }
        }

        // Gérer le géocodage
        $adresseComplete = trim("{$dto->adresse}, {$dto->ville}, {$dto->code_postal}, {$dto->pays}");
        $coordonnees = $this->actionRecupererCoordonnees->executer($adresseComplete);

        if ($coordonnees) {
            $donnees['latitude'] = $coordonnees['latitude'];
            $donnees['longitude'] = $coordonnees['longitude'];
        }

        return Studio::create($donnees);
    }
}

