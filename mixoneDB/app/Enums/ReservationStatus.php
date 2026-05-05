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
    public function allowedTransitions(): array
    {
        return match ($this) {
            self::Pending   => [self::Confirmed, self::Refused, self::Cancelled],
            self::Confirmed => [self::Cancelled, self::Completed, self::Disputed],
            default         => [],
        };
    }

    public function canTransitionTo(self $newStatus): bool
    {
        return in_array($newStatus, $this->allowedTransitions(), true);
    }

    /**
     * Normalise une string brute vers l'enum correspondant.
     */
    public static function fromNormalized(string $value): self
    {
        $normalized = mb_convert_case(trim($value), MB_CASE_TITLE, 'UTF-8');

        return self::from($normalized);
    }

    public function label(): string
    {
        return $this->value;
    }
}
