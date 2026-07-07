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
                    'image_path' => '/images/Brötchen.png'
                ],
                [
                    'name' => 'Extra Körnerbrötchen', 
                    'description' => 'Frisches, ballaststoffreiches Körnerbrötchen.', 
                    'price' => 1.50, 
                    'image_path' => '/images/Körnerbrötchen.png'
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
            'Mittagstisch (Vorspeisen)' => [
                // --- Vorspeisen ---
                [
                    'name' => 'Kross gebackenes Steinmühlbrot',
                    'description' => 'Ofenfrisches, kross gebackenes Brot aus der regionalen Steinmühle.',
                    'price' => 4.50,
                    'image_path' => '/images/Kross-gebackenes-Steinmuehlbrot.png'
                ],
                [
                    'name' => 'Ziegenkäsemousse',
                    'description' => 'Ziegenfrischkäse, Pfifferlinge, Erdbeere, Sauerampfer und Pflücksalat. [Allergene: a) a.1) c) g) l)]',
                    'price' => 13.50,
                    'image_path' => '/images/Ziegenkaesemousse.png'
                ],
                [
                    'name' => 'Klare Blumenkohlsuppe',
                    'description' => 'Feine Suppe mit Grießnockerln, Käse, Pfifferlingen und Tomate. [Allergene: a) a.1) c) f) g)]',
                    'price' => 8.00,
                    'image_path' => '/images/Klare-Blumenkohlsuppe.png'
                ],
            ],
            'Mittagstisch (HAUPTSPEISEN)' => [
                // --- HAUPTSPEISEN ---
                [
                    'name' => 'Pastrami Sandwich', 
                    'description' => 'Gerösteter Brioche mit saftigem Pastrami, Spitzkohlrahmsalat, Senfkaviar, Meerrettich, Hausfritten und Darkbeer-BBQ-Sauce. [Allergene: a) a.1) a.3) c) f) g) m)]', 
                    'price' => 16.00, 
                    'image_path' => '/images/Pastrami-Sandwich.png'
                ],
                [
                    'name' => 'Überbackener Baggers', 
                    'description' => 'Fränkische Kartoffelpuffer mit Spinat, Pfifferlingen, überbacken mit gereiftem Oberpfälzer Käse an Gemüsejus. [Allergene: a) a.1) c) f) g) l)]', 
                    'price' => 18.00, 
                    'image_path' => '/images/Ueberbackener-Baggers.png'
                ],
                [
                    'name' => 'Hausgemachte Kartoffelnocken', 
                    'description' => 'Frische Kartoffelnocken mit gebratenen Pfifferlingen, Tomate und cremigem Bergkäsefond. [Allergene: a) a.1) c) g) l)]', 
                    'price' => 18.00, 
                    'image_path' => '/images/Hausgemachte-Kartoffelnocken.png'
                ],
                [
                    'name' => 'Hausgemachte Bandnudeln', 
                    'description' => 'Feine Bandnudeln mit Pfifferlingen, Bohnen und Haselnüssen in einer außergewöhnlichen Aprikosen-Miso-Rahmsauce. [Allergene: a) a.1) c) f) g) h.2) l)]', 
                    'price' => 19.00, 
                    'image_path' => '/images/Hausgemachte-Bandnudeln.png'
                ],
                [
                    'name' => '„Montreal Maple“ Bratwurst', 
                    'description' => 'Gewinnerbratwurst vom 13. Fränkischen Bratwurstgipfel! Kreativbratwurst mit Bratensoße, Käse und Ahornsirup, serviert mit Spitzkohlrahmsalat, Röstzwiebelpüree und Ahornsirup-Bratensauce.', 
                    'price' => 15.90, 
                    'image_path' => '/images/Montreal-Maple-Bratwurst.png'
                ],
                [
                    'name' => 'Crispy Chickenburger', 
                    'description' => 'Knuspriges Hähnchen im Briochebun mit Kirschchutney, Pfefferschmand, herzhaftem Bacon, Romanasalat und Tomate. [Allergene: a) a.1) c) f) g) o)]', 
                    'price' => 16.50, 
                    'image_path' => '/images/Crispy-Chickenburger.png'
                ],
                [
                    'name' => 'Bunte Salatbowl', 
                    'description' => 'Knackige Blattsalate der Saison mit Gerstensalat, Rotkohl, Radieschen, Karotte, Tomate, Gurke, Croutons und gerösteten Kürbis- & Sonnenblumenkernen. [Allergene: a) l) m) o)]', 
                    'price' => 12.00, 
                    'image_path' => '/images/Bunte-Salatbowl.png'
                ],
                [
                    'name' => 'Königsberger Klopse', 
                    'description' => 'Klassische Klopse serviert mit knackigem Gemüse, Kartoffelpüree, feiner Kapernsauce und Gemüsechips. [Allergene: a) f) m)]', 
                    'price' => 18.50, 
                    'image_path' => '/images/Koenigsberger-Klopse.png'
                ],
                [
                    'name' => 'Fränkische Fish & Chips', 
                    'description' => 'Fischfilet im luftigen Bierteig knusprig ausgebacken, serviert mit gezupftem Baggers, cremigem Kräuter-Ziebeleskäs und gepickelten Zwiebeln. [Allergene: a) a.1) c) d) g) o)]', 
                    'price' => 24.00, 
                    'image_path' => '/images/Fraenkisch-Fish-Chips.png'
                ],
                [
                    'name' => 'Gezupftes Schäufele', 
                    'description' => 'Langzeit gegarte Schulter vom fränkischen Stroh-Schwein mit gebackenem Knödel, Krautsalat, kräftiger Bierjus, Schnittlauch und knusprigem Schwartenpopcorn.', 
                    'price' => 19.00, 
                    'image_path' => '/images/Gezupftes-Schaeufele.png'
                ],
                [
                    'name' => 'Brezenschnitzel', 
                    'description' => 'Mariniertes Bierschnitzel vom fränkischen Stroh-Schwein in einer Panade aus Brezenbröseln, serviert mit klassischem Kartoffel-Radieschensalat und Frühlingslauch.', 
                    'price' => 21.00, 
                    'image_path' => '/images/Brezenschnitzel.png'
                ],
                [
                    'name' => 'Steak Frites', 
                    'description' => 'Gegrilltes Hüftsteak dünn aufgeschnitten mit würziger Zwiebeljus, Hausfritten, Schmortomate, Chipotlemayo, Röstzwiebeln und Frühlingslauch. [Allergene: a) l) o)]', 
                    'price' => 29.00, 
                    'image_path' => '/images/Steak-Frites.png'
                ],
                [
                    'name' => 'LB-Spareribs', 
                    'description' => 'Langzeit gegarte, butterzarte Baby Back Ribs vom fränkischen Landschwein (ca. 400g) glasiert mit unserer Darkbeer-BBQ-Sauce. [Allergene: a) h.1)]', 
                    'price' => 17.00, 
                    'image_path' => '/images/LB-Spareribs.png'
                ],
                [
                    'name' => 'LB-Burger', 
                    'description' => '100% Frankenbeef (medium gebraten) im Briochebun mit hausgemachter Bacon-Jam, würzigem Käse, Tomate, eingelegten Biergurken, Zwiebeln, frischem Salat und rauchiger Darkbeer-BBQ-Sauce. [Allergene: a) g) o)]', 
                    'price' => 16.00, 
                    'image_path' => '/images/LB-Burger.png'
                ],
                [
                    'name' => 'Jeffs-Burger', 
                    'description' => 'Die pflanzliche Alternative mit Beyond Burger Patty im Sesam Bun, Cheddar Style Veggie-Käse, Tomate, eingelegten Biergurken, Salat, Zwiebeln und Darkbeer-BBQ-Sauce. [Allergene: a) g) o)]', 
                    'price' => 16.00, 
                    'image_path' => '/images/Jeffs-Burger.png'
                ],
            ]    
            'Mittagstisch (BEILAGEN & SAUCEN)' => [
                // --- BEILAGEN & SAUCEN ---
                [
                    'name' => 'Brotkorb (1 Person)', 
                    'description' => 'Frische Brotauswahl als Beilage für eine Person.', 
                    'price' => 1.90, 
                    'image_path' => '/images/Brotkorb-1-Person.png'
                ],
                [
                    'name' => 'Brotkorb (2 Personen)', 
                    'description' => 'Frische Brotauswahl als Beilage für zwei Personen.', 
                    'price' => 2.90, 
                    'image_path' => '/images/Brotkorb-2-Personen.png'
                ],
                [
                    'name' => 'Haus-Fritten mit Darkbeer-BBQ', 
                    'description' => 'Knusprige Hausfritten serviert mit unserer hausgemachten Darkbeer-BBQ-Sauce.', 
                    'price' => 5.00, 
                    'image_path' => '/images/Haus-Fritten-mit-Darkbeer-BBQ.png'
                ],
                [
                    'name' => 'Süßkartoffelpommes mit Darkbeer-BBQ', 
                    'description' => 'Knusprige Süßkartoffelpommes mit unserer hausgemachten Darkbeer-BBQ-Sauce.', 
                    'price' => 6.00, 
                    'image_path' => '/images/Suesskartoffelpommes-mit-Darkbeer-BBQ.png'
                ],
                [
                    'name' => 'Kartoffelsalat mit Radieschen und Frühlingslauch', 
                    'description' => 'Klassischer fränkischer Kartoffelsalat, frisch verfeinert mit Radieschen und Frühlingslauch.', 
                    'price' => 5.00, 
                    'image_path' => '/images/Kartoffelsalat-mit-Radieschen-und-Fruehlingslauch.png'
                ],
                [
                    'name' => 'Kartoffelpüree mit Röstzwiebeln', 
                    'description' => 'Cremiges Kartoffelpüree garniert mit goldbraunen Röstzwiebeln. [Allergene: a) a.1) l)]', 
                    'price' => 5.00, 
                    'image_path' => '/images/Kartoffelpueree-mit-Roestzwiebeln.png'
                ],
                [
                    'name' => 'Gegrilltes Gemüse mit Yakitorilack', 
                    'description' => 'Knackiges, gegrilltes Gemüse glasiert mit einer würzigen Soja-Yakitorisauce. [Allergene: f)]', 
                    'price' => 6.00, 
                    'image_path' => '/images/Gegrilltes-Gemuese-Yakitorilack.png'
                ],
                [
                    'name' => 'Beilagensalat mit Bierdressing', 
                    'description' => 'Kleiner, gemischter Salat der Saison mit unserem Spezial-Bierdressing. [Allergene: a) m) o)]', 
                    'price' => 6.00, 
                    'image_path' => '/images/Beilagensalat-mit-Bierdressing.png'
                ],
                [
                    'name' => 'Fränkischer Krautsalat', 
                    'description' => 'Traditionell zubereiteter, feiner Krautsalat.', 
                    'price' => 4.50, 
                    'image_path' => '/images/Fraenkischer-Krautsalat.png'
                ],
                [
                    'name' => 'Hopfen-Malz-Butter', 
                    'description' => 'Hausgemachte, aromatische Butterkreation mit Hopfen und Malz. [Allergene: a) a.1) a.3) g)]', 
                    'price' => 2.50, 
                    'image_path' => '/images/Hopfen-Malz-Butter.png'
                ],
                [
                    'name' => 'Darkbeer-BBQ Sauce', 
                    'description' => 'Unsere kräftig-rauchige Barbecuesauce mit dunklem Bier verfeinert.', 
                    'price' => 2.50, 
                    'image_path' => '/images/Darkbeer-BBQ.png'
                ],
                [
                    'name' => 'Chipotlemayo', 
                    'description' => 'Cremige Mayonnaise mit einer leicht scharfen, geräucherten Chipotle-Note.', 
                    'price' => 2.50, 
                    'image_path' => '/images/Chipotlemayo.png'
                ],
                [
                    'name' => 'Cremiger Kräuter-Ziebeleskäs', 
                    'description' => 'Fränkischer Quark-Klassiker mit frischen Kräutern und Zwiebeln.', 
                    'price' => 2.50, 
                    'image_path' => '/images/Cremiger-Kraeuter-Ziebeleskaes.png'
                ],
                [
                    'name' => 'Pfeffersauce', 
                    'description' => 'Herzhaft-würzige Sauce mit grünem Pfeffer.', 
                    'price' => 3.00, 
                    'image_path' => '/images/Pfeffersauce.png'
                ],
            ]   
            'Mittagstisch (NACHSPEISE)' => [            
                // --- NACHSPEISE ---
                [
                    'name' => 'Hausgemachtes Eis', 
                    'description' => 'Täglich frisch zubereitete Eiskreationen aus unserer eigenen Herstellung.', 
                    'price' => 4.00, 
                    'image_path' => '/images/Hausgemachtes-Eis.png'
                ],
                [
                    'name' => 'Milchreisschaum', 
                    'description' => 'Fluffiger, hausgemachter Milchreisschaum serviert mit Beeren, knusprigem Hafercrumble und frischem Sauerampfer. [Allergene: a) a.1) a.4)]', 
                    'price' => 10.00, 
                    'image_path' => '/images/Milchreisschaum.png'
                ],
            ],

            /* 
             * Allergen-Legende (Mittagstisch gesamt):
             * a) glutenhaltige Getreide und -erzeugnisse
             * a.1) Weizen und -erzeugnisse
             * a.3) Gerste und -erzeugnisse
             * a.4) Hafer und -erzeugnisse
             * c) Eier und -erzeugnisse
             * d) Fisch und -erzeugnisse
             * f) Soja und -erzeugnisse
             * g) Milch und -erzeugnisse (einschließlich Laktose)
             * h.1) Mandeln und -erzeugnisse
             * h.2) Haselnüsse und -erzeugnisse
             * l) Sellerie und -erzeugnisse
             * m) Senf und -erzeugnisse
             * o) Schwefeldioxid und Sulfite > 10mg/kg, > 10 mg/l als SO2
             * 
             * Alle Preise enthalten die gesetzlich vorgeschriebene MwSt.
             */

            'Abendkarte (VORSPEISEN)' => [
                // --- VORSPEISEN & STARTERS ---
                [
                    'name' => 'Kohlrabi Carpaccio', 
                    'description' => 'Mit Senfgurke, Johannisbeere und Haselnüssen. [Allergene: h.2) m)]', 
                    'price' => 12.00, 
                    'image_path' => '/images/Kohlrabi-Carpaccio.png'
                ],
                [
                    'name' => 'Geräucherte Forelle', 
                    'description' => 'Frankenwald Forelle mit Gurke, Vogelmiere und Buttermilchschaum. [Allergene: a) a.1) g)]', 
                    'price' => 15.00, 
                    'image_path' => '/images/Geraeucherte-Forelle.png'
                ],
                [
                    'name' => 'Ziegenkäsemousse', 
                    'description' => 'Laugengebäck serviert mit cremigem Ziegenfrischkäse, Pfifferlingen, Erdbeere, Sauerampfer und jungem Pflücksalat. [Allergene: a) a.1) c) g) l)]', 
                    'price' => 13.50, 
                    'image_path' => '/images/Ziegenkaesemousse.png'
                ],
                [
                    'name' => 'Klare Blumenkohlsuppe', 
                    'description' => 'Feine, klare Suppe mit Grießnockerln mit würzigem Käse, Pfifferlingen und Tomate. [Allergene: a) a.1) c) f) g)]', 
                    'price' => 8.00, 
                    'image_path' => '/images/Klare-Blumenkohlsuppe.png'
                ],
                [
                    'name' => 'Kross gebackenes Steinmühlbrot', 
                    'description' => 'Ofenfrisches, kross gebackenes Brot aus der regionalen Steinmühle.', 
                    'price' => 4.50, 
                    'image_path' => '/images/Kross-gebackenes-Steinmuehlbrot.png'
                ],
                [
                    'name' => 'LB-Starters (3 Stück)', 
                    'description' => 'Unsere Starters servieren wir als gemeinsame Genussreise für 2 Personen als Vorspeisevariation.', 
                    'price' => 22.00, 
                    'image_path' => '/images/LB-Starters-3-Stueck.png'
                ],
                [
                    'name' => 'LB-Starters (5 Stück)', 
                    'description' => 'Genussreise für 2 Personen mit Brotzeit-Charakter zum Teilen und Probieren. [Allergene: a) a.1) a.3) a.4) f) g)]', 
                    'price' => 36.00, 
                    'image_path' => '/images/LB-Starters-5-Stueck.png'
                ],
                [
                    'name' => 'Pimientos de Padron', 
                    'description' => 'Frittierte Bratpaprika mit Kristallsalz und Chipotle Mayo.', 
                    'price' => 7.00, 
                    'image_path' => '/images/Pimientos-de-Padron.png'
                ],
                [
                    'name' => 'Hopfenschinken', 
                    'description' => '60g dünn aufgeschnittener Hopfenschinken.', 
                    'price' => 8.50, 
                    'image_path' => '/images/Hopfenschinken.png'
                ],
            ]    
            'Abendkarte (HAUPTSPEISEN)' => [
                // --- HAUPTSPEISEN ---
                [
                    'name' => 'Hausgemachte Bandnudeln', 
                    'description' => 'Pfifferlinge, Bohnen, Aprikosen-Miso-Rahmsauce und Haselnüsse. [Allergene: a) a.1) c) f) g) h.2) l)]', 
                    'price' => 19.00, 
                    'image_path' => '/images/Hausgemachte-Bandnudeln.png'
                ],
                [
                    'name' => 'Gebackener Blumenkohl', 
                    'description' => 'Mit Spinat, schwarzem Knoblauch und Hummus. [Zusatzstoffe: 1) | Allergene: a) a.1) f) l) p)]', 
                    'price' => 20.00, 
                    'image_path' => '/images/Gebackener-Blumenkohl.png'
                ],
                [
                    'name' => 'Hausgemachte Kartoffelnocken', 
                    'description' => 'Gebratene Pfifferlinge, Tomate und Bergkäsefond. [Allergene: a) a.1) c) g) l)]', 
                    'price' => 18.00, 
                    'image_path' => '/images/Hausgemachte-Kartoffelnocken.png'
                ],
                [
                    'name' => 'Lachsforellenfilet', 
                    'description' => 'Mangoldsalat, Sauerampfer, Erbsenpüree und Buttersauce. [Allergene: d) g) l) o)]', 
                    'price' => 26.00, 
                    'image_path' => '/images/Lachsforellenfilet.png'
                ],
                [
                    'name' => '„Montreal Maple“ Bratwurst', 
                    'description' => 'Gewinnerbratwurst mit Bratensoße, Käse, Ahornsirup, Spitzkohlrahmsalat, Röstzwiebelpüree und Ahornsirup-Bratensauce.', 
                    'price' => 15.90, 
                    'image_path' => '/images/Montreal-Maple-Bratwurst.png'
                ],
                [
                    'name' => 'Crispy Chickenburger', 
                    'description' => 'Kirschchutney, Pfefferschmand, Bacon, Romanasalat, Tomate und Briochebun. [Allergene: a) a.1) c) f) g) o)]', 
                    'price' => 16.50, 
                    'image_path' => '/images/Crispy-Chickenburger.png'
                ],
                [
                    'name' => 'Bunte Salatbowl', 
                    'description' => 'Blattsalate, Gerstensalat, Rotkohl, Radieschen, Karotte, Tomate, Gurke, Croutons und Kerne. [Allergene: a) l) m) o)]', 
                    'price' => 12.00, 
                    'image_path' => '/images/Bunte-Salatbowl.png'
                ],
                [
                    'name' => 'Königsberger Klopse', 
                    'description' => 'Knackiges Gemüse, Kartoffelpüree, Kapernsauce und Gemüsechips. [Allergene: a) f) m)]', 
                    'price' => 18.50, 
                    'image_path' => '/images/Koenigsberger-Klopse.png'
                ],
                [
                    'name' => 'Fränkische Fish & Chips', 
                    'description' => 'Fischfilet im Bierteig, gezupfter Baggers, cremiger Kräuter-Ziebeleskäs und gepickelte Zwiebeln. [Allergene: a) a.1) a.3) c) d) g) m)]', 
                    'price' => 24.00, 
                    'image_path' => '/images/Fraenkisch-Fish-Chips.png'
                ],
                [
                    'name' => 'Gezupftes Schäufele', 
                    'description' => 'Langzeit gegarte Schulter vom Stroh-Schwein, gebackener Knödel, Krautsalat, Bierjus und Schwartenpopcorn.', 
                    'price' => 19.00, 
                    'image_path' => '/images/Gezupftes-Schaeufele.png'
                ],
                [
                    'name' => 'Brezenschnitzel', 
                    'description' => 'Mariniertes Bierschnitzel in Brezenbröseln mit Kartoffel-Radieschensalat und Frühlingslauch.', 
                    'price' => 21.00, 
                    'image_path' => '/images/Brezenschnitzel.png'
                ],
                [
                    'name' => 'Steak Frites', 
                    'description' => 'Hüftsteak, Zwiebeljus, Hausfritten, Schmortomate, Chipotlemayo und Röstzwiebeln. [Allergene: a) l) o)]', 
                    'price' => 29.00, 
                    'image_path' => '/images/Steak-Frites.png'
                ],
                [
                    'name' => 'LB-Burger', 
                    'description' => '100% Frankenbeef, Bacon-Jam, Käse, Biergurken, Zwiebeln, Salat und Darkbeer-BBQ. [Allergene: a) g) o)]', 
                    'price' => 16.00, 
                    'image_path' => '/images/LB-Burger.png'
                ],
                [
                    'name' => 'Pulled Schäufele Burger', 
                    'description' => 'Gezupftes Schäufele, Krautsalat, Röstzwiebeln, Tomate, Biergurken und Salat. [Allergene: a) f) o)]', 
                    'price' => 15.00, 
                    'image_path' => '/images/Pulled-Schaeufele-Burger.png'
                ],
                [
                    'name' => 'Jeffs-Burger', 
                    'description' => 'Beyond Burger, Cheddar Style Veggie-Käse, Tomate, Biergurken, Salat, Zwiebeln und Darkbeer-BBQ. [Allergene: a) g) o)]', 
                    'price' => 16.00, 
                    'image_path' => '/images/Jeffs-Burger.png'
                ],
                [
                    'name' => 'Rumpsteak', 
                    'description' => 'Saftiges Rumpsteak (ca. 250g), geschnitten wie gewachsen. [Allergene: a) h.1)]', 
                    'price' => 29.00, 
                    'image_path' => '/images/Rumpsteak.png'
                ],
                [
                    'name' => 'Halbes Maishähnchen', 
                    'description' => 'Saftiges Maishähnchen mit Bier-Yakitorilack. [Allergene: f) o)]', 
                    'price' => 21.00, 
                    'image_path' => '/images/Halbes-Maishaehnchen.png'
                ],
                [
                    'name' => 'LB-Spareribs', 
                    'description' => 'Baby Back Ribs (ca. 400g) mit Darkbeer-BBQ. [Allergene: a) h.1)]', 
                    'price' => 17.00, 
                    'image_path' => '/images/LB-Spareribs.png'
                ],
                [
                    'name' => 'Beef Brisket', 
                    'description' => 'Geräucherte Rinderbrust (ca. 250g) mit Biergurken, Zwiebeln, Senfkaviar und Meerrettich. [Allergene: m) o)]', 
                    'price' => 29.00, 
                    'image_path' => '/images/Beef-Brisket.png'
                ],
            ]    
            'Abendkarte (BEILAGEN)' => [
                // --- BEILAGEN & SAUCEN ---
                [
                    'name' => 'Brotkorb', 
                    'description' => 'Frische Brotauswahl (1 oder 2 Personen).', 
                    'price' => 1.90, 
                    'image_path' => '/images/Brotkorb.png'
                ],
                [
                    'name' => 'Haus-Fritten / Süßkartoffelpommes', 
                    'description' => 'Mit Darkbeer-BBQ.', 
                    'price' => 5.00, 
                    'image_path' => '/images/Pommes.png'
                ],
                [
                    'name' => 'Kartoffelsalat / Kartoffelpüree', 
                    'description' => 'Fränkisch oder mit Röstzwiebeln. [Allergene: a) a.1) l)]', 
                    'price' => 5.00, 
                    'image_path' => '/images/Kartoffelbeilagen.png'
                ],
                [
                    'name' => 'Gegrilltes Gemüse', 
                    'description' => 'Mit Yakitorilack. [Allergene: f)]', 
                    'price' => 6.00, 
                    'image_path' => '/images/Gegrilltes-Gemuese.png'
                ],
                [
                    'name' => 'Beilagensalat', 
                    'description' => 'Mit Bierdressing. [Allergene: a) m) o)]', 
                    'price' => 6.00, 
                    'image_path' => '/images/Beilagensalat.png'
                ],
                [
                    'name' => 'Fränkischer Krautsalat', 
                    'description' => 'Traditionell zubereitet.', 
                    'price' => 4.50, 
                    'image_path' => '/images/Fraenkischer-Krautsalat.png'
                ],
                [
                    'name' => 'Hopfen-Malz-Butter', 
                    'description' => 'Aromatische Butterkreation. [Allergene: a) a.1) a.3) g)]', 
                    'price' => 2.50, 
                    'image_path' => '/images/Hopfen-Malz-Butter.png'
                ],
                [
                    'name' => 'Saucen', 
                    'description' => 'Pfeffersauce, Darkbeer-BBQ, Chipotlemayo oder Kräuter-Ziebeleskäs.', 
                    'price' => 2.50, 
                    'image_path' => '/images/Saucen.png'
                ],
            ]
            'Abendkarte (BNACHSPEISEN)' => [
                // --- NACHSPEISEN ---
                [
                    'name' => 'Hausgemachtes Eis', 
                    'description' => 'Täglich frisch zubereitete Eiskreationen.', 
                    'price' => 4.00, 
                    'image_path' => '/images/Hausgemachtes-Eis.png'
                ],
                [
                    'name' => 'Falscher Topfenknödel', 
                    'description' => 'Quarkmousseknödel, Erdbeere und weiße Kaffeesauce. [Allergene: a) a.3) c) g)]', 
                    'price' => 12.00, 
                    'image_path' => '/images/Topfenknoedel.png'
                ],
                [
                    'name' => 'Bieramisu X Bagel', 
                    'description' => 'Blätterteigbagel, Bieramisucreme, Himbeere und Sorbet. [Allergene: a) a.1) c) o)]', 
                    'price' => 12.00, 
                    'image_path' => '/images/Bieramisu-Bagel.png'
                ],
                [
                    'name' => 'Milchreisschaum', 
                    'description' => 'Beeren, Hafercrumble und Sauerampfer. [Allergene: a) a.1) a.4)]', 
                    'price' => 10.00, 
                    'image_path' => '/images/Milchreisschaum.png'
                ],
            ],

            /* * Allergen- & Zusatzstoff-Legende (Abendkarte):
             * 1) mit Farbstoff
             * a) glutenhaltige Getreide: a.1) Weizen, a.3) Gerste, a.4) Hafer
             * c) Eier | d) Fisch | f) Soja | g) Milch (Laktose)
             * h.1) Mandeln | h.2) Haselnüsse | l) Sellerie | m) Senf
             * o) Schwefeldioxid/Sulfite | p) Lupinen
             * * Alle Preise enthalten die gesetzlich vorgeschriebene MwSt.
             */

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