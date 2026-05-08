<?php

namespace App\Actions\Messaging;

use App\DTOs\MessageDTO;
use App\Models\Message;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewMessageMail;

class SendMessageAction
{
    /**
     * @param MessageDTO $dto
     * @return Message
     */
    public function executer(MessageDTO $dto): Message
    {
        $message = Message::create($dto->enTableau());

        // Envoyer la notification par email au destinataire
        $message->load('destinataire', 'expediteur');
        if ($message->destinataire && $message->destinataire->email) {
            try {
                Mail::to($message->destinataire->email)->queue(new NewMessageMail($message));
            } catch (\Exception $e) {
                // On log l'erreur mais on ne bloque pas l'envoi du message
                report($e);
            }
        }

        return $message;
    }
}

