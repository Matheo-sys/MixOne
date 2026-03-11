<?php

namespace App\Http\Requests\Reservation;

use App\DTOs\ReservationDTO;
use Illuminate\Foundation\Http\FormRequest;

class CreateReservationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->user()->profile !== 'studio';
    }

    public function rules(): array
    {
        return [
            'studio_id'       => 'required|exists:studios,id',
            'date'            => 'required|date|after_or_equal:today',
            'time_slot'       => 'required|string',
            'number_of_hours' => 'required|integer|min:1',
            'total_price'     => 'required|numeric|min:0',
        ];
    }

    public function messages(): array
    {
        return [
            'studio_id.required'        => 'Le studio est introuvable.',
            'studio_id.exists'          => 'Ce studio n\'existe plus.',
            'date.required'             => 'Veuillez sélectionner une date pour votre réservation.',
            'date.date'                 => 'La date saisie n\'est pas valide.',
            'date.after_or_equal'       => 'La date de réservation doit être aujourd\'hui ou une date future.',
            'number_of_hours.required'  => 'Veuillez indiquer le nombre d\'heures.',
            'number_of_hours.integer'   => 'Le nombre d\'heures doit être un nombre entier.',
            'number_of_hours.min'       => 'Le nombre d\'heures minimum est de 1.',
            'total_price.required'      => 'Le prix total n\'a pas pu être calculé.',
            'total_price.numeric'       => 'Le prix total doit être un nombre.',
            'total_price.min'           => 'Le prix total ne peut pas être négatif.',
        ];
    }

    public function toDTO(): ReservationDTO
    {
        return ReservationDTO::fromRequest($this);
    }
}
