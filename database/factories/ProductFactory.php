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
            'image_path' => 'https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Fmedia0.faz.net%2Fppmedia%2Faktuell%2F1021900142%2F1.8543712%2Fwidth610x580%2Frainer-winkler-aka-drachenlord.jpg&f=1&nofb=1&ipt=6315d86a804ce853c4b352b24c34e8e9a48453a29ed9f3388cefb417255ba8a2', // Dummy-Bild URL (Erfüllt Bild-Anforderung)
            'category_id' => Category::factory(), // Erstellt automatisch eine Kategorie, falls keine angegeben
        ];
    }
}