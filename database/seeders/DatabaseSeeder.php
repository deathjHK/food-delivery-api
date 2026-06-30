<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Einen Test-Nutzer erstellen (für eure Login-Tests)
        User::factory()->create([
            'name' => 'Max Mustermann',
            'email' => 'max@example.com',
            'password' => bcrypt('geheimesPasswort123'),
        ]);

        // 2. Unsere echte Speisekarte definieren
        $menu = [
            'Burger' => [
                [
                    'name' => 'Classic Cheeseburger', 
                    'description' => 'Saftiges Rindfleisch (180g) mit Cheddar, Salat, Tomate und unserer Haus-Sauce.', 
                    'price' => 8.90, 
                    'image_path' => '/images/cheeseburger.jpg'
                ],
                [
                    'name' => 'BBQ Bacon Burger', 
                    'description' => 'Mit knusprigem Bacon, Röstzwiebeln und rauchiger BBQ-Sauce.', 
                    'price' => 10.50, 
                    'image_path' => '/images/baconburger.jpg'
                ],
                [
                    'name' => 'Veggie Falafel Burger', 
                    'description' => 'Hausgemachtes Falafel-Patty mit Hummus und veganer Mayo.', 
                    'price' => 9.20, 
                    'image_path' => '/images/veggieburger.jpg'
                ],
            ],
            'Pizza' => [
                [
                    'name' => 'Pizza Margherita', 
                    'description' => 'Der neapolitanische Klassiker mit San Marzano Tomaten und frischem Mozzarella.', 
                    'price' => 9.50, 
                    'image_path' => '/images/margherita.jpg'
                ],
                [
                    'name' => 'Pizza Diavola', 
                    'description' => 'Scharfe italienische Salami, Jalapeños und rote Zwiebeln.', 
                    'price' => 11.50, 
                    'image_path' => '/images/diavola.jpg'
                ],
            ],
            'Sushi & Bowls' => [
                [
                    'name' => 'Maki Mix (12 Stück)', 
                    'description' => 'Frischer Lachs, Thunfisch und Gurke, serviert mit Wasabi und Ingwer.', 
                    'price' => 12.90, 
                    'image_path' => '/images/maki.jpg'
                ],
                [
                    'name' => 'Salmon Poke Bowl', 
                    'description' => 'Sushi-Reis, frischer Lachs, Edamame, Avocado und Teriyaki-Dressing.', 
                    'price' => 14.50, 
                    'image_path' => '/images/pokebowl.jpg'
                ],
            ],
            'Getränke' => [
                [
                    'name' => 'Coca Cola (0,5l)', 
                    'description' => 'Eiskalt und erfrischend.', 
                    'price' => 2.50, 
                    'image_path' => '/images/cola.jpg'
                ],
                [
                    'name' => 'Hausgemachter Eistee (0,4l)', 
                    'description' => 'Pfirsich-Eistee mit frischer Minze und Zitrone.', 
                    'price' => 4.20, 
                    'image_path' => '/images/eistee.jpg'
                ],
            ]
        ];

        // 3. Die Speisekarte in die Datenbank eintragen
        foreach ($menu as $categoryName => $products) {
            // Kategorie erstellen
            $category = Category::create(['name' => $categoryName]);

            // Alle Produkte dieser Kategorie zuordnen und speichern
            foreach ($products as $productData) {
                $category->products()->create($productData);
            }
        }
    }
}