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
     * Bascule automatiquement entre Local et S3 selon ta config.
     */
    public function traiterImageStudio(UploadedFile $fichier, string $dossier = 'uploads/studios', int $largeur = 1200, int $hauteur = 800): string
    {
        $nomFichier = Str::uuid() . '.webp';
        $disk = config('filesystems.default'); // Utilise S3 si FILESYSTEM_DISK=s3

        // 1. Préparer le manager
        $image = $this->getManager()->read($fichier);
        $image->cover($largeur, $hauteur);
        $encoded = $image->toWebp(80);

        // 2. Sauvegarder sur le disque configuré
        Storage::disk($disk)->put($dossier . '/' . $nomFichier, (string) $encoded);

        return $dossier . '/' . $nomFichier;
    }
}
