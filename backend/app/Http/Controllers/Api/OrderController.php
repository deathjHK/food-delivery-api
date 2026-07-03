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
        $user = auth('sanctum')->user();
        $customAddress = $validatedData['delivery_address'] ?? null;

        $deliveryStreet = $customAddress['street'] ?? $user?->delivery_street;
        $deliveryZip = $customAddress['zip'] ?? $user?->delivery_zip;
        $deliveryCity = $customAddress['city'] ?? $user?->delivery_city;

        if (! $deliveryStreet || ! $deliveryZip || ! $deliveryCity) {
            return response()->json([
                'message' => 'Bitte hinterlege eine gültige Lieferadresse.'
            ], 422);
        }

        $order = DB::transaction(function () use ($validatedData, $user, $deliveryStreet, $deliveryZip, $deliveryCity) {
            // 1. Leere Bestellung anlegen (Total Amount berechnen wir gleich)
            $order = Order::create([
                'user_id' => auth('sanctum')->id(), 
                'total_amount' => 0,
                'status' => 'completed',
                
                // Neue Adressfelder aus dem Request einfügen
                'delivery_street' => $validatedData['delivery_street'] ?? null,
                'delivery_zip' => $validatedData['delivery_zip'] ?? null,
                'delivery_city' => $validatedData['delivery_city'] ?? null,
            ]);

            $totalAmount = 0;

            foreach ($validatedData['items'] as $item) {
                $product = Product::findOrFail($item['product_id']);

                $order->items()->create([
                    'product_id' => $product->id,
                    'quantity' => $item['quantity'],
                    'price_at_purchase' => $product->price,
                ]);

                $totalAmount += ($product->price * $item['quantity']);
            }

            $order->update(['total_amount' => $totalAmount]);

            return $order;
        });

        return response()->json([
            'message' => 'Bestellung erfolgreich durchgeführt!',
            'order_id' => $order->id,
            'total_amount' => $order->total_amount,
            'delivery_address' => [
                'street' => $order->delivery_street,
                'zip' => $order->delivery_zip,
                'city' => $order->delivery_city,
            ],
        ], 201);
    }
}
