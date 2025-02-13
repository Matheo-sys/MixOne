<?php

namespace App\Http\Requests\Studio;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name'          => 'required',
            'description'   => 'required',
            'address'       => 'required',
            'zipcode'       => 'required',
            'city'          => 'required',
            'country'       => 'required',
            'hourly_rate'   => ['required', 'numeric'],
            'min_hours'     => ['required', 'numeric'],
        ];
    }
}
