Food-Delivery REST-API

Containerisiertes Backend (Laravel 11) für eine Food-Delivery SPA.

## Voraussetzungen

* Git
* Docker Desktop (Windows: zwingend mit WSL 2)

## Setup

1. **Repository klonen:**
```bash
git clone https://github.com/deathjHK/food-delivery-api
cd food-delivery-api
```

2. **Abhängigkeiten installieren:**
```bash
docker run --rm -u "$(id -u):$(id -g)" -v "$(pwd):/var/www/html" -w /var/www/html laravelsail/php83-composer:latest composer install --ignore-platform-reqs
```

3. **Umgebungsvariablen konfigurieren:**
```bash
cp .env.example .env
sed -i 's/DB_PASSWORD=/DB_PASSWORD=password/g' .env
```

4. **Container starten:**
```bash
./vendor/bin/sail up -d
```
*(Ca. 10 Sekunden warten, bis MySQL vollständig gestartet ist)*

5. **Datenbank & Key einrichten:**
```bash
./vendor/bin/sail artisan key:generate
./vendor/bin/sail artisan migrate:fresh --seed
```

Die API ist jetzt erreichbar unter: `http://localhost/api/`

## Test-Account

Durch den Seeder existiert folgender Test-Account:
* **E-Mail:** `max@example.com`
* **Passwort:** `geheimesPasswort123`

## API-Routen

**Wichtig:** Bei allen Anfragen muss der Header `Accept: application/json` gesetzt sein.

### Öffentlich
* `GET /api/products` (Filter-Option: `?category=Burger`)
* `POST /api/register` (`name`, `email`, `password`)
* `POST /api/login` (`email`, `password`)
* `POST /api/checkout` (`items` Array mit `product_id`, `quantity`)

### Geschützt (Token erforderlich)
*Header: `Authorization: Bearer <token>`*
* `GET /api/user` (Liefert Profil des eingeloggten Nutzers)
* `POST /api/logout` (Löscht das aktuelle Token)

## Tests

Ausführen der Feature-Tests:
```bash
./vendor/bin/sail artisan test
```

## Architekturmerkmale

* **Auth:** Laravel Sanctum (Token-basiert, zustandslos).
* **Validierung:** Form Requests (Pre-Controller Validierung).
* **Performance:** Eager Loading (`with('category')`) gegen N+1 Queries.
* **Seeding:** Idempotent (`updateOrCreate`), verhindert Datenverlust.
* **Checkout:** Abgesichert durch `DB::transaction()`.
"""

print(readme_content)
