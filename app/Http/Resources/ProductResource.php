<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        // Hier definieren wir den "Vertrag" (Contract) mit dem Frontend-Team:
        // Genau diese Felder werden sie im JSON erhalten.
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            // Wir wandeln den Preis direkt in einen Float-Wert um (aus der DB kommt oft ein String)
            'price' => (float) $this->price, 
            'image' => $this->image_path,
            // Wir binden den Namen der Kategorie direkt mit ein
            'category' => $this->category->name, 
        ];
    }
}