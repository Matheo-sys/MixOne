<?php

namespace App\Actions\Studio;

use App\DTOs\StudioDTO;
use App\Models\Studio;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use App\Mail\StudioCreatedMail;

class CreateStudioAction
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
     * @param StudioDTO $dto
     * @return Studio
     */
    public function executer(StudioDTO $dto): Studio
    {
        $donnees = $dto->enTableau();

        // Gérer le téléchargement des images
        foreach ($dto->images as $champ => $fichier) {
            if ($fichier) {
                $donnees[$champ] = $this->serviceImage->traiterImageStudio($fichier);
            }
        }

        // Gérer le géocodage
        $adresseComplete = trim("{$dto->adresse}, {$dto->ville}, {$dto->code_postal}, {$dto->pays}");
        $coordonnees = $this->actionRecupererCoordonnees->executer($adresseComplete);

        if ($coordonnees) {
            $donnees['latitude'] = $coordonnees['latitude'];
            $donnees['longitude'] = $coordonnees['longitude'];
        }

        $studio = Studio::create($donnees);

        // Envoyer l'email de confirmation (si le propriétaire a un email)
        $studio->load('proprietaire');
        if ($studio->proprietaire && $studio->proprietaire->email) {
            try {
                Mail::to($studio->proprietaire->email)->send(new StudioCreatedMail($studio));
            } catch (\Exception $e) {
                // On log l'erreur ou on continue si le mail échoue (ne pas bloquer la création)
                report($e);
            }
        }

        return $studio;
    }
}
