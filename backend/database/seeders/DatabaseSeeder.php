<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. User sicher anlegen (firstOrCreate = Nur anlegen, wenn die E-Mail nicht existiert)
        User::firstOrCreate(
            ['email' => 'max@example.com'], // Suchkriterium
            [
                'name' => 'Max Mustermann',
                'password' => bcrypt('geheimesPasswort123'),
            ]
        );

        // 2. Die vollständige, originale Liebesbier-Speisekarte mit Weismainer Getränken definieren
        $menu = [
            'Frühstück & Brunch (Mo-So)' => [
                [
                    'name' => 'Liebesbier Frühstücks- & Brunchbuffet', 
                    'description' => 'Großes All-inclusive-Buffet: Frische Smoothies, hausgemachte süße und herzhafte Aufstriche, verschiedene Müslis und Granola, Auswahl an regionaler (veganer) Wurst und Käse, Antipasti, frisches Backhaus-Brot und Croissants. Inklusive Filterkaffee, Wasser und Säften zur Selbstbedienung.', 
                    'price' => 24.90, 
                    'image_path' => '/images/fruehstueck_buffet.jpg'
                ],
                [
                    'name' => 'Upgrade: Zwei Eier (Spiegelei oder Rührei)', 
                    'description' => 'Frisch zubereitete Eier nach Wahl von glücklichen Hühnern aus der Region als perfekte Ergänzung zum Buffet.', 
                    'price' => 4.20, 
                    'image_path' => '/images/fruehstueck_eier.jpg'
                ],
                [
                    'name' => 'Upgrade: Portion krosser Bacon', 
                    'description' => 'Knusprig gebratener Bacon als herzhafter Sidekick.', 
                    'price' => 2.90, 
                    'image_path' => '/images/fruehstueck_bacon.jpg'
                ],
            ],

            'Mittagstisch (11:30 - 17:00 Uhr)' => [
                [
                    'name' => 'Wochen-Mittagsgericht: Kreativ & Fleisch/Fisch', 
                    'description' => 'Unser wöchentlich wechselndes, warmes Mittags-Highlight frisch aus der Marktgrafen-Küche.', 
                    'price' => 11.90, 
                    'image_path' => '/images/mittags_fleisch.jpg'
                ],
                [
                    'name' => 'Wochen-Mittagsgericht: Best of Veggie / Vegan', 
                    'description' => 'Kreative, leichtere fleischlose Kreation für die perfekte, entspannte Mittagspause.', 
                    'price' => 10.50, 
                    'image_path' => '/images/mittags_veggie.jpg'
                ],
                [
                    'name' => 'Kleiner Mittagssalat', 
                    'description' => 'Knackige saisonale Blattsalate mit Haus-Dressing und gerösteten Kernen.', 
                    'price' => 5.20, 
                    'image_path' => '/images/mittags_salat.jpg'
                ],
            ],

            'Abendkarte - Bierbegleiter & Vorspeisen' => [
                [
                    'name' => 'Liebesbier Fritten-Glück', 
                    'description' => 'Knusprige, dicke Pommes frites mit geschmolzenem Cheddar-Käse, krossen Röstzwiebeln und unserer hausgemachten Bacon-Jam.', 
                    'price' => 6.90, 
                    'image_path' => '/images/fritten_glueck.jpg'
                ],
                [
                    'name' => 'Hausgemachter Hummus & gebackene Oliven', 
                    'description' => 'Kichererbsen-Hummus mit nativem Olivenöl, lauwarm gebackenen Riesenoliven und gegrilltem Sauerteigbrot.', 
                    'price' => 7.80, 
                    'image_path' => '/images/oliven_hummus.jpg'
                ],
                [
                    'name' => 'Beef Tatar vom heimischen Weiderind', 
                    'description' => 'Handgeschnittenes, mild gewürztes Rindertatar (100g) mit Kapern, eingelegten Schalotten, Senf-Kaviar und krossem Butter-Toast.', 
                    'price' => 14.20, 
                    'image_path' => '/images/beef_tatar.jpg'
                ],
                [
                    'name' => 'Pimientos de Padrón', 
                    'description' => 'Gegrillte milde Minipaprika mit grobem Meersalz und Olivenöl, serviert mit Baguette.', 
                    'price' => 6.50, 
                    'image_path' => '/images/pimientos.jpg'
                ],
                [
                    'name' => 'Knoblauchbrot vom Grill', 
                    'description' => 'Geröstetes Sauerteigbrot mit hausgemachter Knoblauch-Kräuterbutter und Meersalz.', 
                    'price' => 4.80, 
                    'image_path' => '/images/knoblauchbrot.jpg'
                ],
            ],

            'Abendkarte - Salate & Bowls' => [
                [
                    'name' => 'Urban Art Vegan Bowl', 
                    'description' => 'Nahrhafte Quinoa-Basis mit gebackenem Tofu, Süßkartoffel-Wedges, Granatapfelkernen, wildem Brokkoli und cremigem Erdnuss-Dressing.', 
                    'price' => 13.20, 
                    'image_path' => '/images/vegan_bowl.jpg'
                ],
                [
                    'name' => 'Liebesbier Caesar Salad', 
                    'description' => 'Knackiger Römersalat mit cremigem Caesar-Dressing, krossen Croûtons und gehobeltem Parmesan.', 
                    'price' => 11.50, 
                    'image_path' => '/images/caesar_salad.jpg'
                ],
                [
                    'name' => 'Upgrade zur Bowl/Salat: Gegrillte Hähnchenbrust', 
                    'description' => 'Saftig marinierte Streifen von der Hähnchenbrust frisch vom Grill.', 
                    'price' => 4.90, 
                    'image_path' => '/images/upgrade_haehnchen.jpg'
                ],
            ],

            'Abendkarte - Verrückte Burger' => [
                [
                    'name' => 'Der Liebesbier-Burger', 
                    'description' => '180g saftiges Rindfleisch vom regionalen Weiderind, würziger Bergkäse, geschmorte Bier-Zwiebeln, frischer Salat und unsere rauchige Maisel & Friends BBQ-Sauce auf softem Brioche-Bun.', 
                    'price' => 14.50, 
                    'image_path' => '/images/liebesbier_burger.jpg'
                ],
                [
                    'name' => 'Classic Cheeseburger', 
                    'description' => '180g heimisches Weiderind mit geschmolzenem Cheddar, knackigem Salat, Tomate, Gurke und unserer geheimen Haus-Sauce.', 
                    'price' => 12.90, 
                    'image_path' => '/images/cheeseburger.jpg'
                ],
                [
                    'name' => 'Veggie Falafel Burger', 
                    'description' => 'Hausgemachtes, krosses Falafel-Patty mit cremigem Hummus, Gurken-Relish und veganer Zitronen-Mayonnaise.', 
                    'price' => 11.20, 
                    'image_path' => '/images/veggieburger.jpg'
                ],
                [
                    'name' => 'Pulled Pork Craft Burger', 
                    'description' => '12 Stunden slow-cooked Schweineschulter in Pale-Ale-Marinade, mit hausgemachtem knackigen Coleslaw und scharfen Jalapeños.', 
                    'price' => 15.20, 
                    'image_path' => '/images/pulled_pork.jpg'
                ],
                [
                    'name' => 'Upgrade: Glutenfreies Burger-Brötchen', 
                    'description' => 'Unser Burger-Upgrade aus Reis- und Maismehl für Allergiker.', 
                    'price' => 1.20, 
                    'image_path' => '/images/upgrade_glutenfrei.jpg'
                ],
                [
                    'name' => 'Upgrade: Zusätzliches Rindfleisch-Patty', 
                    'description' => 'Noch hungrig? Wir packen dir ein zweites 180g Weiderind-Patty auf deinen Burger.', 
                    'price' => 6.90, 
                    'image_path' => '/images/upgrade_patty.jpg'
                ],
            ],

            'Abendkarte - Steaks & Hauptgerichte' => [
                [
                    'name' => 'Rumpsteak vom heimischen Weiderind (250g)', 
                    'description' => 'Auf dem Punkt medium gegrillt, serviert mit hausgemachter Kräuterbutter, einer großen Ofenkartoffel und saurem Sauerrahm.', 
                    'price' => 28.90, 
                    'image_path' => '/images/rumpsteak.jpg'
                ],
                [
                    'name' => 'Gezupftes Schäufele Crossover', 
                    'description' => 'Tradition trifft Moderne: Zart geschmortes, gezupftes Schäufele-Fleisch in kräftiger Dunkelbiersoße auf cremigem Kartoffel-Wirsing-Stampf.', 
                    'price' => 17.90, 
                    'image_path' => '/images/schaufele.jpg'
                ],
                [
                    'name' => 'Brauhaus Fish & Chips', 
                    'description' => 'Kabeljaufilet im knusprig-luftigen Bierteig aus Maisel\'s Weisse, serviert mit Erbsenpüree, dicken Pommes und Remoulade.', 
                    'price' => 16.50, 
                    'image_path' => '/images/fish_chips.jpg'
                ],
            ],

            'Süßes für danach' => [
                [
                    'name' => 'Warmes Schoko-Malz-Törtchen', 
                    'description' => 'Mit flüssigem Schokoladenkern, dunklem Stout-Bier-Spiegel und einer Kugel cremigen Vanilleeis.', 
                    'price' => 7.50, 
                    'image_path' => '/images/schokotoertchen.jpg'
                ],
                [
                    'name' => 'Affogato al Caffè', 
                    'description' => 'Eine Kugel cremiges Vanilleeis „ertränkt“ in einem heißen, kräftigen Espresso.', 
                    'price' => 3.90, 
                    'image_path' => '/images/affogato.jpg'
                ],
            ],

            'Getränke' => [
                // --- WEISMAINER MINERALBRUNNEN (WASSER) ---
                [
                    'name' => 'Weismainer Püls Jura Quelle Sprudel (0,5l)', 
                    'description' => 'Das natürliche, reine Mineralwasser aus den Tiefen des Jura-Gesteins. Herzhaft prickelnd mit viel Kohlensäure.', 
                    'price' => 3.20, 
                    'image_path' => '/images/weismainer_sprudel.jpg'
                ],
                [
                    'name' => 'Weismainer Püls Jura Quelle Medium (0,5l)', 
                    'description' => 'Natürliches Jura-Mineralwasser, feinperlig und sanft mineralisiert. Der ideale Begleiter zum Essen.', 
                    'price' => 3.20, 
                    'image_path' => '/images/weismainer_medium.jpg'
                ],
                [
                    'name' => 'Weismainer Püls Jura Quelle Naturell (0,5l)', 
                    'description' => 'Stilles Jura-Mineralwasser komplett ohne Kohlensäure. Besonders weich und erfrischend.', 
                    'price' => 3.20, 
                    'image_path' => '/images/weismainer_naturell.jpg'
                ],

                // --- PÜLS ERFRISCHUNGSGETRÄNKE (SOFT DRINKS) ---
                [
                    'name' => 'Weismainer Püls Cola (0,5l)', 
                    'description' => 'Der koffeinhaltige Klassiker aus Weismain. Voller Geschmack und die perfekte süße Erfrischung.', 
                    'price' => 3.60, 
                    'image_path' => '/images/weismainer_cola.jpg'
                ],
                [
                    'name' => 'Weismainer Püls Cola-Mix (0,5l)', 
                    'description' => 'Das fränkische Nationalgetränk: Die perfekte, spritzige Mischung aus Cola und fruchtiger Orangenlimonade.', 
                    'price' => 3.60, 
                    'image_path' => '/images/weismainer_colamix.jpg'
                ],
                [
                    'name' => 'Weismainer Püls Orangenlimonade (0,5l)', 
                    'description' => 'Fruchtig-süße Orangenlimonade mit echtem Fruchtsaftkonzentrat für den vollen Geschmack.', 
                    'price' => 3.60, 
                    'image_path' => '/images/weismainer_orange.jpg'
                ],
                [
                    'name' => 'Weismainer Püls Zitronenlimonade (0,5l)', 
                    'description' => 'Die klassische, glasklare Zitronenlimonade. Spritzig, süß-säuerlich und maximal erfrischend.', 
                    'price' => 3.60, 
                    'image_path' => '/images/weismainer_zitrone.jpg'
                ],
                [
                    'name' => 'Weismainer Püls Apfelschorle (0,5l)', 
                    'description' => 'Fruchtige Schorle mit hohem Apfelsaftanteil und reinem Jura-Mineralwasser. Ohne Zuckerzusatz.', 
                    'price' => 3.90, 
                    'image_path' => '/images/weismainer_apfelschorle.jpg'
                ],
                [
                    'name' => 'Weismainer Püls Iso-Sport Fit (0,5l)', 
                    'description' => 'Isotonisches Erfrischungsgetränk mit Citrus-Geschmack. Kalorienarm und vollgepackt mit wichtigen Vitaminen.', 
                    'price' => 3.80, 
                    'image_path' => '/images/weismainer_isosport.jpg'
                ],
                [
                    'name' => 'Hausgemachter Eistee (0,4l)', 
                    'description' => 'Liebesbier-Spezialität: Pfirsich-Eistee mit frischer Minze und Zitrone.', 
                    'price' => 4.20, 
                    'image_path' => '/images/eistee.jpg'
                ],
                
                // --- MAISEL'S WEISSE KLASSIKER ---
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

                // --- MAISEL & FRIENDS (SESSION & CRAFT) ---
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
                    'name' => 'Maisel & Friends Europhia (0,33l)', 
                    'description' => 'Die perfekte Harmonie aus europäischer Braukunst und modernen Hopfennoten. Ein spritziges, fülliges Geschmackserlebnis mit feiner Fruchtnote.', 
                    'price' => 4.80, 
                    'image_path' => '/images/friends_europhia.jpg'
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

                // --- BAYREUTHER BIERBRAUEREI (AKTIEN) ---
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

                // --- WEISMAINER PÜLS-BRÄU (BIERE) ---
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

        // 3. Speisekarte intelligent in die Datenbank eintragen
        foreach ($menu as $categoryName => $products) {
            // Kategorie nur anlegen, wenn der Name noch nicht existiert
            $category = Category::firstOrCreate(['name' => $categoryName]);

            // Produkte zuordnen
            foreach ($products as $productData) {
                // updateOrCreate sucht nach dem Namen.
                // Verhindert doppelte Einträge beim wiederholten Ausführen des Seeders.
                $category->products()->updateOrCreate(
                    ['name' => $productData['name']], // Suchkriterium
                    $productData // Daten zum Aktualisieren/Anlegen
                );
            }
        }
    }
}