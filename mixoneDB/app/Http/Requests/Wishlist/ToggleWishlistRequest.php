<?php

namespace App\Http\Requests\Wishlist;

use Illuminate\Foundation\Http\FormRequest;

class ToggleWishlistRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'studio_id' => 'required|exists:studios,id',
        ];
    }
}
