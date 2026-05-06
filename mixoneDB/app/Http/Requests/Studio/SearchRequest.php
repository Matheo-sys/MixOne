<?php

namespace App\Http\Requests\Studio;

use App\DTOs\StudioSearchDTO;
use Illuminate\Foundation\Http\FormRequest;

class SearchRequest extends FormRequest
{
    /**
     * Détermine si l'utilisateur est autorisé à effectuer cette requête.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Définit les règles de validation.
     */
    public function rules(): array
    {
        return [
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'distance' => 'nullable|integer|min:0',
            'min_hours' => 'nullable|integer|min:1',
            'city' => 'nullable|string',
            'sort_by' => 'nullable|string|in:distance,price',
            'sort_direction' => 'nullable|string|in:asc,desc',
            'equipment' => 'nullable|array',
            'equipment.*' => 'nullable|string',
            'date' => 'nullable|date',
        ];
    }

    /**
     * Convertit la requête en StudioSearchDTO.
     */
    public function versDTO(): StudioSearchDTO
    {
        return StudioSearchDTO::depuisRequete($this);
    }
}

