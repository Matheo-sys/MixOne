<?php

namespace App\Actions\Contact;

use App\DTOs\ContactDTO;
use App\Mail\ContactMail;
use Illuminate\Support\Facades\Mail;

class SendContactMailAction
{
    /**
     * Exécute l'action d'envoi d'e-mail de contact.
     *
     * @param ContactDTO $dto
     * @return void
     */
    public function executer(ContactDTO $dto): void
    {
        Mail::to('mixone.contact@gmail.com')->send(new ContactMail($dto->enTableau()));
    }
}

