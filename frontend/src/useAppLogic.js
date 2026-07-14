import { useEffect, useMemo, useState } from 'react';

const API_BASE = import.meta.env.VITE_API_BASE || 'http://localhost:8000/api';
const CART_KEY = 'foodly_cart';
const API_ORIGIN = API_BASE.replace(/\/api\/?$/, '');

// Hilfsfunktionen
export function apiImageUrl(product) {
  const image = product?.image_url || product?.image || '';
  if (!image) return `${API_ORIGIN}/images/cheeseburger.jpg`; 
  if (/^https?:\/\//i.test(image)) return image;
  return `${API_ORIGIN}${image.startsWith('/') ? image : `/${image}`}`;
}

export function ratingFor(id) {
  return ({ 1: 4.8, 2: 4.7, 3: 4.6, 4: 4.9, 5: 4.5, 6: 4.4, 7: 4.8, 8: 4.2, 9: 4.7 }[id] || 4.5);
}

export function reviewsFor(id) {
  return 47 + Number(id || 1) * 19;
}

export function money(value) {
  return new Intl.NumberFormat('de-DE', { style: 'currency', currency: 'EUR' }).format(Number(value || 0));
}

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

export function validateAddress(address) {
  const streetOk = /^.+\s+[0-9]+[a-zA-Z]?$/.test(address.street.trim());
  const zipOk = /^[0-9]{5}$/.test(address.zip.trim());
  const cityOk = address.city.trim().length >= 2;
  if (!streetOk) return 'Bitte gib Straße und Hausnummer ein, z. B. Musterstraße 12.';
  if (!zipOk) return 'Bitte gib eine gültige deutsche PLZ mit 5 Ziffern ein.';
  if (!cityOk) return 'Bitte gib einen gültigen Ort ein.';
  return '';
}

// Haupt-Logik Hook
export function useAppLogic() {
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

  return {
    query, setQuery, category, setCategory, minRating, setMinRating, sort, setSort,
    loading, checkoutOpen, setCheckoutOpen, authOpen, setAuthOpen, user, setUser,
    orderDone, setOrderDone, checkoutError, categories, filtered, cart, cartCount,
    subtotal, delivery, total, addToCart, changeQuantity, logout, checkout
  };
}