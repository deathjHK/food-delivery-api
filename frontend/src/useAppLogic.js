import { useEffect, useMemo, useState } from 'react';

// === 1. GRUNDEINSTELLUNGEN ===
// Hier sagen wir der App, wo das Backend (die API) zu finden ist. 
// VITE_API_BASE wird genutzt, wenn die App später online ist. Sonst nimmt er localhost.
const API_BASE = import.meta.env.VITE_API_BASE || 'http://localhost:8000/api';
const CART_KEY = 'foodly_cart'; 
const API_ORIGIN = API_BASE.replace(/\/api\/?$/, '');

// === 2. HILFSFUNKTIONEN ===
// Diese kleinen Funktionen machen das Leben leichter und den Code übersichtlicher.

export function apiImageUrl(product) {
  // Baut die korrekte Bild-URL zusammen oder gibt einen Cheeseburger als Platzhalter zurück.
  const image = product?.image_url || product?.image || '';
  if (!image) return `${API_ORIGIN}/images/cheeseburger.jpg`; 
  if (/^https?:\/\//i.test(image)) return image;
  return `${API_ORIGIN}${image.startsWith('/') ? image : `/${image}`}`;
}

// Gibt jedem Produkt anhand seiner ID eine feste Fake-Bewertung (z.B. 4.8 Sterne)
export function ratingFor(id) {
  return ({ 1: 4.8, 2: 4.7, 3: 4.6, 4: 4.9, 5: 4.5, 6: 4.4, 7: 4.8, 8: 4.2, 9: 4.7 }[id] || 4.5);
}

// Erzeugt eine feste Fake-Anzahl an Bewertungen, passend zur ID.
export function reviewsFor(id) {
  return 47 + Number(id || 1) * 19;
}

// Macht aus einer Zahl wie "12.5" einen echten Preis-Text wie "12,50 €".
export function money(value) {
  return new Intl.NumberFormat('de-DE', { style: 'currency', currency: 'EUR' }).format(Number(value || 0));
}

// Nimmt die unordentlichen Daten vom Server und bringt sie in ein einheitliches Format.
export function normalizeProducts(payload) {
  const list = Array.isArray(payload) ? payload : payload?.data || payload?.products || payload?.items || [];
  return Array.isArray(list) ? list.map((product) => ({
    id: product.id,
    name: product.name || 'Produkt',
    description: product.description || '',
    price: Number(product.price || 0),
    image: apiImageUrl(product),
    category: product.category || 'Sonstiges',
    rating: product.rating || ratingFor(product.id),
    reviews: product.reviews || reviewsFor(product.id),
  })) : [];
}

// Prüft, ob der User eine echte Adresse für die Lieferung eingegeben hat.
export function validateAddress(address) {
  const streetOk = /^.+\s+[0-9]+[a-zA-Z]?$/.test(address.street.trim());
  const zipOk = /^[0-9]{5}$/.test(address.zip.trim()); // Genau 5 Zahlen
  const cityOk = address.city.trim().length >= 2;
  
  if (!streetOk) return 'Bitte gib Straße und Hausnummer ein, z. B. Musterstraße 12.';
  if (!zipOk) return 'Bitte gib eine gültige deutsche PLZ mit 5 Ziffern ein.';
  if (!cityOk) return 'Bitte gib einen gültigen Ort ein.';
  return '';
}

// === 3. DAS HAUPT-GEHIRN (CUSTOM HOOK) ===
export function useAppLogic() {
  
  // -- A. DIE NOTIZZETTEL (STATES) --
  // Hier merkt sich die App alle aktuellen Zustände, solange der Tab offen ist.
  const [products, setProducts] = useState([]); 
  
  // Beim Warenkorb schaut er zuerst, ob im Browser (localStorage) noch eine alte Bestellung liegt.
  const [cart, setCart] = useState(() => {
    try { return JSON.parse(localStorage.getItem(CART_KEY) || '[]'); } catch { return []; }
  });
  
  const [query, setQuery] = useState(''); // Das aktuelle Wort im Suchfeld
  const [category, setCategory] = useState('Alle'); // Gewählte Kategorie
  const [minRating, setMinRating] = useState(0); // Gewählte Mindestbewertung
  const [sort, setSort] = useState('popular'); // Aktuelle Sortierung
  const [loading, setLoading] = useState(true); // Lädt die App gerade?
  
  const [checkoutOpen, setCheckoutOpen] = useState(false); // Ist der Warenkorb sichtbar?
  const [authOpen, setAuthOpen] = useState(false); // Ist das Login-Fenster sichtbar?
  const [user, setUser] = useState(null); // Die Daten des eingeloggten Nutzers
  const [orderDone, setOrderDone] = useState(null); // Daten der fertigen Bestellung für das grüne Popup
  const [checkoutError, setCheckoutError] = useState('');

  // -- B. AUTOMATISCHE AKTIONEN (USEEFFECTS) --
  
  // Sobald sich der Warenkorb ändert, speichert dieses useEffect ihn im Browser ab.
  useEffect(() => {
    localStorage.setItem(CART_KEY, JSON.stringify(cart));
  }, [cart]);

  // Wenn die App startet, holt dieses useEffect die Produkte von deinem Backend.
  useEffect(() => {
    async function loadProducts() {
      try {
        setLoading(true);
        const response = await fetch(`${API_BASE}/products`, { headers: { Accept: 'application/json' } });
        if (!response.ok) throw new Error(`HTTP ${response.status}`);
        const data = await response.json();
        setProducts(normalizeProducts(data)); // Schickt die Daten durch den Aufräumer
      } catch (error) {
        console.error('Produkte konnten nicht geladen werden:', error);
        setProducts([]);
      } finally {
        setLoading(false); // Lade-Animation stoppen
      }
    }
    loadProducts();
  }, []);

  // Prüft beim Start, ob der Nutzer noch eingeloggt ist (über einen Token).
  useEffect(() => {
    const token = localStorage.getItem('token');
    if (!token) return;
    fetch(`${API_BASE}/user`, { headers: { Accept: 'application/json', Authorization: `Bearer ${token}` } })
      .then((response) => response.ok ? response.json() : Promise.reject())
      .then((data) => setUser(data))
      .catch(() => localStorage.removeItem('token'));
  }, []);

  // -- C. FILTER UND BERECHNUNGEN (USEMEMO) --
  // useMemo merkt sich das Ergebnis, damit es nicht bei jedem Klick neu berechnet werden muss.
  
  // Sammelt alle einzigartigen Kategorien (Burger, Pizza, etc.) für die Filter-Buttons.
  const categories = useMemo(() => ['Alle', ...new Set(products.map((product) => product.category).filter(Boolean))], [products]);
  
  // Das ist der Filter-Motor. Er sortiert die Liste nach Sucheingabe, Sternen und Preis aus.
  const filtered = useMemo(() => {
    let list = [...products];
    if (category !== 'Alle') list = list.filter((product) => product.category === category);
    if (query.trim()) {
      const q = query.toLowerCase();
      list = list.filter((product) => `${product.name} ${product.description} ${product.category}`.toLowerCase().includes(q));
    }
    if (minRating > 0) list = list.filter((product) => Number(product.rating) >= minRating);
    
    if (sort === 'price-low') list.sort((a, b) => a.price - b.price);
    if (sort === 'price-high') list.sort((a, b) => b.price - a.price);
    if (sort === 'rating') list.sort((a, b) => b.rating - a.rating);
    if (sort === 'popular') list.sort((a, b) => b.reviews - a.reviews);
    
    return list;
  }, [products, category, query, minRating, sort]);

  // Berechnet die Preise für den Warenkorb
  const cartCount = cart.reduce((sum, item) => sum + item.quantity, 0); // Anzahl aller Items
  const subtotal = cart.reduce((sum, item) => sum + item.price * item.quantity, 0); // Gesamtpreis ohne Lieferung
  const delivery = subtotal > 0 && subtotal < 25 ? 2.9 : 0; // Lieferung kostet 2,90€ (gratis ab 25€)
  const total = subtotal + delivery;

  // -- D. DIE FUNKTIONEN FÜR DIE BUTTONS --

  // Packt ein Gericht in den Warenkorb. Falls es schon drin ist, wird einfach +1 gerechnet.
  function addToCart(product) {
    setCart((current) => {
      const existing = current.find((item) => item.id === product.id);
      if (existing) return current.map((item) => item.id === product.id ? { ...item, quantity: item.quantity + 1 } : item);
      return [...current, { ...product, quantity: 1 }];
    });
  }

  // Verändert die Menge im Warenkorb. Bei Menge = 0 wird das Gericht gelöscht (.filter)
  function changeQuantity(id, delta) {
    setCart((current) => current.map((item) => item.id === id ? { ...item, quantity: item.quantity + delta } : item).filter((item) => item.quantity > 0));
  }

  // Meldet den Nutzer ab und löscht den Token.
  async function logout() {
    const token = localStorage.getItem('token');
    if (token) {
      fetch(`${API_BASE}/logout`, { method: 'POST', headers: { Accept: 'application/json', Authorization: `Bearer ${token}` } }).catch(() => {});
    }
    localStorage.removeItem('token');
    localStorage.removeItem(CART_KEY);
    setCart([]);
    setUser(null);
    setCheckoutOpen(false);
  }

  // Schickt die fertige Bestellung ans Backend ab.
  async function checkout(deliveryAddress) {
    if (!cart.length) return;
    // Wenn man nicht eingeloggt ist, öffnet er stattdessen das Login-Fenster.
    if (!localStorage.getItem('token')) { setCheckoutOpen(false); setAuthOpen(true); return; }
    setCheckoutError('');
    try {
      const token = localStorage.getItem('token');
      const body = {
        items: cart.map((item) => ({ product_id: item.id, quantity: item.quantity })),
        ...(deliveryAddress ? { 
            delivery_street: deliveryAddress.street,
            delivery_zip: deliveryAddress.zip,
            delivery_city: deliveryAddress.city
        } : {}),
      };
      
      const response = await fetch(`${API_BASE}/checkout`, {
        method: 'POST',
        headers: { Accept: 'application/json', 'Content-Type': 'application/json', Authorization: `Bearer ${token}` },
        body: JSON.stringify(body),
      });
      const data = await response.json();
      if (!response.ok) throw new Error(data.message || `Checkout HTTP ${response.status}`);
      
      // Bestellung war erfolgreich! Zeige Toast-Nachricht und mach den Warenkorb leer.
      setOrderDone({ id: data.order_id, amount: data.total_amount || total });
      setCart([]);
      localStorage.removeItem(CART_KEY);
      setCheckoutOpen(false);
    } catch (error) {
      setCheckoutError(error.message || 'Bestellung konnte nicht verarbeitet werden.');
    }
  }

  // Gibt am Ende alles an die App.jsx weiter, damit sie das HTML damit füttern kann.
  return {
    query, setQuery, category, setCategory, minRating, setMinRating, sort, setSort,
    loading, checkoutOpen, setCheckoutOpen, authOpen, setAuthOpen, user, setUser,
    orderDone, setOrderDone, checkoutError, categories, filtered, cart, cartCount,
    subtotal, delivery, total, addToCart, changeQuantity, logout, checkout
  };
}