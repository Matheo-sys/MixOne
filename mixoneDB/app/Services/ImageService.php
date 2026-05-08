<?php

namespace App\Services;

use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ImageService
{
    private ImageManager $manager;

    public function __construct()
    {
        $this->manager = new ImageManager(new Driver());
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
        $cheminComplet = storage_path('app/public/' . $dossier . '/' . $nomFichier);

        // Assurer que le dossier existe
        if (!file_exists(storage_path('app/public/' . $dossier))) {
            mkdir(storage_path('app/public/' . $dossier), 0755, true);
        }

        // 2. Lire l'image et la traiter
        $image = $this->manager->read($fichier);

        // Redimensionnement intelligent (cover) pour s'adapter au format du site
        // On veut que l'image remplisse le cadre de 1200x800
        $image->cover($largeur, $hauteur);

        // 3. Sauvegarder en format WebP (compressé)
        $image->toWebp(80)->save($cheminComplet);

        return $dossier . '/' . $nomFichier;
    }
}
