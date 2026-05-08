<?php

namespace App\Mail;

use App\Models\Reservation;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ReservationDisputedMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public Reservation $reservation,
        public string $signaledBy // 'artist' or 'studio'
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Signalement de litige pour la réservation #{{ $reservation->id }} - MixOne',
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'emails.reservations.disputed',
        );
    }
}
