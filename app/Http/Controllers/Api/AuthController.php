<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    // 1. Registrierung
    public function register(RegisterRequest $request)
    {
        // $request->validated() enthält nur die sicheren, geprüften Daten
        $data = $request->validated();

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']), // Erfüllt: Passwörter gehasht in DB
        ]);

        // Token generieren
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Benutzer erfolgreich registriert',
            'access_token' => $token,
            'token_type' => 'Bearer',
        ], 201); // 201 = Created
    }

    // 2. Login
    public function login(LoginRequest $request)
    {
        $user = User::where('email', $request->email)->first();

        // Prüfen, ob User existiert und Passwort stimmt
        if (! $user || ! Hash::check($request->password, $user->password)) {
            // Wirft sofort einen JSON-Fehler zurück an das Frontend
            throw ValidationException::withMessages([
                'email' => ['Die Anmeldedaten sind inkorrekt.'],
            ]);
        }

        // Altes Token löschen (optional, verhindert unendlich viele offene Sessions)
        $user->tokens()->delete();

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Erfolgreich eingeloggt',
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }

    // 3. Logout (Löscht das aktuelle Token)
    public function logout(Request $request)
    {
        // Löscht das Token, mit dem der User gerade diese Anfrage stellt
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Erfolgreich ausgeloggt'
        ]);
    }
}
