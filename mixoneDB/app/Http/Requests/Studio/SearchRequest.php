<?php

namespace App\Http\Requests\Studio;

use App\DTOs\StudioSearchDTO;
use Illuminate\Foundation\Http\FormRequest;

class SearchRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

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
        ];
    }

    public function toDTO(): StudioSearchDTO
    {
        return StudioSearchDTO::fromRequest($this);
    }
}
