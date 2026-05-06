<?php

namespace App\Mail;

use App\Models\Reservation;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

use Illuminate\Contracts\Queue\ShouldQueue;

class ReservationPaidArtistMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * Crée une nouvelle instance de message.
     *
     * @param Reservation $reservation
     */
    public function __construct(
        public Reservation $reservation
    ) {}

    /**
     * Définit l'enveloppe du message.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Paiement confirmé - Votre demande est envoyée au studio',
        );
    }

    /**
     * Définit le contenu du message.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.reservations.paid_artist',
        );
    }
}

