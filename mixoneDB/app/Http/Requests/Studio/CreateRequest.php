<?php

namespace App\Http\Requests\Studio;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use App\DTOs\StudioDTO;

class CreateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'        => 'required|string|max:255',
            'description' => 'required|string|min:20',
            'address'     => 'required|string|max:255',
            'zipcode'     => 'required|string|max:10',
            'city'        => 'required|string|max:255',
            'country'     => 'required|string|max:255',
            'hourly_rate' => 'required|numeric|min:1',
            'min_hours'   => 'required|integer|min:1|max:24',
            'latitude'    => 'nullable|numeric',
            'longitude'   => 'nullable|numeric',
            'image1'      => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'image2'      => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'image3'      => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'image4'      => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'        => 'Le nom du studio est obligatoire.',
            'name.max'             => 'Le nom ne peut pas dépasser 255 caractères.',
            'description.required' => 'La description du studio est obligatoire.',
            'description.min'      => 'La description doit contenir au moins 20 caractères.',
            'address.required'     => 'L\'adresse du studio est obligatoire.',
            'zipcode.required'     => 'Le code postal est obligatoire.',
            'zipcode.max'          => 'Le code postal ne peut pas dépasser 10 caractères.',
            'city.required'        => 'La ville est obligatoire.',
            'country.required'     => 'Le pays est obligatoire.',
            'hourly_rate.required' => 'Le tarif horaire est obligatoire.',
            'hourly_rate.numeric'  => 'Le tarif horaire doit être un nombre.',
            'hourly_rate.min'      => 'Le tarif horaire doit être d\'au moins 1 €.',
            'min_hours.required'   => 'La durée minimale de réservation est obligatoire.',
            'min_hours.integer'    => 'La durée minimale doit être un nombre entier.',
            'min_hours.min'        => 'La durée minimale doit être d\'au moins 1 heure.',
            'min_hours.max'        => 'La durée minimale ne peut pas dépasser 24 heures.',
            'image1.image'         => 'Le fichier doit être une image.',
            'image1.mimes'         => 'L\'image doit être au format JPEG ou PNG.',
            'image1.max'           => 'L\'image ne peut pas dépasser 2 Mo.',
            'image2.image'         => 'Le fichier doit être une image.',
            'image2.mimes'         => 'L\'image doit être au format JPEG ou PNG.',
            'image2.max'           => 'L\'image ne peut pas dépasser 2 Mo.',
            'image3.image'         => 'Le fichier doit être une image.',
            'image3.mimes'         => 'L\'image doit être au format JPEG ou PNG.',
            'image3.max'           => 'L\'image ne peut pas dépasser 2 Mo.',
            'image4.image'         => 'Le fichier doit être une image.',
            'image4.mimes'         => 'L\'image doit être au format JPEG ou PNG.',
            'image4.max'           => 'L\'image ne peut pas dépasser 2 Mo.',
        ];
    }

    public function toDTO(): StudioDTO
    {
        return StudioDTO::fromRequest($this);
    }
}
