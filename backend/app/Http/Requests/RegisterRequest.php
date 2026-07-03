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
            // Neue Adressfelder (wir machen sie zwingend erforderlich, da das Frontend sie scheinbar mitschickt)
            'delivery_street' => 'required|string|max:255',
            'delivery_zip' => 'required|string|max:20',
            'delivery_city' => 'required|string|max:255',
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
