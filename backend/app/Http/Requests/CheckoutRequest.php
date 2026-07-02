<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Jeder darf bestellen (Gäste und eingeloggte User)
    }

    public function rules(): array
    {
        return [
            'items' => 'required|array|min:1', // Mindestens 1 Artikel muss im Warenkorb sein
            'items.*.product_id' => 'required|exists:products,id', // Produkt muss in unserer DB existieren!
            'items.*.quantity' => 'required|integer|min:1|max:50', // Keine abstrusen Mengen
        ];
    }
}