<?php

namespace App\DTOs;

use Illuminate\Http\Request;

class StudioDTO
{
    /**
     * @param string $nom
     * @param string $adresse
     * @param string $code_postal
     * @param string $ville
     * @param string $pays
     * @param float $tarif_horaire
     * @param int $heures_min
     * @param string $description
     * @param array $equipements
     * @param array $horaires_ouverture
     * @param int|null $id_utilisateur
     * @param array $images
     * @param array $images_a_supprimer
     */
    public function __construct(
        public readonly string $nom,
        public readonly string $adresse,
        public readonly string $code_postal,
        public readonly string $ville,
        public readonly string $pays,
        public readonly float $tarif_horaire,
        public readonly int $heures_min,
        public readonly string $description,
        public readonly array $equipements,
        public readonly ?string $autres_equipements,
        public readonly array $horaires_ouverture,
        public readonly ?int $id_utilisateur,
        public readonly array $images,
        public readonly array $images_a_supprimer
    ) {}

    /**
     * Crée une instance depuis une requête validée.
     */
    public static function depuisRequete(Request $requete): self
    {
        return new self(
            nom: $requete->validated('name'),
            adresse: $requete->validated('address'),
            code_postal: $requete->validated('zipcode'),
            ville: $requete->validated('city'),
            pays: $requete->validated('country'),
            tarif_horaire: (float) $requete->validated('hourly_rate'),
            heures_min: (int) $requete->validated('min_hours'),
            description: $requete->validated('description'),
            equipements: (array) ($requete->input('equipment', []) ?? []),
            autres_equipements: $requete->input('other_equipment'),
            horaires_ouverture: (array) ($requete->input('opening_hours', []) ?? []),
            id_utilisateur: auth()->id(),
            images: [
                'image1' => $requete->file('image1'),
                'image2' => $requete->file('image2'),
                'image3' => $requete->file('image3'),
                'image4' => $requete->file('image4'),
                'image5' => $requete->file('image5'),
            ],
            images_a_supprimer: [
                'image1' => $requete->boolean('remove_image1'),
                'image2' => $requete->boolean('remove_image2'),
                'image3' => $requete->boolean('remove_image3'),
                'image4' => $requete->boolean('remove_image4'),
                'image5' => $requete->boolean('remove_image5'),
            ]
        );
    }

    /**
     * Convertit l'objet en tableau.
     */
    public function enTableau(): array
    {
        return [
            'name' => $this->nom,
            'address' => $this->adresse,
            'zipcode' => $this->code_postal,
            'city' => $this->ville,
            'country' => $this->pays,
            'hourly_rate' => $this->tarif_horaire,
            'min_hours' => $this->heures_min,
            'description' => $this->description,
            'equipment' => $this->equipements,
            'other_equipment' => $this->autres_equipements,
            'opening_hours' => $this->horaires_ouverture,
            'user_id' => $this->id_utilisateur,
        ];
    }
}
