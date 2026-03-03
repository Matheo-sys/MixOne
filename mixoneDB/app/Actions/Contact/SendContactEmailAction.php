<?php

namespace App\Actions\Contact;

use App\DTOs\ContactDTO;
use App\Mail\ContactMail;
use Illuminate\Support\Facades\Mail;

class SendContactEmailAction
{
    public function execute(ContactDTO $dto): void
    {
        Mail::to('mixone.contact@gmail.com')->send(new ContactMail($dto->toArray()));
    }
}
