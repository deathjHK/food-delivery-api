<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Einen Test-Admin-User erstellen
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password'), // Erfüllt Anforderung: Passwörter gehasht
        ]);

        // 2. Fünf Kategorien erstellen, und jeder Kategorie 10 Speisen zuweisen
        Category::factory(5)->create()->each(function ($category) {
            Product::factory(10)->create([
                'category_id' => $category->id
            ]);
        });
    }
}