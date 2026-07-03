import React, { useEffect, useMemo, useState } from 'react';
import { ShoppingCart, Search, Star, SlidersHorizontal, Plus, Minus, Trash2, Bike, ShieldCheck, X, User, LogOut, LockKeyhole, MapPin } from 'lucide-react';

const API_BASE = import.meta.env.VITE_API_BASE || 'http://localhost:8000/api';
const CART_KEY = 'foodly_cart';
const API_ORIGIN = API_BASE.replace(/\/api\/?$/, '');

function apiImageUrl(product) {
  const image = product?.image_url || product?.image || '';
  if (!image) return `${API_ORIGIN}/images/cheeseburger.jpg`; 
  if (/^https?:\/\//i.test(image)) return image;
  return `${API_ORIGIN}${image.startsWith('/') ? image : `/${image}`}`;
}

function ratingFor(id) {
  return ({ 1: 4.8, 2: 4.7, 3: 4.6, 4: 4.9, 5: 4.5, 6: 4.4, 7: 4.8, 8: 4.2, 9: 4.7 }[id] || 4.5);
}

function reviewsFor(id) {
  return 47 + Number(id || 1) * 19;
}

function money(value) {
  return new Intl.NumberFormat('de-DE', { style: 'currency', currency: 'EUR' }).format(Number(value || 0));
}

function normalizeProducts(payload) {
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

function validateAddress(address) {
  const streetOk = /^.+\s+[0-9]+[a-zA-Z]?$/.test(address.street.trim());
  const zipOk = /^[0-9]{5}$/.test(address.zip.trim());
  const cityOk = address.city.trim().length >= 2;
  if (!streetOk) return 'Bitte gib Straße und Hausnummer ein, z. B. Musterstraße 12.';
  if (!zipOk) return 'Bitte gib eine gültige deutsche PLZ mit 5 Ziffern ein.';
  if (!cityOk) return 'Bitte gib einen gültigen Ort ein.';
  return '';
}

export default function App() {
  const [products, setProducts] = useState([]);
  const [cart, setCart] = useState(() => {
    try { return JSON.parse(localStorage.getItem(CART_KEY) || '[]'); } catch { return []; }
  });
  const [query, setQuery] = useState('');
  const [category, setCategory] = useState('Alle');
  const [minRating, setMinRating] = useState(0);
  const [sort, setSort] = useState('popular');
  const [loading, setLoading] = useState(true);
  const [checkoutOpen, setCheckoutOpen] = useState(false);
  const [authOpen, setAuthOpen] = useState(false);
  const [user, setUser] = useState(null);
  const [orderDone, setOrderDone] = useState(null);
  const [checkoutError, setCheckoutError] = useState('');

  useEffect(() => {
    localStorage.setItem(CART_KEY, JSON.stringify(cart));
  }, [cart]);

  useEffect(() => {
    async function loadProducts() {
      try {
        setLoading(true);
        const response = await fetch(`${API_BASE}/products`, { headers: { Accept: 'application/json' } });
        if (!response.ok) throw new Error(`HTTP ${response.status}`);
        const data = await response.json();
        setProducts(normalizeProducts(data));
      } catch (error) {
        console.error('Produkte konnten nicht geladen werden:', error);
        setProducts([]);
      } finally {
        setLoading(false);
      }
    }
    loadProducts();
  }, []);

  useEffect(() => {
    const token = localStorage.getItem('token');
    if (!token) return;
    fetch(`${API_BASE}/user`, { headers: { Accept: 'application/json', Authorization: `Bearer ${token}` } })
      .then((response) => response.ok ? response.json() : Promise.reject())
      .then((data) => setUser(data))
      .catch(() => localStorage.removeItem('token'));
  }, []);

  const categories = useMemo(() => ['Alle', ...new Set(products.map((product) => product.category).filter(Boolean))], [products]);
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

  const cartCount = cart.reduce((sum, item) => sum + item.quantity, 0);
  const subtotal = cart.reduce((sum, item) => sum + item.price * item.quantity, 0);
  const delivery = subtotal > 0 && subtotal < 25 ? 2.9 : 0;
  const total = subtotal + delivery;

  function addToCart(product) {
    setCart((current) => {
      const existing = current.find((item) => item.id === product.id);
      if (existing) return current.map((item) => item.id === product.id ? { ...item, quantity: item.quantity + 1 } : item);
      return [...current, { ...product, quantity: 1 }];
    });
  }

  function changeQuantity(id, delta) {
    setCart((current) => current.map((item) => item.id === id ? { ...item, quantity: item.quantity + delta } : item).filter((item) => item.quantity > 0));
  }

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

  async function checkout(deliveryAddress) {
    if (!cart.length) return;
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
      setOrderDone({ id: data.order_id, amount: data.total_amount || total });
      setCart([]);
      localStorage.removeItem(CART_KEY);
      setCheckoutOpen(false);
    } catch (error) {
      setCheckoutError(error.message || 'Bestellung konnte nicht verarbeitet werden.');
    }
  }

  return <div className="app">
    <header className="hero">
      <nav className="nav" aria-label="Hauptnavigation">
        <div className="brand"><span>Foodly</span><small>Delivery</small></div>
        <label className="searchBox"><Search size={20}/><input value={query} onChange={(event) => setQuery(event.target.value)} placeholder="Gericht, Kategorie oder Zutat suchen" /></label>
        {user ? <button className="authButton" onClick={logout}><LogOut size={18}/> {user.name || 'Logout'}</button> : <button className="authButton" onClick={() => setAuthOpen(true)}><User size={18}/> Login</button>}
        <button className="cartButton" onClick={() => setCheckoutOpen(true)}><ShoppingCart size={22}/> Warenkorb <b>{cartCount}</b></button>
      </nav>
      <section className="heroContent">
        <div>
          <p className="eyebrow"><Bike size={16}/> Lieferbereit in deiner Umgebung</p>
          <h1>Frisch gekocht. Kalt geliefert? Niemals.</h1>
          <p className="subline">Maisel-inspirierte Genussmomente mit kräftigem Blau, warmem Gold und schnellen Lieferwegen direkt zu dir.</p>
          <div className="badges"><span><Bike size={16}/> Schnelle Lieferung</span><span><ShieldCheck size={16}/> Sichere Anmeldung</span><span><Star size={16}/> Beliebte Auswahl</span></div>
        </div>
        <div className="heroCard"><strong>{money(total)}</strong><span>{cartCount ? 'Aktueller Warenkorb' : 'Warenkorb ist leer'}</span><button onClick={() => setCheckoutOpen(true)}>Zur Kasse</button></div>
      </section>
    </header>

    <main className="layout">
      <aside className="filters">
        <h3><SlidersHorizontal size={18}/> Filter</h3>
        <label>Kategorie</label>
        <div className="chips">{categories.map((cat) => <button key={cat} className={cat === category ? 'active' : ''} onClick={() => setCategory(cat)}>{cat}</button>)}</div>
        <label>Mindestens Bewertung</label>
        <select value={minRating} onChange={(event) => setMinRating(Number(event.target.value))}><option value="0">Alle Bewertungen</option><option value="4.5">ab 4,5 Sterne</option><option value="4.7">ab 4,7 Sterne</option><option value="4.8">ab 4,8 Sterne</option></select>
        <label>Sortieren</label>
        <select value={sort} onChange={(event) => setSort(event.target.value)}><option value="popular">Beliebtheit</option><option value="rating">Bewertung</option><option value="price-low">Preis aufsteigend</option><option value="price-high">Preis absteigend</option></select>
      </aside>
      <section className="products">
        <div className="sectionHead"><div><h2>Produktauswahl</h2><p>{filtered.length} Produkte verfügbar</p></div></div>
        {loading ? <div className="empty">Produkte werden geladen...</div> : <div className="grid">{filtered.map((product) => <ProductCard key={product.id} product={product} onAdd={addToCart}/>)}</div>}
      </section>
    </main>

    {checkoutOpen && <CartDrawer cart={cart} subtotal={subtotal} delivery={delivery} total={total} user={user} error={checkoutError} onLogin={() => { setCheckoutOpen(false); setAuthOpen(true); }} onClose={() => setCheckoutOpen(false)} onQty={changeQuantity} onCheckout={checkout} />}
    {authOpen && <AuthModal onClose={() => setAuthOpen(false)} onLogin={(loggedInUser) => { setUser(loggedInUser); setAuthOpen(false); }} />}
    {orderDone && <div className="toast" onClick={() => setOrderDone(null)}>Bestellung #{orderDone.id} übermittelt - {money(orderDone.amount)}</div>}
  </div>;
}

function ProductCard({ product, onAdd }) {
  const [source, setSource] = useState(product.image);
  return <article className={`productCard ${product.category === 'Getränke' ? 'drinkCard' : ''}`}>
    <div className="imageWrap"><img src={source} onError={() => setSource(`${API_ORIGIN}/images/cheeseburger.jpg`)} alt={product.name}/><span>{product.category}</span></div>
    <div className="cardBody"><div className="rating"><Star size={16} fill="currentColor"/> {Number(product.rating).toFixed(1)} <small>({product.reviews})</small></div><h3>{product.name}</h3><p>{product.description}</p><div className="cardFoot"><strong>{money(product.price)}</strong><button onClick={() => onAdd(product)}><Plus size={18}/> Hinzufügen</button></div></div>
  </article>;
}

function CartDrawer({ cart, subtotal, delivery, total, user, error, onLogin, onClose, onQty, onCheckout }) {
  const [useCustomAddress, setUseCustomAddress] = useState(false);
  const [address, setAddress] = useState({ street: '', zip: '', city: '' });
  const [addressError, setAddressError] = useState('');
  const defaultAddress = user ? `${user.delivery_street || ''}, ${user.delivery_zip || ''} ${user.delivery_city || ''}`.trim() : '';

  function submitOrder() {
    if (useCustomAddress) {
      const validation = validateAddress(address);
      if (validation) { setAddressError(validation); return; }
      onCheckout({ street: address.street.trim(), zip: address.zip.trim(), city: address.city.trim() });
      return;
    }
    onCheckout(null);
  }

  return <div className="drawerBackdrop">
    <aside className="drawer">
      <div className="drawerHead"><h2>Dein Warenkorb</h2><button onClick={onClose}><X size={20}/></button></div>
      {!cart.length ? <div className="empty">Noch nichts im Warenkorb.</div> : <>
        <div className="cartItems">{cart.map((item) => <div className="cartItem" key={item.id}><div><strong>{item.name}</strong><span>{money(item.price)}</span></div><div className="qty"><button onClick={() => onQty(item.id, -1)}><Minus size={14}/></button><b>{item.quantity}</b><button onClick={() => onQty(item.id, 1)}><Plus size={14}/></button><button className="trash" onClick={() => onQty(item.id, -999)}><Trash2 size={14}/></button></div></div>)}</div>
        {user && <div className="addressBox"><p><MapPin size={16}/> Lieferadresse</p><strong>{defaultAddress || 'Keine Adresse hinterlegt'}</strong><label className="checkRow"><input type="checkbox" checked={useCustomAddress} onChange={(event) => setUseCustomAddress(event.target.checked)} /> Andere Lieferadresse verwenden</label>{useCustomAddress && <div className="addressGrid"><input value={address.street} onChange={(event) => setAddress({ ...address, street: event.target.value })} placeholder="Straße und Hausnummer" /><input value={address.zip} onChange={(event) => setAddress({ ...address, zip: event.target.value })} placeholder="PLZ" /><input value={address.city} onChange={(event) => setAddress({ ...address, city: event.target.value })} placeholder="Ort" /></div>}{addressError && <div className="formError">{addressError}</div>}</div>}
        <div className="summary"><p><span>Zwischensumme</span><b>{money(subtotal)}</b></p><p><span>Lieferung</span><b>{delivery ? money(delivery) : 'Gratis'}</b></p><p className="total"><span>Gesamt</span><b>{money(total)}</b></p>{error && <div className="formError">{error}</div>}{user ? <button onClick={submitOrder}>Bestellung abschicken</button> : <button onClick={onLogin}><LockKeyhole size={16}/> Einloggen zum Bestellen</button>}</div>
      </>}
    </aside>
  </div>;
}

function AuthModal({ onClose, onLogin }) {
  const [mode, setMode] = useState('login');
  const [form, setForm] = useState({ name: '', email: '', password: '', delivery_street: '', delivery_zip: '', delivery_city: '' });
  const [error, setError] = useState('');
  const [busy, setBusy] = useState(false);

  function update(field, value) {
    setForm((current) => ({ ...current, [field]: value }));
  }

  async function submit(event) {
    event.preventDefault();
    setError('');
    if (mode === 'register') {
      const validation = validateAddress({ street: form.delivery_street, zip: form.delivery_zip, city: form.delivery_city });
      if (validation) { setError(validation); return; }
    }
    setBusy(true);
    try {
      const endpoint = mode === 'register' ? 'register' : 'login';
      const body = mode === 'register' ? form : { email: form.email, password: form.password };
      const response = await fetch(`${API_BASE}/${endpoint}`, { method: 'POST', headers: { Accept: 'application/json', 'Content-Type': 'application/json' }, body: JSON.stringify(body) });
      const data = await response.json();
      if (!response.ok || !data.access_token) throw new Error(data.message || 'Anmeldung fehlgeschlagen');
      localStorage.setItem('token', data.access_token);
      onLogin(data.user || { name: form.name || form.email, email: form.email });
    } catch (err) {
      setError(err.message || 'Bitte Zugangsdaten prüfen.');
    } finally {
      setBusy(false);
    }
  }

  return <div className="drawerBackdrop"><div className="authModal"><div className="drawerHead"><h2>{mode === 'register' ? 'Konto erstellen' : 'Einloggen'}</h2><button onClick={onClose}><X size={20}/></button></div><p className="authHint">Melde dich an, damit Warenkorb und Bestellung sauber über das Backend verarbeitet werden.</p><form onSubmit={submit}>{mode === 'register' && <><input value={form.name} onChange={(event) => update('name', event.target.value)} placeholder="Name" required /><input value={form.delivery_street} onChange={(event) => update('delivery_street', event.target.value)} placeholder="Straße und Hausnummer" required /><div className="splitFields"><input value={form.delivery_zip} onChange={(event) => update('delivery_zip', event.target.value)} placeholder="PLZ" required /><input value={form.delivery_city} onChange={(event) => update('delivery_city', event.target.value)} placeholder="Ort" required /></div></>}<input value={form.email} onChange={(event) => update('email', event.target.value)} type="email" placeholder="E-Mail" required /><input value={form.password} onChange={(event) => update('password', event.target.value)} type="password" placeholder="Passwort" required />{error && <div className="formError">{error}</div>}<button className="primaryWide" disabled={busy}>{busy ? 'Bitte warten...' : mode === 'register' ? 'Registrieren' : 'Einloggen'}</button></form><button className="linkButton" onClick={() => setMode(mode === 'register' ? 'login' : 'register')}>{mode === 'register' ? 'Ich habe bereits ein Konto' : 'Neues Konto erstellen'}</button></div></div>;
}