<?php

namespace App\DTOs;

use Illuminate\Http\Request;

class MessageDTO
{
    /**
     * @param int $id_destinataire
     * @param string $message
     * @param int|null $id_expediteur
     */
    public function __construct(
        public readonly int $id_destinataire,
        public readonly string $message,
        public readonly ?int $id_expediteur = null
    ) {}

    /**
     * Crée une instance depuis une requête validée.
     */
    public static function depuisRequete(Request $requete): self
    {
        return new self(
            id_destinataire: (int) $requete->validated('receiver_id'),
            message: $requete->validated('message'),
            id_expediteur: auth()->id()
        );
    }

    /**
     * Convertit l'objet en tableau.
     */
    public function enTableau(): array
    {
        return [
            'sender_id' => $this->id_expediteur,
            'receiver_id' => $this->id_destinataire,
            'message' => $this->message,
        ];
    }
}

