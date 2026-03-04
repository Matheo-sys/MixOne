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
            'receiver_id' => [
                'required',
                'exists:users,id',
                function ($attribute, $value, $fail) {
                    if ($value == auth()->id()) {
                        $fail('Vous ne pouvez pas vous envoyer un message à vous-même.');
                    }
                },
            ],
            'message'     => 'required|string|min:1|max:2000',
        ];
    }

    public function messages(): array
    {
        return [
            'receiver_id.required' => 'Le destinataire du message est introuvable.',
            'receiver_id.exists'   => 'Ce destinataire n\'existe plus.',
            'message.required'     => 'Votre message ne peut pas être vide.',
            'message.min'          => 'Votre message doit contenir au moins 1 caractère.',
            'message.max'          => 'Votre message ne peut pas dépasser 2000 caractères.',
        ];
    }

    public function toDTO(): MessageDTO
    {
        return MessageDTO::fromRequest($this);
    }
}
