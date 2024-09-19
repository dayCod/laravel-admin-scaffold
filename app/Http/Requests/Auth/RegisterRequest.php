<?php

declare(strict_types=1);

namespace App\Http\Requests\Auth;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

final class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return !Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:3', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8'],
        ];
    }

    /**
     * Prepare the request data for validation by setting the `email_verified_at` field to the current timestamp.
     *
     * This method is called automatically by Laravel before the validation rules are applied. It is used to
     * pre-process the request data before it is validated.
     */
    public function prepareForValidation()
    {
        $this->merge([
            'email_verified_at' => now()
        ]);
    }
}
