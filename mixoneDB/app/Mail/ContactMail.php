<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * Crée une nouvelle instance de message.
     *
     * @param array $donnees Les données du formulaire de contact.
     */
    public function __construct(
        public readonly array $donnees
    ) {}

    /**
     * Définit l'enveloppe du message (expéditeur, sujet, etc.).
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address(config('mail.from.address'), config('mail.from.name')),
            replyTo: [new Address($this->donnees['email'], $this->donnees['name'])],
            subject: 'Nouveau message de contact : ' . $this->donnees['subject'],
        );
    }

    /**
     * Définit le contenu du message (vue, données).
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.contact',
            with: ['donnees' => $this->donnees],
        );
    }

    /**
     * Définit les pièces jointes du message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}

