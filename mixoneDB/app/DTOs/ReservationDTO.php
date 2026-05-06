<?php

namespace App\DTOs;

use Illuminate\Http\Request;

class ReservationDTO
{
    /**
     * @param int $id_studio
     * @param string $date
     * @param string $creneau_horaire
     * @param int $nombre_heures
     * @param float $prix
     * @param int|null $id_utilisateur
     */
    public function __construct(
        public readonly int $id_studio,
        public readonly string $date,
        public readonly string $creneau_horaire,
        public readonly int $nombre_heures,
        public readonly float $prix,
        public readonly ?int $id_utilisateur = null
    ) {}

    /**
     * Crée une instance depuis une requête validée.
     */
    public static function depuisRequete(Request $requete): self
    {
        return new self(
            id_studio: (int) $requete->validated('studio_id'),
            date: $requete->validated('date'),
            creneau_horaire: $requete->validated('time_slot'),
            nombre_heures: (int) $requete->validated('number_of_hours'),
            prix: (float) $requete->validated('total_price'),
            id_utilisateur: auth()->id()
        );
    }

    /**
     * Convertit l'objet en tableau.
     */
    public function enTableau(): array
    {
        return [
            'studio_id' => $this->id_studio,
            'user_id' => $this->id_utilisateur,
            'date' => $this->date,
            'time_slot' => $this->creneau_horaire,
            'number_of_hours' => $this->nombre_heures,
            'price' => $this->prix,
            'status' => 'En attente',
        ];
    }
}

