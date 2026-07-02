import React, { useEffect, useMemo, useState } from 'react';
import { createRoot } from 'react-dom/client';
import { ShoppingCart, Search, Star, SlidersHorizontal, Plus, Minus, Trash2, Bike, ShieldCheck, X, User, LogOut, LockKeyhole } from 'lucide-react';
import './styles.css';

const API_BASE = import.meta.env.VITE_API_BASE || 'http://172.30.7.65/api';

const API_ORIGIN = API_BASE.replace(/\/api\/?$/, '');

const imageOverrides = {
  // Frühstück & Brunch
  'fruehstueck_buffet.jpg': 'https://images.unsplash.com/photo-1533089860892-a7c6f0a88666?auto=format&fit=crop&w=1000&q=85',
  'fruehstueck_eier.jpg': 'https://images.unsplash.com/photo-1525351484163-7529414344d8?auto=format&fit=crop&w=1000&q=85',
  'fruehstueck_bacon.jpg': 'https://images.unsplash.com/photo-1553163147-622ab57be1c7?auto=format&fit=crop&w=1000&q=85',

  // Mittagstisch
  'mittags_fleisch.jpg': 'https://images.unsplash.com/photo-1544025162-d76694265947?auto=format&fit=crop&w=1000&q=85',
  'mittags_veggie.jpg': 'https://images.unsplash.com/photo-1512621776951-a57141f2eefd?auto=format&fit=crop&w=1000&q=85',
  'mittags_salat.jpg': 'https://images.unsplash.com/photo-1540420773420-3366772f4999?auto=format&fit=crop&w=1000&q=85',

  // Bierbegleiter & Vorspeisen
  'fritten_glueck.jpg': 'https://images.unsplash.com/photo-1630431341973-02e1b662ec35?auto=format&fit=crop&w=1000&q=85',
  'oliven_hummus.jpg': 'https://images.unsplash.com/photo-1577906096429-f73c2c312435?auto=format&fit=crop&w=1000&q=85',
  'beef_tatar.jpg': 'https://images.unsplash.com/photo-1600891964092-4316c288032e?auto=format&fit=crop&w=1000&q=85',
  'pimientos.jpg': 'https://images.unsplash.com/photo-1604908176997-125f25cc6f3d?auto=format&fit=crop&w=1000&q=85',
  'knoblauchbrot.jpg': '/images/knoblauchbrot.jpg',

  // Bowls & Salate
  'vegan_bowl.jpg': 'https://images.unsplash.com/photo-1512621776951-a57141f2eefd?auto=format&fit=crop&w=1000&q=85',
  'caesar_salad.jpg': 'https://images.unsplash.com/photo-1550304943-4f24f54ddde9?auto=format&fit=crop&w=1000&q=85',
  'upgrade_haehnchen.jpg': 'https://images.unsplash.com/photo-1532550907401-a500c9a57435?auto=format&fit=crop&w=1000&q=85',

  // Burger & Hauptgerichte
  'liebesbier_burger.jpg': 'https://images.unsplash.com/photo-1568901346375-23c9450c58cd?auto=format&fit=crop&w=1000&q=85',
  'cheeseburger.jpg': 'https://images.unsplash.com/photo-1550547660-d9450f859349?auto=format&fit=crop&w=1000&q=85',
  'veggieburger.jpg': 'https://images.unsplash.com/photo-1520072959219-c595dc870360?auto=format&fit=crop&w=1000&q=85',
  'pulled_pork.jpg': 'https://images.unsplash.com/photo-1626082927389-6cd097cdc6ec?auto=format&fit=crop&w=1000&q=85',
  'upgrade_glutenfrei.jpg': 'https://images.unsplash.com/photo-1509440159596-0249088772ff?auto=format&fit=crop&w=1000&q=85',
  'upgrade_patty.jpg': '/images/upgrade_patty.jpg',
  'rumpsteak.jpg': 'https://images.unsplash.com/photo-1546833999-b9f581a1996d?auto=format&fit=crop&w=1000&q=85',
  'schaufele.jpg': 'https://images.unsplash.com/photo-1544025162-d76694265947?auto=format&fit=crop&w=1000&q=85',
  'fish_chips.jpg': '/images/fish_chips.jpg',
  'schokotoertchen.jpg': 'https://images.unsplash.com/photo-1606313564200-e75d5e30476c?auto=format&fit=crop&w=1000&q=85',
  'affogato.jpg': 'https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?auto=format&fit=crop&w=1000&q=85',

  // Alkoholfreie Getränke
  'cola.jpg': 'https://images.unsplash.com/photo-1622483767028-3f66f32aef97?auto=format&fit=crop&w=1000&q=85',
  'eistee.jpg': 'https://images.unsplash.com/photo-1556679343-c7306c1976bc?auto=format&fit=crop&w=1000&q=85',

  // Echte Flaschen-/Produktbilder für Biere
  'maisels_original.jpg': 'https://www.maiselandfriends.com/userdata/dcshop/images/thumb_3/246568_maisels-weisse-original_flasche-glas_1.png',
  'maisels_dunkel.jpg': 'https://www.maiselandfriends.com/userdata/dcshop/images/thumb_3/93918_flaschenabbildung-maisels-weisse-dunkel-05l.png',
  'maisels_kristall.jpg': 'https://mediafile.deloma.de/image/upload/c_fit,f_auto,h_512,q_auto,w_512/v1/images/product/0978fec5-5914-45cd-b911-26ce3c17972b.png',
  'maisels_leicht.jpg': 'https://www.maiselandfriends.com/userdata/dcshop/images/thumb_3/246568_maisels-weisse-original_flasche-glas_1.png',
  'maisels_alkoholfrei.jpg': 'https://www.maiselandfriends.com/userdata/dcshop/images/normal/242448_maiselfriends_urban-ipa-alkoholfrei_flasche-glas_1.png',
  'friends_paleale.jpg': 'https://www.maiselandfriends.com/userdata/dcshop/images/normal/106722_597169_maisel-and-friends-pale-ale-flasche-und-glas.png',
  'friends_ipa.jpg': 'https://www.maiselandfriends.com/userdata/dcshop/images/normal/764765_833637_mf_ipa_flasche_glas_shop.png',
  'friends_urbanipa.jpg': 'https://www.maiselandfriends.com/userdata/dcshop/images/normal/983181_726048_urban-ipa-flasche-glas.png',
  'friends_westcoast.jpg': 'https://www.maiselandfriends.com/userdata/dcshop/images/normal/149088_87412_maisel-and-friends-west-coast-ipa-flasche-und-glas.png',
  'friends_europhia.jpg': 'https://www.maiselandfriends.com/userdata/dcshop/images/normal/361117_maiselfriends_europia_flasche-glas.png',
  'friends_hoppyhell.jpg': 'https://www.meibier.de/storage/images/image?height=2560&remote=https%3A%2F%2Fwww.meibier.de%2FWebRoot%2FStore26%2FShops%2F90277484%2F6128%2FD27A%2FF0ED%2F5746%2F9BE3%2F0A0C%2F6D12%2F8D49%2FMaisel-and-Friends-Hoppy-Hell-online-bestellen-meibier.jpg&shop=90277484&width=600',
  'friends_urban_alkoholfrei.jpg': 'https://www.maiselandfriends.com/userdata/dcshop/images/normal/242448_maiselfriends_urban-ipa-alkoholfrei_flasche-glas_1.png',
  'bayreuther_hell.jpg': 'https://mediafile.deloma.de/image/upload/c_fit%2Cf_auto%2Ch_512%2Cq_auto%2Cw_512/v1/images/product/d646943b-341c-4ab8-b793-20e76fd28aff.png',
  'bayreuther_weissbier.jpg': 'https://www.maiselandfriends.com/userdata/dcshop/images/normal/178759_506903_a10762-001155-bayreuther-hell-alkoholfrei-0-50-l-flasche-glas.png',
  'aktien_dunkel.jpg': 'https://www.kelemidis.de/media/cache/65/89/6589d31994f4827319ebe88cfa92259d.jpg',
  'aktien_zwickl.jpg': 'https://www.kelemidis.de/media/cache/65/89/6589d31994f4827319ebe88cfa92259d.jpg',
  'aktien_pils.jpg': 'https://www.kelemidis.de/media/cache/65/89/6589d31994f4827319ebe88cfa92259d.jpg',
  'weismainer_pils.jpg': 'https://www.meibier.de/storage/images/image?height=2560&remote=https%3A%2F%2Fwww.meibier.de%2FWebRoot%2FStore26%2FShops%2F90277484%2F6018%2F2EFF%2FEA52%2F17C3%2F801E%2F0A0C%2F6D12%2F55AE%2Fweismainer-pils-meibier.jpg&shop=90277484&width=600',
  'weismainer_alkoholfrei.jpg': 'https://www.maiselandfriends.com/userdata/dcshop/images/normal/178759_506903_a10762-001155-bayreuther-hell-alkoholfrei-0-50-l-flasche-glas.png',
  'weismainer_landbier.jpg': 'https://www.meibier.de/storage/images/image?height=2560&remote=https%3A%2F%2Fwww.meibier.de%2FWebRoot%2FStore26%2FShops%2F90277484%2F6018%2F2EFF%2FEA52%2F17C3%2F801E%2F0A0C%2F6D12%2F55AE%2Fweismainer-pils-meibier.jpg&shop=90277484&width=600',
  'weismainer_flechterla.jpg': 'https://www.meibier.de/storage/images/image?height=2560&remote=https%3A%2F%2Fwww.meibier.de%2FWebRoot%2FStore26%2FShops%2F90277484%2F6128%2FD27A%2FF0ED%2F5746%2F9BE3%2F0A0C%2F6D12%2F8D49%2FMaisel-and-Friends-Hoppy-Hell-online-bestellen-meibier.jpg&shop=90277484&width=600',
  'weismainer_abt_knauer.jpg': 'https://www.meibier.de/storage/images/image?height=2560&remote=https%3A%2F%2Fwww.meibier.de%2FWebRoot%2FStore26%2FShops%2F90277484%2F6018%2F2EFF%2FEA52%2F17C3%2F801E%2F0A0C%2F6D12%2F55AE%2Fweismainer-pils-meibier.jpg&shop=90277484&width=600'
};

