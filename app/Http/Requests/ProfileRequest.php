<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

final class ProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email,'.Auth::id()],
            'password' => ['nullable', 'min:8']
        ];
    }

    /**
     * Prepares the request data for validation by merging the password field with the authenticated user's password if the password field is empty.
     */
    public function prepareForValidation()
    {
        $this->merge([
            'password' => empty($this->password)
                ? Auth::user()->password
                : $this->password,
        ]);
    }
}
