<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Http\Resources\ProductResource;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        // 1. Basis-Abfrage starten (mit Eager Loading gegen das N+1 Problem)
        $query = Product::with('category');

        // 2. Filter-Logik: Wenn in der URL "?category=Burger" steht, filtern wir danach
        if ($request->has('category')) {
            $categoryName = $request->input('category');
            
            // Wir filtern die Produkte basierend auf dem Namen der verknüpften Kategorie
            $query->whereHas('category', function($q) use ($categoryName) {
                $q->where('name', $categoryName);
            });
        }

        // 3. Daten abrufen
        $products = $query->get();

        // 4. Daten durch unsere "ProductResource" formatieren und als JSON zurückgeben
        return ProductResource::collection($products);
    }
}