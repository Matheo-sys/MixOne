<?php

namespace App\Mail;

use App\Models\Studio;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class StudioValidatedMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public Studio $studio
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Votre studio a été validé ! - MixOne',
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'emails.studios.validated',
        );
    }
}
