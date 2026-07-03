<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $imagePath = $this->image_path;

        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'price' => (float) $this->price,
            'image' => $imagePath,
            'image_url' => $imagePath ? url($imagePath) : null,
            'category' => $this->category->name,
        ];
    }
}
