import React, { useState } from 'react';
// Importiert unsere Icons
import { ShoppingCart, Search, Star, SlidersHorizontal, Plus, Minus, Trash2, Bike, ShieldCheck, X, User, LogOut, LockKeyhole, MapPin } from 'lucide-react';
// Importiert das Gehirn und die Hilfswerkzeuge, die wir vorhin gebaut haben
import { useAppLogic, money, validateAddress, apiImageUrl } from './useAppLogic';

const API_BASE = import.meta.env.VITE_API_BASE || 'http://localhost:8000/api';

export default function App() {
  // Hier schließen wir das "Kabel" an und holen uns alle Variablen aus der useAppLogic.js
  const {
    query, setQuery, category, setCategory, minRating, setMinRating, sort, setSort,
    loading, checkoutOpen, setCheckoutOpen, authOpen, setAuthOpen, user, setUser,
    orderDone, setOrderDone, checkoutError, categories, filtered, cart, cartCount,
    subtotal, delivery, total, addToCart, changeQuantity, logout, checkout
  } = useAppLogic();

  return (
    <div className="app">
      
      {/* 1. DER KOPFBEREICH (HERO & NAVIGATION) */}
      <header className="hero">
        <nav className="nav" aria-label="Hauptnavigation">
          <div className="brand"><span>Foodly</span><small>Delivery</small></div>
          
          {/* Die Suchleiste. Wenn jemand tippt (onChange), sendet setQuery das ans Gehirn */}
          <label className="searchBox">
            <Search size={20}/>
            <input value={query} onChange={(event) => setQuery(event.target.value)} placeholder="Gericht suchen" />
          </label>
          
          {/* Zeigt entweder den Logout-Button (wenn eingeloggt) oder Login (wenn Gast) */}
          {user ? (
            <button className="authButton" onClick={logout}><LogOut size={18}/> {user.name || 'Logout'}</button>
          ) : (
            <button className="authButton" onClick={() => setAuthOpen(true)}><User size={18}/> Login</button>
          )}
          
          {/* Der Warenkorb-Button oben rechts */}
          <button className="cartButton" onClick={() => setCheckoutOpen(true)}>
            <ShoppingCart size={22}/> Warenkorb <b>{cartCount}</b>
          </button>
        </nav>
        
        {/* Der Werbetext mit dem blauen/goldenen Design */}
        <section className="heroContent">
          <div>
            <p className="eyebrow"><Bike size={16}/> Lieferbereit in deiner Umgebung</p>
            <h1>Liebesbier auch bei dir Zuhause</h1>
            <p className="subline">Maisel-inspirierte Genussmomente direkt zu dir.</p>
          </div>
          
          {/* Der kleine schwebende Kasten rechts im Titelbild */}
          <div className="heroCard">
            <strong>{money(total)}</strong>
            <span>{cartCount ? 'Aktueller Warenkorb' : 'Warenkorb ist leer'}</span>
            <button onClick={() => setCheckoutOpen(true)}>Zur Kasse</button>
          </div>
        </section>
      </header>

      {/* 2. DER HAUPTTEIL (FILTER UND PRODUKT-RASTER) */}
      <main className="layout">
        
        {/* Die Seitenleiste links mit den Filtern */}
        <aside className="filters">
          <h3><SlidersHorizontal size={18}/> Filter</h3>
          
          <label>Kategorie</label>
          <div className="chips">
            {/* Zeichnet für jede gefundene Kategorie einen Button */}
            {categories.map((cat) => (
              <button key={cat} className={cat === category ? 'active' : ''} onClick={() => setCategory(cat)}>{cat}</button>
            ))}
          </div>
          
          <label>Mindestens Bewertung</label>
          <select value={minRating} onChange={(event) => setMinRating(Number(event.target.value))}>
            <option value="0">Alle Bewertungen</option>
            <option value="4.5">ab 4,5 Sterne</option>
            <option value="4.8">ab 4,8 Sterne</option>
          </select>
          
          <label>Sortieren</label>
          <select value={sort} onChange={(event) => setSort(event.target.value)}>
            <option value="popular">Beliebtheit</option>
            <option value="price-low">Preis aufsteigend</option>
            <option value="price-high">Preis absteigend</option>
          </select>
        </aside>

        {/* Die Mitte mit den Gerichten */}
        <section className="products">
          <div className="sectionHead">
            <div><h2>Produktauswahl</h2><p>{filtered.length} Produkte verfügbar</p></div>
          </div>
          
          {/* Entweder Lade-Text oder das fertige Raster der Produkte */}
          {loading ? (
            <div className="empty">Produkte werden geladen...</div>
          ) : (
            <div className="grid">
              {/* Geht die gefilterte Liste durch und gibt für jedes Essen eine ProductCard aus */}
              {filtered.map((product) => <ProductCard key={product.id} product={product} onAdd={addToCart}/>)}
            </div>
          )}
        </section>
      </main>

      {/* 3. POPUPS (VERSTECKTE ELEMENTE) */}
      {/* Diese Elemente werden nur in das HTML geladen, wenn ihr "Open"-Wert true ist */}
      {checkoutOpen && <CartDrawer cart={cart} subtotal={subtotal} delivery={delivery} total={total} user={user} error={checkoutError} onLogin={() => { setCheckoutOpen(false); setAuthOpen(true); }} onClose={() => setCheckoutOpen(false)} onQty={changeQuantity} onCheckout={checkout} />}
      {authOpen && <AuthModal onClose={() => setAuthOpen(false)} onLogin={(loggedInUser) => { setUser(loggedInUser); setAuthOpen(false); }} />}
      
      {/* Die kleine Erfolgsmeldung unten am Rand nach der Bestellung */}
      {orderDone && <div className="toast" onClick={() => setOrderDone(null)}>Bestellung #{orderDone.id} übermittelt - {money(orderDone.amount)}</div>}
    </div>
  );
}

// === KOMPONENTE: DIE EINZELNE PRODUKTKARTE ===
function ProductCard({ product, onAdd }) {
  const API_ORIGIN = API_BASE.replace(/\/api\/?$/, '');
  const [source, setSource] = useState(product.image);
  
  return (
    <article className={`productCard ${product.category === 'Getränke' ? 'drinkCard' : ''}`}>
      <div className="imageWrap">
        {/* onError feuert, falls das Bild-URL vom Backend kaputt ist. Zeigt dann den Cheeseburger */}
        <img src={source} onError={() => setSource(`${API_ORIGIN}/images/cheeseburger.jpg`)} alt={product.name}/>
        <span>{product.category}</span>
      </div>
      <div className="cardBody">
        <div className="rating"><Star size={16} fill="currentColor"/> {Number(product.rating).toFixed(1)}</div>
        <h3>{product.name}</h3>
        <p>{product.description}</p>
        <div className="cardFoot">
          <strong>{money(product.price)}</strong>
          {/* Löst die addToCart-Funktion in useAppLogic.js aus */}
          <button onClick={() => onAdd(product)}><Plus size={18}/> Hinzufügen</button>
        </div>
      </div>
    </article>
  );
}

// === KOMPONENTE: DER WARENKORB (SLIDER VON RECHTS) ===
function CartDrawer({ cart, subtotal, delivery, total, user, error, onLogin, onClose, onQty, onCheckout }) {
  const [useCustomAddress, setUseCustomAddress] = useState(false);
  const [address, setAddress] = useState({ street: '', zip: '', city: '' });
  const [addressError, setAddressError] = useState('');
  
  // Setzt die Straße des Users zusammen, falls er eingeloggt ist
  const defaultAddress = user ? `${user.delivery_street || ''}, ${user.delivery_zip || ''} ${user.delivery_city || ''}`.trim() : '';

  function submitOrder() {
    // Wenn er das Kästchen "andere Adresse" geklickt hat, wird die neue Adresse geprüft
    if (useCustomAddress) {
      const validation = validateAddress(address);
      if (validation) { setAddressError(validation); return; }
      onCheckout({ street: address.street.trim(), zip: address.zip.trim(), city: address.city.trim() });
      return;
    }
    // Sonst bestellt er einfach mit der Standard-Adresse aus seinem Account
    onCheckout(null);
  }

  return (
    <div className="drawerBackdrop">
      <aside className="drawer">
        <div className="drawerHead"><h2>Dein Warenkorb</h2><button onClick={onClose}><X size={20}/></button></div>
        
        {!cart.length ? (
          <div className="empty">Noch nichts im Warenkorb.</div>
        ) : (
          <>
            <div className="cartItems">
              {/* Malt für jedes Essen im Warenkorb eine Zeile mit Plus/Minus/Löschen */}
              {cart.map((item) => (
                <div className="cartItem" key={item.id}>
                  <div><strong>{item.name}</strong><span>{money(item.price)}</span></div>
                  <div className="qty">
                    <button onClick={() => onQty(item.id, -1)}><Minus size={14}/></button>
                    <b>{item.quantity}</b>
                    <button onClick={() => onQty(item.id, 1)}><Plus size={14}/></button>
                    <button className="trash" onClick={() => onQty(item.id, -999)}><Trash2 size={14}/></button>
                  </div>
                </div>
              ))}
            </div>
            
            {/* Der Adress-Block (nur sichtbar, wenn man eingeloggt ist) */}
            {user && (
              <div className="addressBox">
                <p><MapPin size={16}/> Lieferadresse</p>
                <strong>{defaultAddress || 'Keine Adresse hinterlegt'}</strong>
                <label className="checkRow">
                  <input type="checkbox" checked={useCustomAddress} onChange={(event) => setUseCustomAddress(event.target.checked)} /> Andere Adresse
                </label>
                {useCustomAddress && (
                  <div className="addressGrid">
                    <input value={address.street} onChange={(event) => setAddress({ ...address, street: event.target.value })} placeholder="Straße" />
                    <input value={address.zip} onChange={(event) => setAddress({ ...address, zip: event.target.value })} placeholder="PLZ" />
                    <input value={address.city} onChange={(event) => setAddress({ ...address, city: event.target.value })} placeholder="Ort" />
                  </div>
                )}
                {addressError && <div className="formError">{addressError}</div>}
              </div>
            )}
            
            {/* Die Kassenzettel-Abrechnung ganz unten */}
            <div className="summary">
              <p><span>Zwischensumme</span><b>{money(subtotal)}</b></p>
              <p><span>Lieferung</span><b>{delivery ? money(delivery) : 'Gratis'}</b></p>
              <p className="total"><span>Gesamt</span><b>{money(total)}</b></p>
              {error && <div className="formError">{error}</div>}
              
              {/* Zeigt "Bestellen" (wenn eingeloggt) oder "Einloggen zum Bestellen" (wenn Gast) */}
              {user ? <button onClick={submitOrder}>Bestellung abschicken</button> : <button onClick={onLogin}><LockKeyhole size={16}/> Einloggen zum Bestellen</button>}
            </div>
          </>
        )}
      </aside>
    </div>
  );
}

// === KOMPONENTE: LOGIN & REGISTRIERUNG ===
function AuthModal({ onClose, onLogin }) {
  const [mode, setMode] = useState('login'); // Startet immer im Login-Modus
  const [form, setForm] = useState({ name: '', email: '', password: '', delivery_street: '', delivery_zip: '', delivery_city: '' });
  const [error, setError] = useState('');
  const [busy, setBusy] = useState(false); // Verhindert, dass man 10x auf den Login-Button klickt

  function update(field, value) {
    // Schreibt die Tastenanschläge in das "form"-Gedächtnis
    setForm((current) => ({ ...current, [field]: value }));
  }

  async function submit(event) {
    event.preventDefault(); // Verhindert, dass der Browser die Seite neu lädt
    setError('');
    
    // Prüft bei Registrierung, ob die Adresse gültig ist
    if (mode === 'register') {
      const validation = validateAddress({ street: form.delivery_street, zip: form.delivery_zip, city: form.delivery_city });
      if (validation) { setError(validation); return; }
    }
    
    setBusy(true);
    try {
      // Sendet die Daten ans Backend (entweder an /login oder /register)
      const endpoint = mode === 'register' ? 'register' : 'login';
      const body = mode === 'register' ? form : { email: form.email, password: form.password };
      const response = await fetch(`${API_BASE}/${endpoint}`, { method: 'POST', headers: { Accept: 'application/json', 'Content-Type': 'application/json' }, body: JSON.stringify(body) });
      const data = await response.json();
      
      if (!response.ok || !data.access_token) throw new Error(data.message || 'Anmeldung fehlgeschlagen');
      
      // Speichert den "Haustürschlüssel" (Token) im Browser ab
      localStorage.setItem('token', data.access_token);
      onLogin(data.user || { name: form.name || form.email, email: form.email });
    } catch (err) {
      setError(err.message || 'Bitte Zugangsdaten prüfen.');
    } finally {
      setBusy(false);
    }
  }

  return (
    <div className="drawerBackdrop">
      <div className="authModal">
        <div className="drawerHead">
          <h2>{mode === 'register' ? 'Konto erstellen' : 'Einloggen'}</h2>
          <button onClick={onClose}><X size={20}/></button>
        </div>
        <form onSubmit={submit}>
          
          {/* Felder, die nur sichtbar sind, wenn der Modus "register" ist */}
          {mode === 'register' && (
            <>
              <input value={form.name} onChange={(event) => update('name', event.target.value)} placeholder="Name" required />
              <input value={form.delivery_street} onChange={(event) => update('delivery_street', event.target.value)} placeholder="Straße und Hausnummer" required />
              <div className="splitFields">
                <input value={form.delivery_zip} onChange={(event) => update('delivery_zip', event.target.value)} placeholder="PLZ" required />
                <input value={form.delivery_city} onChange={(event) => update('delivery_city', event.target.value)} placeholder="Ort" required />
              </div>
            </>
          )}
          
          {/* E-Mail und Passwort sieht man bei beidem (Login & Register) */}
          <input value={form.email} onChange={(event) => update('email', event.target.value)} type="email" placeholder="E-Mail" required />
          <input value={form.password} onChange={(event) => update('password', event.target.value)} type="password" placeholder="Passwort" required />
          
          {error && <div className="formError">{error}</div>}
          
          <button className="primaryWide" disabled={busy}>
            {busy ? 'Bitte warten...' : mode === 'register' ? 'Registrieren' : 'Einloggen'}
          </button>
        </form>
        
        {/* Der kleine Link-Button ganz unten, um den Modus umzuschalten */}
        <button className="linkButton" onClick={() => setMode(mode === 'register' ? 'login' : 'register')}>
          {mode === 'register' ? 'Ich habe bereits ein Konto' : 'Neues Konto erstellen'}
        </button>
      </div>
    </div>
  );
}