<?php

namespace App\DTOs;

use Illuminate\Http\Request;

class MessageDTO
{
    public function __construct(
        public int $receiver_id,
        public string $message,
        public ?int $sender_id = null
    ) {}

    public static function fromRequest(Request $request): self
    {
        return new self(
            receiver_id: (int) $request->validated('receiver_id'),
            message: $request->validated('message'),
            sender_id: auth()->id()
        );
    }

    public function toArray(): array
    {
        return [
            'sender_id' => $this->sender_id,
            'receiver_id' => $this->receiver_id,
            'message' => $this->message,
        ];
    }
}
