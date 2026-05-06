<?php

namespace App\Mail;

use App\Models\Reservation;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewReservationStudioMail extends Mailable
{
    use Queueable, SerializesModels;

    /** @var Reservation */
    public $reservation;

    /**
     * Crée une nouvelle instance de message.
     *
     * @param Reservation $reservation
     */
    public function __construct(Reservation $reservation)
    {
        $this->reservation = $reservation;
    }

    /**
     * Définit l'enveloppe du message.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Nouvelle réservation payée ! 🎉 - ' . $this->reservation->studio->name,
        );
    }

    /**
     * Définit le contenu du message.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.reservation.new_studio',
        );
    }
}

