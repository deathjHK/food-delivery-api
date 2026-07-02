<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Jeder darf versuchen, sich zu registrieren
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users', // Darf es noch nicht geben!
            'password' => 'required|string|min:8', // Mindestens 8 Zeichen
        ];
    }
}