function imageFileName(path = '') {
  return String(path).split('?')[0].split('/').filter(Boolean).pop() || '';
}

function apiImageUrl(path = '') {
  if (!path) return '';
  if (/^https?:\/\//i.test(path)) return path;
  return `${API_ORIGIN}${path.startsWith('/') ? path : `/${path}`}`;
}

function productImage(product) {
  const file = imageFileName(product?.image);
  return imageOverrides[file] || apiImageUrl(product?.image) || 'https://images.unsplash.com/photo-1546069901-ba9599a7e63c?auto=format&fit=crop&w=1000&q=85';
}

function ratingFor(id) {
  const values = { 1: 4.8, 2: 4.7, 3: 4.6, 4: 4.9, 5: 4.5, 6: 4.4, 7: 4.8, 8: 4.2, 9: 4.7 };
  return values[id] || 4.5;
}
function reviewsFor(id) { return 47 + id * 19; }
function money(value) { return new Intl.NumberFormat('de-DE', { style: 'currency', currency: 'EUR' }).format(Number(value || 0)); }

function normalizeProducts(payload) {
  const list = Array.isArray(payload) ? payload : payload?.data || payload?.products || payload?.items || [];
  if (!Array.isArray(list)) return [];
  return list.map((p) => ({
    id: p.id,
    name: p.name || p.title || 'Produkt',
    description: p.description || '',
    price: Number(p.price || 0),
    image: productImage(p),
    localImage: apiImageUrl(p.image),
    category: p.category || 'Sonstiges',
    rating: p.rating || ratingFor(p.id),
    reviews: p.reviews || reviewsFor(p.id)
  }));
}

function App() {
  const [products, setProducts] = useState([]);
  const [cart, setCart] = useState([]);
  const [query, setQuery] = useState('');
  const [category, setCategory] = useState('Alle');
  const [minRating, setMinRating] = useState(0);
  const [sort, setSort] = useState('popular');
  const [loading, setLoading] = useState(true);
  const [checkoutOpen, setCheckoutOpen] = useState(false);
  const [authOpen, setAuthOpen] = useState(false);
  const [user, setUser] = useState(null);
  const [orderDone, setOrderDone] = useState(null);

  useEffect(() => {
    async function loadProducts() {
      try {
        setLoading(true);
        const res = await fetch(`${API_BASE}/products`, { headers: { Accept: 'application/json' } });
        if (!res.ok) throw new Error(`HTTP ${res.status}`);
        const data = await res.json();
        const normalized = normalizeProducts(data);
        if (!normalized.length) throw new Error('API liefert keine Produktliste');
        setProducts(normalized);
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
      .then((res) => res.ok ? res.json() : Promise.reject())
      .then((data) => setUser(data))
      .catch(() => localStorage.removeItem('token'));
  }, []);

  const categories = useMemo(() => ['Alle', ...new Set(products.map((p) => p.category).filter(Boolean))], [products]);
  const filtered = useMemo(() => {
    let list = [...products];
    if (category !== 'Alle') list = list.filter((p) => p.category === category);
    if (query.trim()) {
      const q = query.toLowerCase();
      list = list.filter((p) => `${p.name} ${p.description} ${p.category}`.toLowerCase().includes(q));
    }
    if (minRating > 0) list = list.filter((p) => Number(p.rating) >= minRating);
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
    setUser(null);
  }
  async function checkout() {
    if (!cart.length) return;
    if (!localStorage.getItem('token')) { setCheckoutOpen(false); setAuthOpen(true); return; }
    const body = { items: cart.map((item) => ({ product_id: item.id, quantity: item.quantity })) };
    try {
      const token = localStorage.getItem('token');
      const res = await fetch(`${API_BASE}/checkout`, {
        method: 'POST',
        headers: { Accept: 'application/json', 'Content-Type': 'application/json', Authorization: `Bearer ${token}` },
        body: JSON.stringify(body)
      });
      if (!res.ok) throw new Error(`Checkout HTTP ${res.status}`);
      const data = await res.json();
      setOrderDone({ id: data.order_id || Math.floor(Math.random() * 90000 + 10000), amount: data.total_amount || total, live: true });
    } catch (error) {
      setOrderDone({ id: Math.floor(Math.random() * 90000 + 10000), amount: total, live: false });
    }
    setCart([]); setCheckoutOpen(false);
  }

  return <div className="app">
    <header className="hero">
      <nav className="nav">
        <div className="brand"><span>Foodly</span><small>Delivery</small></div>
        <div className="searchBox"><Search size={18}/><input value={query} onChange={(e) => setQuery(e.target.value)} placeholder="Gericht, Kategorie oder Zutat suchen" /></div>
        {user ? <button className="authButton" onClick={logout}><LogOut size={18}/> {user.name || 'Logout'}</button> : <button className="authButton" onClick={() => setAuthOpen(true)}><User size={18}/> Login</button>}
        <button className="cartButton" onClick={() => setCheckoutOpen(true)}><ShoppingCart size={20}/> Warenkorb <b>{cartCount}</b></button>
      </nav>
      <section className="heroContent">
        <div>
          <p className="eyebrow"><Bike size={16}/> Lieferbereit in deiner Umgebung</p>
          <h1>Frisch zubereitete Lieblingsgerichte, direkt an deine Tür geliefert.</h1>
          <p className="subline">Entdecke ausgewählte Gerichte, vergleiche Bewertungen und bestelle bequem mit wenigen Klicks.</p>
          <div className="badges"><span><Bike size={16}/> Schnelle Lieferung</span><span><ShieldCheck size={16}/> Sicher anmelden</span><span><Star size={16}/> Bewertungen</span></div>
        </div>
        <div className="heroCard"><strong>{money(total)}</strong><span>{cartCount ? 'Aktueller Warenkorb' : 'Warenkorb ist leer'}</span><button onClick={() => setCheckoutOpen(true)}>Zur Kasse</button></div>
      </section>
    </header>
    <main className="layout">
      <aside className="filters">
        <h3><SlidersHorizontal size={18}/> Filter</h3><label>Kategorie</label>
        <div className="chips">{categories.map((cat) => <button key={cat} className={cat === category ? 'active' : ''} onClick={() => setCategory(cat)}>{cat}</button>)}</div>
        <label>Mindestens Bewertung</label><select value={minRating} onChange={(e) => setMinRating(Number(e.target.value))}><option value="0">Alle Bewertungen</option><option value="4.5">ab 4,5 Sterne</option><option value="4.7">ab 4,7 Sterne</option><option value="4.8">ab 4,8 Sterne</option></select>
        <label>Sortieren</label><select value={sort} onChange={(e) => setSort(e.target.value)}><option value="popular">Beliebtheit</option><option value="rating">Bewertung</option><option value="price-low">Preis aufsteigend</option><option value="price-high">Preis absteigend</option></select>
      </aside>
      <section className="products"><div className="sectionHead"><div><h2>Produktauswahl</h2><p>{filtered.length} Produkte verfügbar</p></div></div>{loading ? <div className="empty">Produkte werden geladen...</div> : <div className="grid">{filtered.map((product) => <ProductCard key={product.id} product={product} onAdd={addToCart}/>)}</div>}</section>
    </main>
    {checkoutOpen && <CartDrawer cart={cart} subtotal={subtotal} delivery={delivery} total={total} user={user} onLogin={() => { setCheckoutOpen(false); setAuthOpen(true); }} onClose={() => setCheckoutOpen(false)} onQty={changeQuantity} onCheckout={checkout} />}
    {authOpen && <AuthModal onClose={() => setAuthOpen(false)} onLogin={(u) => { setUser(u); setAuthOpen(false); }} />}
    {orderDone && <div className="toast" onClick={() => setOrderDone(null)}>Bestellung #{orderDone.id} {orderDone.live ? 'übermittelt' : 'simuliert'} - {money(orderDone.amount)}</div>}
  </div>;
}

function ProductCard({ product, onAdd }) {
  const [source, setSource] = useState(product.image);
  const fallback = product.localImage || '/images/cheeseburger.jpg';
  const isDrink = product.category === 'Getränke';
  return <article className={`productCard ${isDrink ? 'drinkCard' : ''}`}><div className={`imageWrap ${isDrink ? 'bottleImage' : ''}`}><img src={source || fallback} onError={() => setSource(fallback)} alt={product.name}/><span>{product.category}</span></div><div className="cardBody"><div className="rating"><Star size={16} fill="currentColor"/> {Number(product.rating).toFixed(1)} <small>({product.reviews})</small></div><h3>{product.name}</h3><p>{product.description}</p><div className="cardFoot"><strong>{money(product.price)}</strong><button onClick={() => onAdd(product)}><Plus size={18}/> Hinzufügen</button></div></div></article>;
}

function CartDrawer({ cart, subtotal, delivery, total, user, onLogin, onClose, onQty, onCheckout }) {
  return <div className="drawerBackdrop"><aside className="drawer"><div className="drawerHead"><h2>Dein Warenkorb</h2><button onClick={onClose}><X size={20}/></button></div>{!cart.length ? <div className="empty">Noch nichts im Warenkorb.</div> : <><div className="cartItems">{cart.map((item) => <div className="cartItem" key={item.id}><div><strong>{item.name}</strong><span>{money(item.price)}</span></div><div className="qty"><button onClick={() => onQty(item.id, -1)}><Minus size={14}/></button><b>{item.quantity}</b><button onClick={() => onQty(item.id, 1)}><Plus size={14}/></button><button className="trash" onClick={() => onQty(item.id, -999)}><Trash2 size={14}/></button></div></div>)}</div><div className="summary"><p><span>Zwischensumme</span><b>{money(subtotal)}</b></p><p><span>Lieferung</span><b>{delivery ? money(delivery) : 'Gratis'}</b></p><p className="total"><span>Gesamt</span><b>{money(total)}</b></p>{user ? <button onClick={onCheckout}>Bestellung abschicken</button> : <button onClick={onLogin}><LockKeyhole size={16}/> Einloggen zum Bestellen</button>}</div></>}</aside></div>;
}

function AuthModal({ onClose, onLogin }) {
  const [mode, setMode] = useState('login');
  const [name, setName] = useState('');
  const [email, setEmail] = useState('');
  const [password, setPassword] = useState('');
  const [error, setError] = useState('');
  const [busy, setBusy] = useState(false);
  async function submit(e) {
    e.preventDefault(); setError(''); setBusy(true);
    try {
      const endpoint = mode === 'register' ? 'register' : 'login';
      const body = mode === 'register' ? { name, email, password } : { email, password };
      const res = await fetch(`${API_BASE}/${endpoint}`, { method: 'POST', headers: { Accept: 'application/json', 'Content-Type': 'application/json' }, body: JSON.stringify(body) });
      const data = await res.json();
      if (!res.ok || !data.access_token) throw new Error(data.message || 'Anmeldung fehlgeschlagen');
      localStorage.setItem('token', data.access_token);
      const userRes = await fetch(`${API_BASE}/user`, { headers: { Accept: 'application/json', Authorization: `Bearer ${data.access_token}` } });
      const userData = userRes.ok ? await userRes.json() : { name: name || email, email };
      onLogin(userData);
    } catch (err) { setError(err.message || 'Bitte Zugangsdaten prüfen.'); }
    finally { setBusy(false); }
  }
  return <div className="drawerBackdrop"><div className="authModal"><div className="drawerHead"><h2>{mode === 'register' ? 'Konto erstellen' : 'Einloggen'}</h2><button onClick={onClose}><X size={20}/></button></div><p className="authHint">Melde dich an, damit die Bestellung über das Backend verarbeitet werden kann.</p><form onSubmit={submit}>{mode === 'register' && <input value={name} onChange={(e) => setName(e.target.value)} placeholder="Name" required />}<input value={email} onChange={(e) => setEmail(e.target.value)} type="email" placeholder="E-Mail" required /><input value={password} onChange={(e) => setPassword(e.target.value)} type="password" placeholder="Passwort" required />{error && <div className="formError">{error}</div>}<button className="primaryWide" disabled={busy}>{busy ? 'Bitte warten...' : mode === 'register' ? 'Registrieren' : 'Einloggen'}</button></form><button className="linkButton" onClick={() => setMode(mode === 'register' ? 'login' : 'register')}>{mode === 'register' ? 'Ich habe bereits ein Konto' : 'Neues Konto erstellen'}</button></div></div>;
}

createRoot(document.getElementById('root')).render(<App />);
