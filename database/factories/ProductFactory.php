<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->words(2, true),
            'description' => $this->faker->sentence(),
            'price' => $this->faker->randomFloat(2, 2, 25), // Preis zwischen 2.00 und 25.00
            'image_path' => '[https://via.placeholder.com/150](https://via.placeholder.com/150)', // Dummy-Bild URL (Erfüllt Bild-Anforderung)
            'category_id' => Category::factory(), // Erstellt automatisch eine Kategorie, falls keine angegeben
        ];
    }
}