<?php

namespace App\Http\Requests\Contact;

use App\DTOs\ContactDTO;
use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|min:10',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'    => 'Votre nom est obligatoire.',
            'name.max'         => 'Votre nom ne peut pas dépasser 255 caractères.',
            'email.required'   => 'Votre adresse e-mail est obligatoire.',
            'email.email'      => 'Veuillez saisir une adresse e-mail valide.',
            'subject.required' => 'Le sujet du message est obligatoire.',
            'subject.max'      => 'Le sujet ne peut pas dépasser 255 caractères.',
            'message.required' => 'Le contenu du message est obligatoire.',
            'message.min'      => 'Votre message doit contenir au moins 10 caractères.',
        ];
    }

    public function toDTO(): ContactDTO
    {
        return ContactDTO::fromRequest($this);
    }
}
