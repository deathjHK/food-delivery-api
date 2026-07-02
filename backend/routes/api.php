<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\OrderController;

// Checkout Simulation
Route::post('/checkout', [OrderController::class, 'checkout']);

// Öffentliche Speisekarte
Route::get('/products', [ProductController::class, 'index']);

// Öffentliche Auth-Routen
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// GESCHÜTZTE ROUTEN (Nur mit gültigem Token erreichbar)
Route::middleware('auth:sanctum')->group(function () {
    
    // Aktuellen Benutzer abfragen
    Route::get('/user', function (\Illuminate\Http\Request $request) {
        return $request->user();
    });

    // Logout
    Route::post('/logout', [AuthController::class, 'logout']);
});