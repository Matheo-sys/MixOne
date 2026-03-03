<?php

namespace App\Http\Requests\Messaging;

use App\DTOs\MessageDTO;
use Illuminate\Foundation\Http\FormRequest;

class SendMessageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'receiver_id' => 'required|exists:users,id',
            'message' => 'required|string',
        ];
    }

    public function toDTO(): MessageDTO
    {
        return MessageDTO::fromRequest($this);
    }
}
