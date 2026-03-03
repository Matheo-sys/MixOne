<?php

namespace App\Http\Requests\Studio;

use App\DTOs\StudioDTO;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'zipcode' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'hourly_rate' => 'required|numeric|min:0',
            'min_hours' => 'required|integer|min:1',
            'description' => 'required|string',
            'image1' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'image2' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'image3' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'image4' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'remove_image1' => 'nullable|boolean',
            'remove_image2' => 'nullable|boolean',
            'remove_image3' => 'nullable|boolean',
            'remove_image4' => 'nullable|boolean',
        ];
    }

    public function toDTO(): StudioDTO
    {
        return StudioDTO::fromRequest($this);
    }
}
