<?php

namespace App\Services;

use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class ImageService
{
    private ?ImageManager $manager = null;

    /**
     * Initialise le manager d'image à la demande (Lazy Loading)
     */
    private function getManager(): ImageManager
    {
        if ($this->manager === null) {
            $this->manager = new ImageManager(new Driver());
        }
        return $this->manager;
    }

    /**
     * Traite et sauvegarde une image.
     * Supporte Local, S3 et Cloudinary.
     */
    public function traiterImageStudio(UploadedFile $fichier, string $dossier = 'uploads/studios', int $largeur = 1200, int $hauteur = 800): string
    {
        $disk = config('filesystems.default');

        // Cas particulier pour Cloudinary (optimisation maximale)
        if ($disk === 'cloudinary' || env('CLOUDINARY_URL')) {
            $uploadedFile = Cloudinary::upload($fichier->getRealPath(), [
                'folder' => $dossier,
                'transformation' => [
                    'width' => $largeur,
                    'height' => $hauteur,
                    'crop' => 'fill',
                    'format' => 'webp',
                    'quality' => 'auto'
                ]
            ]);
            
            // On retourne soit l'URL complète, soit le public_id selon tes besoins.
            // Pour Laravel Storage, on préfère l'URL sécurisée.
            return $uploadedFile->getSecurePath();
        }

        // Cas classique (Local ou S3)
        $nomFichier = Str::uuid() . '.webp';
        
        $image = $this->getManager()->read($fichier);
        $image->cover($largeur, $hauteur);
        $encoded = $image->toWebp(80);

        Storage::disk($disk)->put($dossier . '/' . $nomFichier, (string) $encoded);

        return $dossier . '/' . $nomFichier;
    }
}
