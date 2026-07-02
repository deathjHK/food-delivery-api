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

2. **Container starten:**
```bash
./start.sh
```

3. **Datenbank seeden:**
```bash
docker compose exec laravel.test php artisan migrate:fresh --seed
```

4. **Container neustarten:**
```bash
docker compose down
./start.sh
```

Die API ist jetzt erreichbar unter: `http://localhost:8000/api/`

## Test-Account

Durch den Seeder existiert folgender Test-Account:
* **E-Mail:** `max@example.com`
* **Passwort:** `geheimesPasswort123`

## API-Routen

**Wichtig:** Bei allen Anfragen muss der Header `Accept: application/json` gesetzt sein.

### Öffentlich
* `GET /api/products` (Filter-Option: `?category=Getränke`)
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
docker compose exec laravel.test php artisan test
```

## Architekturmerkmale

* **Auth:** Laravel Sanctum (Token-basiert, zustandslos).
* **Validierung:** Form Requests (Pre-Controller Validierung).
* **Performance:** Eager Loading (`with('category')`) gegen N+1 Queries.
* **Seeding:** Idempotent (`updateOrCreate`), verhindert Datenverlust.
* **Checkout:** Abgesichert durch `DB::transaction()`.
"""

print(readme_content)
