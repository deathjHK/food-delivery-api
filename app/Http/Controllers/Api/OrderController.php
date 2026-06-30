<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CheckoutRequest;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function checkout(CheckoutRequest $request)
    {
        $validatedData = $request->validated();
        
        // Wir nutzen eine Transaktion für Datensicherheit
        $order = DB::transaction(function () use ($validatedData, $request) {
            
            // 1. Leere Bestellung anlegen (Total Amount berechnen wir gleich)
            $order = Order::create([
                // auth('sanctum')->id() gibt die User-ID zurück, falls ein Token mitgeschickt wurde. Sonst null (Gast).
                'user_id' => auth('sanctum')->id(), 
                'total_amount' => 0,
                'status' => 'completed', // Simulation: Bestellung ist direkt abgeschlossen
            ]);

            $totalAmount = 0;

            // 2. Alle Artikel durchgehen
            foreach ($validatedData['items'] as $item) {
                $product = Product::find($item['product_id']);
                
                // Position in der Zwischentabelle speichern
                $order->items()->create([
                    'product_id' => $product->id,
                    'quantity' => $item['quantity'],
                    'price_at_purchase' => $product->price, // Historischen Preis sichern!
                ]);

                // Gesamtsumme aufaddieren
                $totalAmount += ($product->price * $item['quantity']);
            }

            // 3. Gesamtsumme in der Bestellung aktualisieren
            $order->update(['total_amount' => $totalAmount]);

            return $order;
        });

        // 4. Erfolgreiche Antwort mit der Bestellnummer ans Frontend schicken
        return response()->json([
            'message' => 'Bestellung erfolgreich durchgeführt!',
            'order_id' => $order->id,
            'total_amount' => $order->total_amount
        ], 201);
    }
}