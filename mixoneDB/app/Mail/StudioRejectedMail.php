<?php

namespace App\Mail;

use App\Models\Studio;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class StudioRejectedMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public Studio $studio,
        public ?string $reason = null
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Des modifications sont nécessaires pour votre studio - MixOne',
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'emails.studios.rejected',
        );
    }
}
