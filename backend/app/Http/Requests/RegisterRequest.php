<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'delivery_street' => ['required', 'string', 'min:3', 'max:255', 'regex:/^.+\s+[0-9]+[a-zA-Z]?$/'],
            'delivery_zip' => ['required', 'regex:/^[0-9]{5}$/'],
            'delivery_city' => 'required|string|min:2|max:120',
        ];
    }

    public function messages(): array
    {
        return [
            'delivery_street.regex' => 'Bitte gib Straße und Hausnummer ein, z. B. Musterstraße 12.',
            'delivery_zip.regex' => 'Bitte gib eine gültige deutsche PLZ mit 5 Ziffern ein.',
        ];
    }
}
