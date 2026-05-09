<?php

namespace App\Services;

use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ImageService
{
    private ?ImageManager $manager = null;

    /**
     * Initialise le manager d'image à la demande (Lazy Loading)
     * pour éviter de faire planter l'application si l'extension GD est manquante
     * sur une page qui n'utilise pas d'images.
     */
    private function getManager(): ImageManager
    {
        if ($this->manager === null) {
            $this->manager = new ImageManager(new Driver());
        }
        return $this->manager;
    }

    /**
     * Traite et sauvegarde une image de studio.
     *
     * @param UploadedFile $fichier
     * @param string $dossier
     * @param int $largeur
     * @param int $hauteur
     * @return string Chemin relatif de l'image sauvegardée
     */
    public function traiterImageStudio(UploadedFile $fichier, string $dossier = 'uploads/studios', int $largeur = 1200, int $hauteur = 800): string
    {
        // 1. Créer un nom unique en .webp
        $nomFichier = Str::uuid() . '.webp';
        
        // S'assurer que le dossier existe dans le disque public
        if (!Storage::disk('public')->exists($dossier)) {
            Storage::disk('public')->makeDirectory($dossier);
        }

        // 2. Lire l'image et la traiter via le manager lazy-loadé
        $image = $this->getManager()->read($fichier);

        // Redimensionnement intelligent (cover)
        $image->cover($largeur, $hauteur);

        // 3. Encoder en WebP
        $encoded = $image->toWebp(80);

        // 4. Sauvegarder via Storage (plus propre pour Railway/S3)
        Storage::disk('public')->put($dossier . '/' . $nomFichier, (string) $encoded);

        return $dossier . '/' . $nomFichier;
    }
}
