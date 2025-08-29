<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class UpdateProfileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'fullname' => 'sometimes|string|max:255',
            'username' => 'sometimes|string|unique:users,username,' . auth()->id(),
            'email' => 'sometimes|email|unique:users,email,' . auth()->id(),
            'password' => ['nullable', 'confirmed', Password::min(8)],
            'avatar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ];
    }
}
