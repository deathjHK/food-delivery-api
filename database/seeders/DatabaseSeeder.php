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

        // 2. Unsere echte Speisekarte definieren (inkl. aller Speisen und der kompletten Bierauswahl)
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
                
                // ==========================================
                // MAISEL'S WEISSE KLASSIKER
                // ==========================================
                [
                    'name' => 'Maisel\'s Weisse Original (0,5l)', 
                    'description' => 'Die rötlich-leuchtende Weissbierspezialität. Frisch und dynamisch im Geschmack, mit feiner Hefenote und typischem Bananenaroma.', 
                    'price' => 4.50, 
                    'image_path' => '/images/maisels_original.jpg'
                ],
                [
                    'name' => 'Maisel\'s Weisse Dunkel (0,5l)', 
                    'description' => 'Herzhaft und würzig. Dunkle Malze verleihen dieser Weissen ein vielschichtiges Aroma von röstigen Nuancen, Karamell und Bitterschokolade.', 
                    'price' => 4.50, 
                    'image_path' => '/images/maisels_dunkel.jpg'
                ],
                [
                    'name' => 'Maisel\'s Weisse Kristall (0,5l)', 
                    'description' => 'Kristallklare Frische trifft auf das volle Weissbier-Aroma. Besonders spritzig, elegant perlender Charakter und herrlich belebend.', 
                    'price' => 4.50, 
                    'image_path' => '/images/maisels_kristall.jpg'
                ],
                [
                    'name' => 'Maisel\'s Weisse Leicht (0,5l)', 
                    'description' => 'Voller Weissbiergenuss mit deutlich weniger Alkohol. Spritzig, fruchtig und die ideale Erfrischung für zwischendurch.', 
                    'price' => 4.30, 
                    'image_path' => '/images/maisels_leicht.jpg'
                ],
                [
                    'name' => 'Maisel\'s Weisse Alkoholfrei (0,5l)', 
                    'description' => 'Das sportliche Weissbier für puren, alkoholfreien Genuss. Vollmundig, vitaminreich und isotonisch mit dem echten Maisel-Geschmack.', 
                    'price' => 4.30, 
                    'image_path' => '/images/maisels_alkoholfrei.jpg'
                ],

                // ==========================================
                // MAISEL & FRIENDS (SESSION & CRAFT)
                // ==========================================
                [
                    'name' => 'Maisel & Friends Pale Ale (0,3l)', 
                    'description' => 'Goldgelb, unkompliziert und extrem süffig. Besticht durch ein frisches Aroma von Zitrus und Maracuja sowie eine angenehme Hopfenbittere.', 
                    'price' => 4.50, 
                    'image_path' => '/images/friends_paleale.jpg'
                ],
                [
                    'name' => 'Maisel & Friends IPA (0,3l)', 
                    'description' => 'Intense. Pure. Awesome. Ein charakterstarkes India Pale Ale mit knackig-herber Bittere, spritzigen Grapefruitnoten und trockenem Finish.', 
                    'price' => 4.70, 
                    'image_path' => '/images/friends_ipa.jpg'
                ],
                [
                    'name' => 'Maisel & Friends URBAN IPA (0,3l)', 
                    'description' => 'Das moderne American IPA für die Stadt. Bringt ein intensives Fruchterlebnis in die Nase, perfekt ausbalanciert mit harmonischer Bittere.', 
                    'price' => 4.50, 
                    'image_path' => '/images/friends_urbanipa.jpg'
                ],
                [
                    'name' => 'Maisel & Friends West Coast IPA (0,3l)', 
                    'description' => 'Für echte Hopheads. Kräftige Pinien- und Tropenfruchtnoten treffen auf eine markante, langanhaltende Bittere nach West-Coast-Vorbild.', 
                    'price' => 4.70, 
                    'image_path' => '/images/friends_westcoast.jpg'
                ],
                [
                    'name' => 'Maisel & Friends Hoppy Hell (0,5l)', 
                    'description' => 'Bayerische Tradition modern interpretiert. Ein klassisch süffiges, helles Lagerfeuer-Bier mit einem fruchtig-frischen Hopfen-Kick.', 
                    'price' => 4.50, 
                    'image_path' => '/images/friends_hoppyhell.jpg'
                ],
                [
                    'name' => 'Maisel & Friends URBAN IPA Alkoholfrei (0,3l)', 
                    'description' => 'Voller IPA-Charakter komplett ohne Kompromisse. Verbindet erfrischende Zitrusaromen und eine angenehme Bittere zu leichter Leichtigkeit.', 
                    'price' => 4.30, 
                    'image_path' => '/images/friends_urban_alkoholfrei.jpg'
                ],
                [
                    'name' => 'Maisel & Friends Europhia (0,33l)', 
                    'description' => 'Die perfekte Harmonie aus europäischer Braukunst und modernen Hopfennoten. Ein spritziges, fülliges Geschmackserlebnis mit feiner Fruchtnote.', 
                    'price' => 4.80, 
                    'image_path' => '/images/friends_europhia.jpg'
                ],

                // ==========================================
                // BAYREUTHER BIERBRAUEREI (AKTIEN)
                // ==========================================
                [
                    'name' => 'Bayreuther Hell (0,5l)', 
                    'description' => 'Der süffige Klassiker aus der Heimat. Ehrlich, frisch und traditionell hopfig – der absolute Favorit für jede Gelegenheit.', 
                    'price' => 4.50, 
                    'image_path' => '/images/bayreuther_hell.jpg'
                ],
                [
                    'name' => 'Bayreuther Hefe-Weissbier (0,5l)', 
                    'description' => 'Traditionelle obergärige Brauart. Naturtrüb, spritzig-mild und mit einer herrlich ausgewogenen Fruchtnote.', 
                    'price' => 4.50, 
                    'image_path' => '/images/bayreuther_weissbier.jpg'
                ],
                [
                    'name' => 'AKTIEN Landbier Fränkisch Dunkel (0,5l)', 
                    'description' => 'Urtypisch fränkisch. Eine traditionsreiche, untergärige Spezialität, angenehm malzwürzig und weich im Abgang.', 
                    'price' => 4.60, 
                    'image_path' => '/images/aktien_dunkel.jpg'
                ],
                [
                    'name' => 'AKTIEN Zwick\'l Kellerbier (0,5l)', 
                    'description' => 'Naturtrüb und unfiltriert direkt aus dem Lagerkeller. Vollmundig, samtig und reich an wertvoller Brauhefe.', 
                    'price' => 4.60, 
                    'image_path' => '/images/aktien_zwickl.jpg'
                ],
                [
                    'name' => 'AKTIEN Original Landbier Pils (0,5l)', 
                    'description' => 'Feinherb und charaktervoll. Nach klassischer Rezeptur gebraut mit einer feinen, eleganten Hopfennote.', 
                    'price' => 4.50, 
                    'image_path' => '/images/aktien_pils.jpg'
                ],

                // ==========================================
                // WEISMAINER PÜLS-BRÄU
                // ==========================================
                [
                    'name' => 'Weismainer Premium Pils (0,5l)', 
                    'description' => 'Ein edles, feinherbes Pilsner von bester Qualität. Gebraut mit klarem Jurawasser und feinstem Aromahopfen.', 
                    'price' => 4.40, 
                    'image_path' => '/images/weismainer_pils.jpg'
                ],
                [
                    'name' => 'Weismainer Feinherb Alkoholfrei (0,5l)', 
                    'description' => 'Voller Pilsgeschmack, spritzig-herb und komplett alkoholfrei. Die ideale, kalorienarme Erfrischung für Autofahrer.', 
                    'price' => 4.20, 
                    'image_path' => '/images/weismainer_alkoholfrei.jpg'
                ],
                [
                    'name' => 'Weismainer Landbier (0,5l)', 
                    'description' => 'Ehrliches, fränkisches Landbier nach altüberlieferter Rezeptur. Besonders mild, süffig und harmonisch ausbalanciert.', 
                    'price' => 4.40, 
                    'image_path' => '/images/weismainer_landbier.jpg'
                ],
                [
                    'name' => 'Püls-Bräu Flechterla (0,5l)', 
                    'description' => 'Die legendäre, unfiltrierte Zwickel-Spezialität aus Weismain. Urig, naturbelassen und unbeschreiblich süffig im Geschmack.', 
                    'price' => 4.60, 
                    'image_path' => '/images/weismainer_flechterla.jpg'
                ],
                [
                    'name' => 'Weismainer Abt Knauer Bier (0,5l)', 
                    'description' => 'Ein kräftiges, dunkles Festbier zu Ehren der klösterlichen Brautradition. Vollmundig mit ausgeprägten Malzaromen.', 
                    'price' => 4.70, 
                    'image_path' => '/images/weismainer_abt_knauer.jpg'
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