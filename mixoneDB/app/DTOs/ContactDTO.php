<?php

namespace App\DTOs;

use Illuminate\Http\Request;

class ContactDTO
{
    /**
     * Crée une nouvelle instance de ContactDTO.
     *
     * @param string $nom Nom de l'expéditeur.
     * @param string $courriel Adresse e-mail de l'expéditeur.
     * @param string $sujet Sujet du message.
     * @param string $message Contenu du message.
     */
    public function __construct(
        public readonly string $nom,
        public readonly string $courriel,
        public readonly string $sujet,
        public readonly string $message
    ) {}

    /**
     * Crée une instance depuis une requête validée.
     *
     * @param Request $requete
     * @return self
     */
    public static function depuisRequete(Request $requete): self
    {
        return new self(
            nom: $requete->validated('name'),
            courriel: $requete->validated('email'),
            sujet: $requete->validated('subject'),
            message: $requete->validated('message')
        );
    }

    /**
     * Convertit l'objet en tableau.
     *
     * @return array
     */
    public function enTableau(): array
    {
        return [
            'name' => $this->nom,
            'email' => $this->courriel,
            'subject' => $this->sujet,
            'message' => $this->message,
        ];
    }
}

