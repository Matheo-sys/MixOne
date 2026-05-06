<?php

namespace App\Enums;

enum ReservationStatus: string
{
    case Pending = 'En attente';
    case Confirmed = 'Confirmée';
    case Refused = 'Refusée';
    case Cancelled = 'Annulée';
    case Completed = 'Terminée';
    case Disputed = 'Litige';

    /**
     * Transitions autorisées depuis ce statut.
     *
     * @return array<ReservationStatus>
     */
    public function transitionsAutorisees(): array
    {
        return match ($this) {
            self::Pending   => [self::Confirmed, self::Refused, self::Cancelled],
            self::Confirmed => [self::Cancelled, self::Completed, self::Disputed],
            default         => [],
        };
    }

    /**
     * Vérifie si le passage vers un nouveau statut est autorisé.
     */
    public function peutPasserA(self $nouveauStatut): bool
    {
        return in_array($nouveauStatut, $this->transitionsAutorisees(), true);
    }

    /**
     * Normalise une string brute vers l'enum correspondant.
     */
    public static function depuisValeurNormalisee(string $valeur): self
    {
        $normalisee = mb_convert_case(trim($valeur), MB_CASE_TITLE, 'UTF-8');

        return self::from($normalisee);
    }


    public function label(): string
    {
        return $this->value;
    }
}
