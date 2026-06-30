🍕 Food-Delivery REST-API (Laravel)

Dieses Repository enthält das Backend für eine Food-Delivery Single Page Application (SPA). Die API basiert auf Laravel 11 und stellt Endpunkte für die Speisekarte, Benutzerauthentifizierung und eine Warenkorb-/Checkout-Logik bereit.

Um maximale Plattformunabhängigkeit und Reproduzierbarkeit zu gewährleisten, ist die gesamte Anwendung vollständig containerisiert (Docker) und nutzt Laravel Sail.

🛠 Voraussetzungen für Prüfer / Entwickler

Um das Projekt zu starten, wird kein lokales PHP oder Composer benötigt. Das System läuft komplett isoliert. Benötigt wird lediglich:

Git

Docker Desktop (unter Windows zwingend mit WSL 2 Backend)

🚀 Setup & Installation (Schritt-für-Schritt)

Bitte führen Sie die folgenden Befehle in Ihrem Terminal (unter Windows im WSL 2 Ubuntu-Terminal) nacheinander aus:

1. Projekt klonen

git clone [URL_ZUM_REPOSITORY]
cd food-delivery-api


2. Initiale Abhängigkeiten installieren

Da der vendor-Ordner nicht im Git-Repository versioniert wird, nutzen wir einen temporären Docker-Container, um die initialen Composer-Pakete (inkl. Laravel Sail) zu installieren:

docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php83-composer:latest \
    composer install --ignore-platform-reqs


3. Umgebungsvariablen konfigurieren

Erstellen Sie die .env-Datei aus der Vorlage und setzen Sie ein Standard-Passwort für die Datenbank:

cp .env.example .env
sed -i 's/DB_PASSWORD=/DB_PASSWORD=password/g' .env


4. Docker-Container starten

Starten Sie die Umgebung (Webserver, PHP, MySQL) im Hintergrund:

./vendor/bin/sail up -d


(Warten Sie nach diesem Befehl ca. 10-15 Sekunden, bis der MySQL-Container vollständig hochgefahren ist).

5. Application-Key generieren & Datenbank aufbauen

Generieren Sie den Sicherheitsschlüssel, erstellen Sie die Tabellen und füllen Sie die Datenbank per Seeder mit der echten Speisekarte und einem Testnutzer:

./vendor/bin/sail artisan key:generate
./vendor/bin/sail artisan migrate:fresh --seed


✅ Das Setup ist abgeschlossen! Die API ist nun unter http://localhost/api/... erreichbar.

🔑 Test-Daten & Login

Der Seeder hat bereits eine voll funktionstüchtige Speisekarte und einen Testnutzer angelegt.

Test-Nutzer für API-Logins:

E-Mail: max@example.com

Passwort: geheimesPasswort123

📡 API-Routen Übersicht

Die API kommuniziert strikt im JSON-Format. Bei allen POST/GET Anfragen sollte der Header Accept: application/json gesetzt sein.

Öffentliche Routen (Kein Token nötig)

GET /api/products - Liefert die Speisekarte.

Filter-Option: ?category=Burger

POST /api/register - Legt einen neuen Nutzer an (Erwartet: name, email, password).

POST /api/login - Loggt einen Nutzer ein (Erwartet: email, password) und liefert ein Token zurück.

POST /api/checkout - Verarbeitet den Warenkorb und speichert die Bestellung (Erwartet: items Array mit product_id und quantity).

Geschützte Routen (Bearer Token im Header zwingend erforderlich)

GET /api/user - Liefert die Daten des aktuell eingeloggten Nutzers.

POST /api/logout - Invalidiert das aktuelle Session-Token.

🧪 Automatisierte Tests ausführen

Zur Qualitätssicherung wurden Feature-Tests implementiert (Testing-Level). Sie prüfen Endpunkte, Datenbank-Relationen und API-Antworten isoliert voneinander.

Führen Sie die Tests mit folgendem Befehl aus:

./vendor/bin/sail artisan test


🏗 Architektur-Highlights (Profi-Level Implementierungen)

Schutz vor N+1 Query Problem: Einsatz von Eager Loading (with('category')) zur Optimierung der Datenbankabfragen.

Security & Auth: Zustandlose Authentifizierung (Stateless) via Laravel Sanctum. Passwörter werden via Bcrypt gehasht.

Form Requests: Strikte Validierung der eingehenden Client-Daten, bevor diese die Controller erreichen (Separation of Concerns).

Idempotentes Seeding: Nutzung von updateOrCreate, um die Speisekarte aktualisieren zu können, ohne bestehende Nutzertabellen/Bestellungen mit migrate:fresh zerstören zu müssen.

Datenbank-Transaktionen: Beim Checkout-Prozess sichern DB::transaction() Blöcke die atomare Speicherung von Bestellungen ab.
