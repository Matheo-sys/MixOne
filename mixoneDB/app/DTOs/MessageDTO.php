<?php

namespace App\DTOs;

use Illuminate\Http\Request;

class MessageDTO
{
    public function __construct(
        public readonly int $receiverId,
        public readonly string $message,
        public readonly ?int $senderId = null
    ) {}

    public static function fromRequest(Request $request): self
    {
        return new self(
            receiverId: (int) $request->validated('receiver_id'),
            message: $request->validated('message'),
            senderId: auth()->id()
        );
    }

    public function toArray(): array
    {
        return [
            'sender_id' => $this->senderId,
            'receiver_id' => $this->receiverId,
            'message' => $this->message,
        ];
    }
}
