<?php

namespace App\Actions\Messaging;

use App\DTOs\MessageDTO;
use App\Models\Message;

class SendMessageAction
{
    public function execute(MessageDTO $dto): Message
    {
        return Message::create($dto->toArray());
    }
}
