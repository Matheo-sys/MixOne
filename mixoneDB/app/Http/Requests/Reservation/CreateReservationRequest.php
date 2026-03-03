<?php

namespace App\Http\Requests\Reservation;

use App\DTOs\ReservationDTO;
use Illuminate\Foundation\Http\FormRequest;

class CreateReservationRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Only non-studio users can reserve (business logic check handled in controller/action but simple check here is fine)
        return auth()->user()->profile !== 'studio';
    }

    public function rules(): array
    {
        return [
            'time_slot' => 'required|string',
            'studio_id' => 'required|exists:studios,id',
            'date' => 'required|date|after_or_equal:today',
            'number_of_hours' => 'required|integer|min:1',
            'total_price' => 'required|numeric'
        ];
    }

    public function messages(): array
    {
        return [
            'date.required' => 'Veuillez sélectionner une date pour votre réservation.',
            'date.after_or_equal' => 'La date de réservation doit être aujourd\'hui ou une date future.',
            'time_slot.required' => 'Veuillez sélectionner un créneau horaire.',
            'number_of_hours.required' => 'Veuillez indiquer le nombre d\'heures.',
            'number_of_hours.min' => 'Le nombre d\'heures minimum est de 1.'
        ];
    }

    public function toDTO(): ReservationDTO
    {
        return ReservationDTO::fromRequest($this);
    }
}
