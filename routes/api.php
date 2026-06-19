<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Product;

// Liefert alle Produkte (Speisekarte) inkl. der zugehörigen Kategorie
Route::get('/products', function () {
    return Product::with('category')->get();
});