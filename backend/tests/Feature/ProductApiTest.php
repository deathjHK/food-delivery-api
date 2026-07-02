<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductApiTest extends TestCase
{
    use RefreshDatabase; // Setzt die Datenbank nach jedem Test automatisch zurück

    public function test_can_fetch_all_products_from_api()
    {
        // 1. Arrange: Bereite Testdaten vor
        $category = Category::factory()->create(['name' => 'Burger']);
        Product::factory()->create([
            'name' => 'Cheeseburger',
            'price' => 5.99,
            'category_id' => $category->id
        ]);

        // 2. Act: Führe einen GET-Request an unsere API aus
        $response = $this->getJson('/api/products');

        // 3. Assert: Prüfe, ob das Ergebnis stimmt
        $response->assertStatus(200) // Ist die API erreichbar? (HTTP 200 OK)
                 ->assertJsonCount(1) // Haben wir genau ein Produkt zurückbekommen?
                 ->assertJsonFragment([ // Stimmen die Werte überein?
                     'name' => 'Cheeseburger',
                     'price' => "5.99"
                 ]);
    }
}