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

        // 2. Unsere echte Liebesbier-Speisekarte definieren
        $menu = [
            'Frühstück & Brunch (bis 12:00 Uhr)' => [
                [
                    'name' => 'Das Liebesbier-Frühstück für Zwei', 
                    'description' => 'Reichhaltige Auswahl an Landschinken, regionalem Käse, hausgemachtem Hummus, Avocadocreme, zwei weichgekochten Eiern, frischem Obst, Joghurt mit Granola, dazu Brotkorb und Croissants.', 
                    'price' => 24.50, 
                    'image_path' => '/images/fruehstueck_duo.jpg'
                ],
                [
                    'name' => 'Shakshuka (Veggie)', 
                    'description' => 'Zwei in pikanter Tomaten-Paprika-Salsa gegarte Eier, verfeinert mit Feta, frischem Koriander und serviert mit gegrilltem Sauerteigbrot.', 
                    'price' => 11.80, 
                    'image_path' => '/images/shakshuka.jpg'
                ],
                [
                    'name' => 'Strammer Max Craft-Style', 
                    'description' => 'Herzhaftes Sauerteigbrot mit krossem Schinken aus der Region, zwei Spiegeleiern und eingelegten Gewürzgurken.', 
                    'price' => 9.50, 
                    'image_path' => '/images/strammer_max.jpg'
                ],
                [
                    'name' => 'Acai-Granola Bowl (Vegan)', 
                    'description' => 'Erfrischendes Acai-Püree getoppt mit hausgemachtem Knuspermüsli, Chiasamen, Kokosraspeln und frischen saisonalen Beeren.', 
                    'price' => 8.90, 
                    'image_path' => '/images/acai_bowl.jpg'
                ],
            ],

            'Mittagstisch (11:30 - 14:00 Uhr)' => [
                [
                    'name' => 'Wechselndes Mittagsgericht (Fleisch/Fisch)', 
                    'description' => 'Unser wöchentlich wechselndes Mittags-Highlight frisch aus der Marktgrafen-Küche. Frag einfach unseren Service!', 
                    'price' => 11.90, 
                    'image_path' => '/images/mittags_fleisch.jpg'
                ],
                [
                    'name' => 'Wechselndes Mittagsgericht (Vegetarisch)', 
                    'description' => 'Kreativ, leicht und vegetarisch oder vegan. Perfekt für die entspannte Mittagspause im Gastgarten.', 
                    'price' => 10.50, 
                    'image_path' => '/images/mittags_veggie.jpg'
                ],
                [
                    'name' => 'Kleiner Mittagssalat mit Kernen', 
                    'description' => 'Knackige Blattsalate mit Haus-Dressing, gerösteten Kernen und frischem Backhaus-Brot.', 
                    'price' => 5.20, 
                    'image_path' => '/images/mittags_salat.jpg'
                ],
            ],

            'Bierbegleiter & Vorspeisen' => [
                [
                    'name' => 'Liebesbier Fritten-Glück', 
                    'description' => 'Knusprige, dicke Pommes mit geschmolzenem Cheddar, Röstzwiebeln und hausgemachter Bacon-Jam.', 
                    'price' => 6.90, 
                    'image_path' => '/images/fritten_glueck.jpg'
                ],
                [
                    'name' => 'Gebackene Oliven & Hummus', 
                    'description' => 'Würziger, hausgemachter Kichererbsen-Hummus mit lauwarm gebackenen Riesenoliven und gegrilltem Sauerteigbrot.', 
                    'price' => 7.80, 
                    'image_path' => '/images/oliven_hummus.jpg'
                ],
                [
                    'name' => 'Beef Tatar vom Weiderind', 
                    'description' => 'Frisch geschnittenes Rindertatar (100g) mit Kapern, eingelegten Schalotten, Senf-Kaviar und Butter-Toast.', 
                    'price' => 14.20, 
                    'image_path' => '/images/beef_tatar.jpg'
                ],
            ],

            'Burger' => [
                [
                    'name' => 'BBQ Bacon Burger', 
                    'description' => 'Mit knusprigem Bacon, geschmorten Bier-Zwiebeln, würzigem Bergkäse und rauchiger Maisel & Friends BBQ-Sauce.', 
                    'price' => 14.50, 
                    'image_path' => '/images/baconburger.jpg'
                ],
                [
                    'name' => 'Veggie Falafel Burger', 
                    'description' => 'Hausgemachtes, knuspriges Falafel-Patty mit cremigem Hummus, Gurken-Relish und veganer Zitronen-Mayo.', 
                    'price' => 11.20, 
                    'image_path' => '/images/veggieburger.jpg'
                ],
            ],

            'Steaks & Hauptgerichte' => [
                [
                    'name' => 'Rumpsteak vom heimischen Weiderind (250g)', 
                    'description' => 'Perfekt medium gegrillt, serviert mit hausgemachter Kräuterbutter, Ofenkartoffel und saurem Sauerrahm.', 
                    'price' => 28.90, 
                    'image_path' => '/images/rumpsteak.jpg'
                ],
                [
                    'name' => 'Gezupftes Schäufele Crossover', 
                    'description' => 'Fränkischer Klassiker modern interpretiert: Zartes Schäufele-Fleisch in Dunkelbiersoße auf cremigem Kartoffel-Wirsing-Stampf.', 
                    'price' => 17.90, 
                    'image_path' => '/images/schaufele.jpg'
                ],
                [
                    'name' => 'Brauhaus Fish & Chips', 
                    'description' => 'Kabeljaufilet im knusprigen Bierteig aus Maisel\'s Weisse, serviert mit Erbsenpüree, Pommes und Remoulade.', 
                    'price' => 16.50, 
                    'image_path' => '/images/fish_chips.jpg'
                ],
                [
                    'name' => 'Urban Art Vegan Bowl', 
                    'description' => 'Quinoa, gebackener Tofu, Süßkartoffel-Wedges, Granatapfelkerne, wilder Brokkoli und cremiges Erdnuss-Dressing.', 
                    'price' => 13.20, 
                    'image_path' => '/images/vegan_bowl.jpg'
                ],
            ],

            'Süßes für danach' => [
                [
                    'name' => 'Warmes Schoko-Malz-Törtchen', 
                    'description' => 'Mit flüssigem Kern, dunklem Stout-Spiegel und einer Kugel cremigem Vanilleeis.', 
                    'price' => 7.50, 
                    'image_path' => '/images/schokotoertchen.jpg'
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

                // --- WEISMAINER PÜLS-BRÄU ---
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
                // Wenn das Produkt schon existiert, werden nur Preis/Beschreibung aktualisiert.
                // Wenn nicht, wird es neu hinzugefügt.
                $category->products()->updateOrCreate(
                    ['name' => $productData['name']], // Suchkriterium
                    $productData // Daten zum Aktualisieren/Anlegen
                );
            }
        }
    }
}