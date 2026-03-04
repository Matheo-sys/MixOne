<?php

namespace App\Http\Requests\UserSettings;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePasswordRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'current_password'      => 'required',
            'password'              => 'required|min:8|confirmed',
            'password_confirmation' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'current_password.required'      => 'Votre mot de passe actuel est obligatoire.',
            'password.required'              => 'Le nouveau mot de passe est obligatoire.',
            'password.min'                   => 'Le nouveau mot de passe doit contenir au moins 8 caractères.',
            'password.confirmed'             => 'La confirmation du mot de passe ne correspond pas.',
            'password_confirmation.required' => 'La confirmation du mot de passe est obligatoire.',
        ];
    }
}
