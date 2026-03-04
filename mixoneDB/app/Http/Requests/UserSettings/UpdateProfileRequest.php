<?php

namespace App\Http\Requests\UserSettings;

use App\DTOs\UpdateProfileDTO;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProfileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $user = auth()->user();
        return [
            'username'      => ['nullable', 'string', 'max:255', Rule::unique('users')->ignore($user->id)],
            'first_name'    => 'required|string|max:255',
            'last_name'     => 'required|string|max:255',
            'email'         => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'phone'         => 'nullable|string|max:20',
            'birth_date'    => 'nullable|date',
            'about'         => 'nullable|string|max:1000',
            'address_line1' => 'nullable|string|max:255',
            'address_line2' => 'nullable|string|max:255',
            'city'          => 'nullable|string|max:255',
            'state'         => 'nullable|string|max:255',
            'country'       => 'nullable|string|max:255',
            'zipcode'       => 'nullable|string|max:20',
            'avatar'        => 'nullable|image|mimes:jpeg,png|max:2048',
            'remove_avatar' => 'nullable|boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'first_name.required' => 'Votre prénom est obligatoire.',
            'first_name.max'      => 'Votre prénom ne peut pas dépasser 255 caractères.',
            'last_name.required'  => 'Votre nom de famille est obligatoire.',
            'last_name.max'       => 'Votre nom de famille ne peut pas dépasser 255 caractères.',
            'email.required'      => 'Votre adresse e-mail est obligatoire.',
            'email.email'         => 'Veuillez saisir une adresse e-mail valide.',
            'email.unique'        => 'Cette adresse e-mail est déjà utilisée par un autre compte.',
            'username.unique'     => 'Ce nom d\'utilisateur est déjà pris.',
            'username.max'        => 'Le nom d\'utilisateur ne peut pas dépasser 255 caractères.',
            'phone.max'           => 'Le numéro de téléphone ne peut pas dépasser 20 caractères.',
            'about.max'           => 'La description ne peut pas dépasser 1000 caractères.',
            'avatar.image'        => 'Le fichier doit être une image.',
            'avatar.mimes'        => 'L\'avatar doit être au format JPEG ou PNG.',
            'avatar.max'          => 'L\'avatar ne peut pas dépasser 2 Mo.',
        ];
    }

    public function toDTO(): UpdateProfileDTO
    {
        return UpdateProfileDTO::fromRequest($this);
    }
}
