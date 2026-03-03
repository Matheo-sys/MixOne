<?php

namespace App\DTOs;

use Illuminate\Http\Request;

class ContactDTO
{
    public function __construct(
        public string $name,
        public string $email,
        public string $subject,
        public string $message
    ) {}

    public static function fromRequest(Request $request): self
    {
        return new self(
            name: $request->validated('name'),
            email: $request->validated('email'),
            subject: $request->validated('subject'),
            message: $request->validated('message')
        );
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'subject' => $this->subject,
            'message' => $this->message,
        ];
    }
}
