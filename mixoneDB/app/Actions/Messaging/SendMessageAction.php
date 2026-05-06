<?php

namespace App\Actions\Messaging;

use App\DTOs\MessageDTO;
use App\Models\Message;

class SendMessageAction
{
    /**
     * @param MessageDTO $dto
     * @return Message
     */
    public function executer(MessageDTO $dto): Message
    {
        return Message::create($dto->enTableau());
    }
}

