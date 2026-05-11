<?php

namespace App\Actions\Studio;

use App\DTOs\StudioDTO;
use App\Models\Studio;
use Illuminate\Support\Facades\Storage;

class UpdateStudioAction
{
    /**
     * @param GetCoordinatesAction $actionRecupererCoordonnees
     * @param \App\Services\ImageService $serviceImage
     */
    public function __construct(
        private GetCoordinatesAction $actionRecupererCoordonnees,
        private \App\Services\ImageService $serviceImage
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

        // Gérer les suppressions d'images (immédiat)
        foreach ($dto->images_a_supprimer as $champ => $doitSupprimer) {
            if ($doitSupprimer) {
                if ($studio->$champ) {
                    Storage::delete($studio->$champ);
                }
                $donnees[$champ] = null;
            }
        }

        // Gérer les NOUVELLES images (modération obligatoire)
        $imagesAAprouver = [];
        foreach ($dto->images as $champ => $fichier) {
            if ($fichier) {
                $imagesAAprouver[$champ] = $this->serviceImage->traiterImageStudio($fichier);
            }
        }

        if (!empty($imagesAAprouver)) {
            // On crée une demande de modération
            \App\Models\StudioImageRequest::create(array_merge(
                ['studio_id' => $studio->id],
                $imagesAAprouver
            ));
            
            // On informe via la session qu'un admin doit valider
            session()->flash('info', 'Vos nouvelles images ont été envoyées pour modération. Elles apparaîtront une fois validées par nos administrateurs.');
        }

        // On ne met PAS à jour les colonnes imageX dans $donnees
        foreach (['image1', 'image2', 'image3', 'image4', 'image5'] as $imgKey) {
            unset($donnees[$imgKey]);
        }

        return $studio->update($donnees);
    }
}

