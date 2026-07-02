# Food Delivery Frontend

React + Vite Frontend fuer das Laravel Backend.

## API

Alle Produkte, Login/Register, Userdaten und Checkout werden ueber das Backend geladen:

```txt
http://172.30.7.65/api
```

Wichtig: Die Produktliste ist nicht lokal im Frontend gespeichert. Das Frontend erwartet die Antwort vom Backend z.B. als:

```json
{ "data": [] }
```

## Bilder

Die Produktdaten kommen weiterhin aus der API. Fuer die Anzeige werden die Bildpfade aus der API auf echte Produkt-/Foodbilder gemappt. Falls ein Bild nicht gefunden wird, versucht das Frontend den Bildpfad vom Backend zu laden.

## Start

```bash
docker compose down
docker compose build --no-cache
docker compose up
```

Dann im Browser oeffnen:

```txt
http://localhost:5173
```
