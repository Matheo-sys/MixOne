<?php

namespace App\Enums;

enum ReservationStatus: string
{
    case Pending = 'pending';
    case Confirmed = 'confirmed';
    case Refused = 'refused';
    case Cancelled = 'cancelled';
    case Completed = 'completed';
    case Disputed = 'disputed';

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
        return match($this) {
            self::Pending   => 'En attente',
            self::Confirmed => 'Confirmée',
            self::Refused   => 'Refusée',
            self::Cancelled => 'Annulée',
            self::Completed => 'Terminée',
            self::Disputed  => 'Litige',
        };
    }
}
