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
                'delivery_street' => 'Musterstraße 1',
                'delivery_zip' => '95444',
                'delivery_city' => 'Bayreuth',
            ]
        );

        // 2. Speisekarte inklusive der aktualisierten Weismainer-Vibe-Erfrischungsgetränke
        $menu = [
            'Frühstück & Brunch (Mo-So)' => [
                [
                    'name' => 'Liebesbier Frühstücks- & Brunchbuffet', 
                    'description' => 'Großes All-inclusive-Buffet: Frische Smoothies, hausgemachte süße und herzhafte Aufstriche, verschiedene Müslis und Granola, Auswahl an regionaler (veganer) Wurst und Käse, Antipasti, frisches Backhaus-Brot und Croissants. Inklusive Filterkaffee, Wasser und Säften zur Selbstbedienung.', 
                    'price' => 24.90, 
                    'image_path' => '/images/Liebesbier-Frühstücks-Brunchbuffet.png'
                ],
                [
                    'name' => 'Liebesbier Spiegelei', 
                    'description' => '3 Landeier aus Kasendorf, wahlweise mit körnigem Frischkäse oder Butter, serviert mit frischem Sauerteigbrot.', 
                    'price' => 9.00, 
                    'image_path' => '/images/Liebesbier-Spiegelei.png'
                ],
                [
                    'name' => 'Liebesbier Ruehrei', 
                    'description' => '3 Landeier aus Kasendorf, wahlweise mit körnigem Frischkäse oder Butter, serviert mit frischem Sauerteigbrot.', 
                    'price' => 9.00, 
                    'image_path' => '/images/Liebesbier-Ruehrei.png'
                ],
                [
                    'name' => 'Liebesbier LB-Lieblingsbrot', 
                    'description' => 'Herzhaftes Brot bestrichen mit cremiger Avocadocreme, feinem Pesto und frischer Gartenkresse.', 
                    'price' => 10.50, 
                    'image_path' => '/images/Liebesbier-LB-Lieblingsbrot.png'
                ],
            ],
            'Frühstück & Brunch (extras)' => [    
                [
                    'name' => 'Portion Nutella', 
                    'description' => 'Der süße Klassiker für dein Frühstück.', 
                    'price' => 2.00, 
                    'image_path' => '/images/Portion-Nutella.png'
                ],
                [
                    'name' => 'Portion Honig', 
                    'description' => 'Feiner, süßer Honig.', 
                    'price' => 2.00, 
                    'image_path' => '/images/Portion-Honig.png'
                ],
                [
                    'name' => 'Portion Marmelade', 
                    'description' => 'Fruchtiger Fruchtaufstrich.', 
                    'price' => 2.00, 
                    'image_path' => '/images/Portion-Marmelade.png'
                ],
                [
                    'name' => 'Portion Butter', 
                    'description' => 'Zusätzliche Portion frische Butter.', 
                    'price' => 2.00, 
                    'image_path' => '/images/Portion-Butter.png'
                ],
                [
                    'name' => 'Extra Brötchen', 
                    'description' => 'Ein klassisches, ofenfrisches Weizenbrötchen.', 
                    'price' => 1.00, 
                    'image_path' => '/images/Extra-Broetchen.png'
                ],
                [
                    'name' => 'Extra Körnerbrötchen', 
                    'description' => 'Frisches, ballaststoffreiches Körnerbrötchen.', 
                    'price' => 1.50, 
                    'image_path' => '/images/Extra-Koernerbroetchen.png'
                ],
                [
                    'name' => 'Croissant', 
                    'description' => 'Fluffig-blätteriges Buttercroissant.', 
                    'price' => 2.50, 
                    'image_path' => '/images/Croissant.png'
                ],
                [
                    'name' => 'Obstsalat', 
                    'description' => 'Frisch geschnittene, saisonale Früchte im Becher.', 
                    'price' => 6.90, 
                    'image_path' => '/images/Obstsalat.png'
                ],
                [
                    'name' => 'Obstsalat mit Joghurt', 
                    'description' => 'Frische, saisonale Früchte auf cremigem Naturjoghurt.', 
                    'price' => 7.50, 
                    'image_path' => '/images/Obstsalat-mit-Joghurt.png'
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
                // === AKTUALISIERT: WEISMAINER ERFRISCHUNGSGETRÄNKE (NEUES SPAẞGETRÄNK/VIBE SORTIMENT) ===
                [
                    'name' => 'Weismainer Cola (0,5l)', 
                    'description' => 'Dein Spaßgetränk. Dein Vibe. Der klassische, erfrischende Cola-Genuss mit anregendem Koffein.', 
                    'price' => 3.60, 
                    'image_path' => '/images/weismainer-erfrischungsgetraenke_cola.png'
                ],
                [
                    'name' => 'Weismainer Cola Zero (0,5l)', 
                    'description' => 'Voller Cola-Geschmack, absolut zuckerfrei. Der leichte Vibe ohne Kalorien.', 
                    'price' => 3.60, 
                    'image_path' => '/images/weismainer-erfrischungsgetraenke_mixx-zero.png'
                ],
                [
                    'name' => 'Weismainer Mixx (0,5l)', 
                    'description' => 'Die perfekte Kombination aus spritzig-erfrischender Cola und fruchtiger Orangenlimonade.', 
                    'price' => 3.60, 
                    'image_path' => '/images/weismainer-erfrischungsgetraenke_mixx.png'
                ],
                [
                    'name' => 'Weismainer Mixx Zero (0,5l)', 
                    'description' => 'Der beliebte Cola-Orangen-Mix als zuckerfreie Variante – maximaler Geschmack, null Zucker.', 
                    'price' => 3.60, 
                    'image_path' => '/images/weismainer-erfrischungsgetraenke_cola-zero.png'
                ],
                [
                    'name' => 'Weismainer Mate (0,5l)', 
                    'description' => 'Der ultimative, belebende Mate-Kick mit dem typisch herben und rauchigen Aroma.', 
                    'price' => 3.80, 
                    'image_path' => '/images/weismainer-erfrischungsgetraenke_mate.png'
                ],

                // === JURA QUELLE MINERALWASSER ===
                [
                    'name' => 'Jura Quelle Sprudel (0,5l)', 
                    'description' => 'Natürliches Mineralwasser aus unberührten, tiefen Gesteinsschichten des Juras. Besonders spritzig mit viel Kohlensäure.', 
                    'price' => 3.20, 
                    'image_path' => '/images/Weismainer_Spritzig.png'
                ],
                [
                    'name' => 'Jura Quelle Medium (0,5l)', 
                    'description' => 'Das reine Jura-Mineralwasser mit harmonisch reduzierter Kohlensäure. Sanft und angenehm zu trinken.', 
                    'price' => 3.20, 
                    'image_path' => '/images/Weismainer_Medium.png'
                ],
                [
                    'name' => 'Jura Quelle Naturell (0,5l)', 
                    'description' => 'Gänzlich ohne Kohlensäure. Das stille, naturbelassene Jura Mineralwasser – pur, weich und extrem bekömmlich.', 
                    'price' => 3.20, 
                    'image_path' => '/images/Weismainer_Naturell.png'
                ],

                // === WEISMAINER PÜLS - TRADITIONELLE LIMONADEN & SCHORLEN ===
                [
                    'name' => 'Libella ACE (0,5l)', 
                    'description' => 'Der fruchtige Vitaminkick mit den wertvollen Vitaminen A, C und E. Erfrischend und lecker.', 
                    'price' => 3.80, 
                    'image_path' => '/images/libella-ace.png'
                ],
                [
                    'name' => 'Libella Apfelschorle (0,5l)', 
                    'description' => 'Fruchtige Apfelschorle mit hohem Fruchtsaftanteil. Die perfekte, natürliche Erfrischung ohne zugesetzten Zucker.', 
                    'price' => 3.60, 
                    'image_path' => '/images/libella-apfelschorle.png'
                ],
                [
                    'name' => 'Libella Cola (0,5l)', 
                    'description' => 'Der klassische Cola-Geschmack: Aufregend prickelnd, erfrischend und mit der Extraportion Schwung.', 
                    'price' => 3.50, 
                    'image_path' => '/images/libella-cola.png'
                ],
                [
                    'name' => 'Libella Cola-Mix (0,5l)', 
                    'description' => 'Die perfekte Kombination aus spritziger Cola und fruchtiger Orange. Der zeitlose Klassiker.', 
                    'price' => 3.60, 
                    'image_path' => '/images/libella-cola_mix.png'
                ],
                [
                    'name' => 'Libella Cola-Mix Zero (0,5l)', 
                    'description' => 'Der volle, beliebte Cola-Mix-Geschmack aus Cola und Orange – komplett ohne Zucker und Kalorien.', 
                    'price' => 3.60, 
                    'image_path' => '/images/libella-cola_mix_zero.png'
                ],
                [
                    'name' => 'Libella Cola Zero (0,5l)', 
                    'description' => 'Echter, intensiver Cola-Geschmack mit vollem Aroma, aber absolut zuckerfrei.', 
                    'price' => 3.50, 
                    'image_path' => '/images/libella-cola-zero.png'
                ],
                [
                    'name' => 'Libella Eistee Pfirsich (0,5l)', 
                    'description' => 'Herrlich erfrischender Eistee mit feinstem Pfirsichgeschmack. Am besten eiskalt genießen.', 
                    'price' => 3.70, 
                    'image_path' => '/images/libella-eistee_pfirsich.png'
                ],
                [
                    'name' => 'Libella Fruchtgarten Johannisbeere-Apfel (0,5l)', 
                    'description' => 'Eine harmonische Fruchtsaftkomposition aus herber Johannisbeere und knackigem Apfel.', 
                    'price' => 3.90, 
                    'image_path' => '/images/libella-fruchtgarten-johannisbeere_apfel.png'
                ],
                [
                    'name' => 'Libella Grapefruit Zero (0,5l)', 
                    'description' => 'Herbe, spritzige Grapefruit-Erfrischung. Voller Fruchtgeschmack bei null Zucker.', 
                    'price' => 3.60, 
                    'image_path' => '/images/libella-grapfruit_zero.png'
                ],
                [
                    'name' => 'Libella Iso Sport Zitrone-Grapefruit (0,5l)', 
                    'description' => 'Isotonisches Erfrischungsgetränk mit dem Geschmack von Zitrone und Grapefruit. Ideal für Sport und Alltag.', 
                    'price' => 3.80, 
                    'image_path' => '/images/libella-iso_sport-zitrone_grapefruit.png'
                ],
                [
                    'name' => 'Libella Kirsch (0,5l)', 
                    'description' => 'Fruchtig-süßer Limonadengenuss mit dem vollen, intensiven Aroma roter Kirschen.', 
                    'price' => 3.50, 
                    'image_path' => '/images/libella-kirsch.png'
                ],
                [
                    'name' => 'Libella Multivitamin (0,5l)', 
                    'description' => 'Der exotische Fruchtmix aus vielen wertvollen Früchten und einer gesunden Portion Vitaminen.', 
                    'price' => 3.80, 
                    'image_path' => '/images/libella-multivitamin.png'
                ],
                [
                    'name' => 'Libella Orange (0,5l)', 
                    'description' => 'Der Klassiker unter den Limonaden. Fruchtig, spritzig und mit dem Geschmack sonnengereifter Orangen.', 
                    'price' => 3.50, 
                    'image_path' => '/images/libella-orange.png'
                ],
                [
                    'name' => 'Libella Orange Zero (0,5l)', 
                    'description' => 'Fruchtiger Orangengeschmack, spritzig aufbereitet – komplett ohne Zuckerzusatz.', 
                    'price' => 3.50, 
                    'image_path' => '/images/libella-orange_zero.png'
                ],
                [
                    'name' => 'Libella Zitrone (0,5l)', 
                    'description' => 'Erfrischend saure und spritzige Zitronenlimonade. Der ultimative Durstlöscher an heißen Tagen.', 
                    'price' => 3.50, 
                    'image_path' => '/images/libella-zitrone.png'
                ],

                // --- MAISEL'S WEISSE KLASSIKER ---
                [
                    'name' => 'Maisel\'s Weisse Original (0,5l)', 
                    'description' => 'Die rötlich-leuchtende Weissbierspezialität. Frisch und dynamisch im Geschmack, mit feiner Hefenote und typischem Bananenaroma.', 
                    'price' => 4.50, 
                    'image_path' => '/images/maisels-weisse-original.png'
                ],
                [
                    'name' => 'Maisel\'s Weisse Dunkel (0,5l)', 
                    'description' => 'Herzhaft und würzig. Dunkle Malze verleihen dieser Weissen ein vielschichtiges Aroma von röstigen Nuancen, Karamell und Bitterschokolade.', 
                    'price' => 4.50, 
                    'image_path' => '/images/maisels-weisse-dunkel.png'
                ],
                [
                    'name' => 'Maisel\'s Weisse Kristall (0,5l)', 
                    'description' => 'Kristallklare Frische trifft auf das volle Weissbier-Aroma. Besonders spritzig, elegant perlender Charakter und herrlich belebend.', 
                    'price' => 4.50, 
                    'image_path' => '/images/maisels-weisse-kristall.png'
                ],
                [
                    'name' => 'Maisel\'s Weisse Leicht (0,5l)', 
                    'description' => 'Voller Weissbiergenuss mit deutlich weniger Alkohol. Spritzig, fruchtig und die ideale Erfrischung für zwischendurch.', 
                    'price' => 4.30, 
                    'image_path' => '/images/maisels-weisse-leicht.png'
                ],
                [
                    'name' => 'Maisel\'s Weisse Alkoholfrei (0,5l)', 
                    'description' => 'Das sportliche Weissbier für puren, alkoholfreien Genuss. Vollmundig, vitaminreich und isotonisch mit dem echten Maisel-Geschmack.', 
                    'price' => 4.30, 
                    'image_path' => '/images/maisels-weisse-alkoholfrei.png'
                ],

                // --- MAISEL & FRIENDS (SESSION & CRAFT) ---
                [
                    'name' => 'Maisel & Friends Pale Ale (0,3l)', 
                    'description' => 'Goldgelb, unkompliziert und extrem süffig. Besticht durch ein frisches Aroma von Zitrus und Maracuja sowie eine angenehme Hopfenbittere.', 
                    'price' => 4.50, 
                    'image_path' => '/images/maisel-and-friends-pale-ale.png'
                ],
                [
                    'name' => 'Maisel & Friends IPA (0,3l)', 
                    'description' => 'Intense. Pure. Awesome. Ein charakterstarkes India Pale Ale mit knackig-herber Bittere, spritzigen Grapefruitnoten und trockenem Finish.', 
                    'price' => 4.70, 
                    'image_path' => '/images/mf_ipa.png'
                ],
                [
                    'name' => 'Maisel & Friends URBAN IPA (0,3l)', 
                    'description' => 'Das moderne American IPA für die Stadt. Bringt ein intensives Fruchterlebnis in die Nase, perfekt ausbalanciert mit harmonischer Bittere.', 
                    'price' => 4.50, 
                    'image_path' => '/images/urban-ipa.png'
                ],
                [
                    'name' => 'Maisel & Friends West Coast IPA (0,3l)', 
                    'description' => 'Für echte Hopheads. Kräftige Pinien- und Tropenfruchtnoten treffen auf eine markante, langanhaltende Bittere nach West-Coast-Vorbild.', 
                    'price' => 4.70, 
                    'image_path' => '/images/maisel-and-friends-west-coast-ipa.png'
                ],
                [
                    'name' => 'Maisel & Friends Europhia (0,33l)', 
                    'description' => 'Die perfekte Harmonie aus europäischer Braukunst und modernen Hopfennoten. Ein spritziges, fülliges Geschmackserlebnis mit feiner Fruchtnote.', 
                    'price' => 4.80, 
                    'image_path' => '/images/maiselfriends_europia.png'
                ],
                [
                    'name' => 'Maisel & Friends URBAN IPA Alkoholfrei (0,3l)', 
                    'description' => 'Voller IPA-Charakter komplett ohne Kompromisse. Verbindet erfrischende Zitrusaromen und eine angenehme Bittere zu leichter Leichtigkeit.', 
                    'price' => 4.30, 
                    'image_path' => '/images/maiselfriends_urban-ipa-alkoholfrei.png'
                ],

                // --- BAYREUTHER BIERBRAUEREI (AKTIEN) ---
                [
                    'name' => 'Bayreuther Hell (0,5l)', 
                    'description' => 'Der süffige Klassiker aus der Heimat. Ehrlich, frisch und traditionell hopfig – der absolute Favorit für jede Gelegenheit.', 
                    'price' => 4.50, 
                    'image_path' => '/images/bayreuther-hell-05.png'
                ],
                [
                    'name' => 'Bayreuther Hefe-Weissbier (0,5l)', 
                    'description' => 'Traditionelle obergärige Brauart. Naturtrüb, spritzig-mild und mit einer herrlich ausgewogenen Fruchtnote.', 
                    'price' => 4.50, 
                    'image_path' => '/images/bayreuther-hefe-weissbier.png'
                ],
                [
                    'name' => 'AKTIEN Landbier Fränkisch Dunkel (0,5l)', 
                    'description' => 'Urtypisch fränkisch. Eine traditionsreiche, untergärige Spezialität, angenehm malzwürzig und weich im Abgang.', 
                    'price' => 4.60, 
                    'image_path' => '/images/aktien-landbier-dunkel.png'
                ],
                [
                    'name' => 'AKTIEN Zwick\'l Kellerbier (0,5l)', 
                    'description' => 'Naturtrüb und unfiltriert direkt aus dem Lagerkeller. Vollmundig, samtig und reich an wertvoller Brauhefe.', 
                    'price' => 4.60, 
                    'image_path' => '/images/aktien-zwickl-kellerbier.png'
                ],

                // --- WEISMAINER PÜLS-BRÄU (BIERE) ---
                [
                    'name' => 'Weismainer Vollbier (0,5l)', 
                    'description' => 'Der klassisch-fränkische Genuss. Ein ehrliches Vollbier mit einer feinen Malznote und goldgelber Farbe.', 
                    'price' => 4.40, 
                    'image_path' => '/images/weismainer-vollbier.png'
                ],
                [
                    'name' => 'Weismainer Flechterla Alkoholfrei (0,5l)', 
                    'description' => 'Naturtrüber, bernsteinfarbener Kellerbier-Genuss – komplett alkoholfrei. Die ideale, spritzig-herbe Erfrischung.', 
                    'price' => 4.20, 
                    'image_path' => '/images/weismainer-flechterla-alkoholfrei.png'
                ],
                [
                    'name' => 'Püls-Bräu Weismainer Flechterla (0,5l)', 
                    'description' => 'Die legendäre, naturbelassene Kellerbier-Spezialität aus Weismain. Urig, unfiltriert und unbeschreiblich süffig.', 
                    'price' => 4.60, 
                    'image_path' => '/images/weismainer-flechterla.png'
                ],
                [
                    'name' => 'Weismainer NaturRadler (0,5l)', 
                    'description' => 'Erfrischend und spritzig. Echtes Weismainer Bier kombiniert mit dem Saft reifer Zitronen für den perfekten Durstlöscher.', 
                    'price' => 4.10, 
                    'image_path' => '/images/weismainer-naturradler.png'
                ],
                [
                    'name' => 'Weismainer NaturRadler Alkoholfrei (0,5l)', 
                    'description' => 'Der volle Radler-Geschmack mit natürlicher Zitronenlimonade, aber ganz ohne Alkohol. Kalorienarm und spritzig.', 
                    'price' => 4.00, 
                    'image_path' => '/images/weismainer-naturradler-alkoholfrei.png'
                ],
            ],
        ];

        // 3. Speisekarte intelligent in die Datenbank eintragen
        foreach ($menu as $categoryName => $products) {
            $category = Category::firstOrCreate(['name' => $categoryName]);

            foreach ($products as $productData) {
                // updateOrCreate stellt sicher, dass geänderte Namen/Beschreibungen überschrieben werden
                $category->products()->updateOrCreate(
                    ['name' => $productData['name']], 
                    $productData
                );
            }
        }
    }
}