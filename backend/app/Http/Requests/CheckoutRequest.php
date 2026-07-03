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
            'delivery_address' => 'nullable|array',
            'delivery_address.street' => ['nullable', 'required_with:delivery_address', 'string', 'min:3', 'max:255', 'regex:/^.+\s+[0-9]+[a-zA-Z]?$/'],
            'delivery_address.zip' => ['nullable', 'required_with:delivery_address', 'regex:/^[0-9]{5}$/'],
            'delivery_address.city' => 'nullable|required_with:delivery_address|string|min:2|max:120',
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
