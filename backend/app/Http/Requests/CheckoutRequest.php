<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1|max:50',
            
            // Neue optionale Adressfelder
            'delivery_street' => 'nullable|string|max:255',
            'delivery_zip' => 'nullable|string|max:20',
            'delivery_city' => 'nullable|string|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'delivery_address.street.regex' => 'Bitte gib Straße und Hausnummer ein, z. B. Musterstraße 12.',
            'delivery_address.zip.regex' => 'Bitte gib eine gültige deutsche PLZ mit 5 Ziffern ein.',
        ];
    }
}
