/* ===== LOADING SCREEN ===== */
window.addEventListener('load', () => {
  const loader = document.querySelector('.loading-screen');
  if (loader) {
    setTimeout(() => {
      loader.classList.add('hidden');
      document.body.style.overflow = '';
    }, 800);
  }
  updateCartCount();
});

/* ===== HEADER SCROLL ===== */
const header = document.getElementById('header');
let lastScroll = 0;
window.addEventListener('scroll', () => {
  const currentScroll = window.scrollY;
  if (header) {
    header.classList.toggle('scrolled', currentScroll > 50);
  }
  const scrollBtn = document.querySelector('.scroll-to-top');
  if (scrollBtn) {
    scrollBtn.classList.toggle('visible', currentScroll > 500);
  }
});

/* ===== MOBILE MENU ===== */
const menuToggle = document.getElementById('menuToggle');
const navMenu = document.getElementById('navMenu');
if (menuToggle && navMenu) {
  menuToggle.addEventListener('click', () => {
    menuToggle.classList.toggle('open');
    navMenu.classList.toggle('open');
    document.body.style.overflow = navMenu.classList.contains('open') ? 'hidden' : '';
  });
  document.querySelectorAll('.nav-link').forEach(link => {
    link.addEventListener('click', () => {
      menuToggle.classList.remove('open');
      navMenu.classList.remove('open');
      document.body.style.overflow = '';
    });
  });
}

/* ===== SCROLL TO TOP ===== */
document.querySelector('.scroll-to-top')?.addEventListener('click', (e) => {
  e.preventDefault();
  window.scrollTo({ top: 0, behavior: 'smooth' });
});

/* ===== STATS COUNTER ===== */
function initCounters() {
  const counters = document.querySelectorAll('.stat-number');
  if (!counters.length) return;
  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        const el = entry.target;
        const target = parseInt(el.dataset.count) || parseInt(el.closest('.stat-item')?.dataset.count) || 0;
        if (target > 0) {
          animateCounter(el, target);
        }
        observer.unobserve(el);
      }
    });
  }, { threshold: 0.5 });

  counters.forEach(c => {
    const parent = c.closest('.stat-item');
    if (parent) {
      c.dataset.count = parent.dataset.count;
    }
    observer.observe(c);
  });
}

function animateCounter(el, target) {
  let current = 0;
  const step = Math.max(1, Math.floor(target / 60));
  const interval = setInterval(() => {
    current += step;
    if (current >= target) {
      current = target;
      clearInterval(interval);
    }
    el.textContent = current.toLocaleString();
  }, 20);
}

/* ===== GALLERY FILTER ===== */
function initGalleryFilter() {
  const filters = document.querySelectorAll('.filter-btn');
  const items = document.querySelectorAll('.gallery-item');
  if (!filters.length || !items.length) return;

  filters.forEach(btn => {
    btn.addEventListener('click', () => {
      filters.forEach(b => b.classList.remove('active'));
      btn.classList.add('active');
      const filter = btn.dataset.filter;
      items.forEach(item => {
        if (filter === 'all' || item.dataset.category === filter) {
          item.style.display = 'block';
          item.style.opacity = '0';
          setTimeout(() => { item.style.opacity = '1'; }, 50);
        } else {
          item.style.display = 'none';
        }
      });
    });
  });
}

/* ===== CART SYSTEM ===== */
const CART_KEY = 'hk_cart';

function getCart() {
  try { return JSON.parse(localStorage.getItem(CART_KEY)) || []; }
  catch { return []; }
}

function saveCart(cart) {
  localStorage.setItem(CART_KEY, JSON.stringify(cart));
}

function updateCartCount() {
  const cart = getCart();
  const count = cart.reduce((s, i) => s + i.qty, 0);
  document.querySelectorAll('.cart-count').forEach(el => {
    el.textContent = count;
    el.classList.toggle('show', count > 0);
  });
}

function addToCart(id, name, color, price, emoji) {
  let cart = getCart();
  const existing = cart.find(i => i.id === id && i.color === color);
  if (existing) {
    existing.qty += 1;
  } else {
    cart.push({ id, name, color, priceTnd: price.tnd, priceEur: price.eur, qty: 1, emoji });
  }
  saveCart(cart);
  updateCartCount();
  showToast(`${name} ajouté au panier`, 'success');
}

function removeFromCart(id, color) {
  let cart = getCart().filter(i => !(i.id === id && i.color === color));
  saveCart(cart);
  updateCartCount();
  renderCartPage();
  renderCartSidebar();
}

function updateQty(id, color, delta) {
  let cart = getCart();
  const item = cart.find(i => i.id === id && i.color === color);
  if (!item) return;
  item.qty = Math.max(1, item.qty + delta);
  saveCart(cart);
  updateCartCount();
  renderCartPage();
  renderCartSidebar();
}

function renderCartSidebar() {
  const body = document.getElementById('cartBody');
  const totalTND = document.getElementById('cartTotalTND');
  const totalEUR = document.getElementById('cartTotalEUR');
  if (!body) return;

  const cart = getCart();
  if (cart.length === 0) {
    body.innerHTML = `<div class="cart-empty"><div class="cart-empty-icon">🛒</div><p>Votre panier est vide</p></div>`;
    if (totalTND) totalTND.textContent = '0,000 TND';
    if (totalEUR) totalEUR.textContent = '0,00 €';
    return;
  }

  let html = '', tTND = 0, tEUR = 0;
  cart.forEach(item => {
    const iTND = item.priceTnd * item.qty;
    const iEUR = item.priceEur * item.qty;
    tTND += iTND; tEUR += iEUR;
    html += `<div class="cart-item">
      <div class="cart-item-img">${item.emoji || '📦'}</div>
      <div class="cart-item-info">
        <div class="cart-item-name">${item.name}</div>
        <div class="cart-item-color">Couleur: ${item.color}</div>
        <div class="cart-item-bottom">
          <div class="cart-item-qty">
            <button class="qty-btn" onclick="updateQty('${item.id}','${item.color}',-1)">−</button>
            <span class="qty-value">${item.qty}</span>
            <button class="qty-btn" onclick="updateQty('${item.id}','${item.color}',1)">+</button>
          </div>
          <span class="cart-item-total">${fmtTND(iTND)}</span>
        </div>
        <button class="cart-item-remove" onclick="removeFromCart('${item.id}','${item.color}')">Supprimer</button>
      </div>
    </div>`;
  });
  body.innerHTML = html;
  if (totalTND) totalTND.textContent = fmtTND(tTND);
  if (totalEUR) totalEUR.textContent = fmtEUR(tEUR);
}

function renderCartPage() {
  const container = document.getElementById('cartPageItems');
  if (!container) return;

  const cart = getCart();
  if (cart.length === 0) {
    container.innerHTML = `<div class="cart-page-empty">
      <div class="icon">🛒</div>
      <h3>Votre panier est vide</h3>
      <p>Découvrez nos produits dans la boutique</p>
      <a href="boutique.html" class="btn-primary">Voir la boutique</a>
    </div>`;
    const summary = document.getElementById('cartPageSummary');
    if (summary) summary.style.display = 'none';
    return;
  }

  let html = '', tTND = 0, tEUR = 0;
  cart.forEach(item => {
    const iTND = item.priceTnd * item.qty;
    const iEUR = item.priceEur * item.qty;
    tTND += iTND; tEUR += iEUR;
    html += `<div class="cart-page-item">
      <div class="cart-page-img">${item.emoji || '📦'}</div>
      <div class="cart-page-info">
        <h4>${item.name}</h4>
        <p>Couleur: ${item.color} — ${fmtTND(item.priceTnd)} / unité</p>
        <div class="cart-page-actions">
          <div class="cart-page-qty">
            <button onclick="updateQty('${item.id}','${item.color}',-1)">−</button>
            <span>${item.qty}</span>
            <button onclick="updateQty('${item.id}','${item.color}',1)">+</button>
          </div>
          <button class="cart-page-remove" onclick="removeFromCart('${item.id}','${item.color}')"><i class="fas fa-trash-alt"></i> Supprimer</button>
        </div>
      </div>
      <div class="cart-page-total">${fmtTND(iTND)}</div>
    </div>`;
  });
  container.innerHTML = html;

  const summary = document.getElementById('cartPageSummary');
  if (summary) {
    summary.style.display = 'block';
    document.getElementById('cartSubtotalTND').textContent = fmtTND(tTND);
    document.getElementById('cartSubtotalEUR').textContent = fmtEUR(tEUR);
    document.getElementById('cartTotalTNDPage').textContent = fmtTND(tTND);
    document.getElementById('cartTotalEURPage').textContent = fmtEUR(tEUR);
  }
}

/* ===== FORMATTERS ===== */
function fmtTND(v) { return (v / 1000).toLocaleString('fr-TN', { minimumFractionDigits: 3, maximumFractionDigits: 3 }) + ' TND'; }
function fmtEUR(v) { return (v / 100).toLocaleString('fr-FR', { minimumFractionDigits: 2, maximumFractionDigits: 2 }) + ' €'; }

/* ===== TOAST ===== */
let toastTimer = null;
function showToast(msg, type = 'success') {
  const toast = document.getElementById('toast');
  if (!toast) return;
  toast.textContent = msg;
  toast.className = 'toast-shop ' + type;
  void toast.offsetWidth;
  toast.classList.add('show');
  clearTimeout(toastTimer);
  toastTimer = setTimeout(() => toast.classList.remove('show'), 3000);
}

/* ===== CART SIDEBAR TOGGLE ===== */
document.getElementById('cartToggle')?.addEventListener('click', () => {
  document.getElementById('cartSidebar')?.classList.add('open');
  document.getElementById('cartOverlay')?.classList.add('open');
  document.body.style.overflow = 'hidden';
  renderCartSidebar();
});
document.getElementById('cartClose')?.addEventListener('click', closeCartSidebar);
document.getElementById('cartOverlay')?.addEventListener('click', closeCartSidebar);
function closeCartSidebar() {
  document.getElementById('cartSidebar')?.classList.remove('open');
  document.getElementById('cartOverlay')?.classList.remove('open');
  document.body.style.overflow = '';
}
document.getElementById('checkoutBtn')?.addEventListener('click', () => {
  const cart = getCart();
  if (cart.length === 0) { showToast('Votre panier est vide', 'error'); return; }
  const total = cart.reduce((s, i) => s + i.priceTnd * i.qty, 0);
  showToast(`Commande de ${fmtTND(total)} confirmée ! Merci.`, 'success');
  localStorage.removeItem(CART_KEY);
  updateCartCount();
  renderCartSidebar();
  renderCartPage();
  closeCartSidebar();
});

/* ===== INIT ON LOAD ===== */
document.addEventListener('DOMContentLoaded', () => {
  AOS?.init({ duration: 1000, once: true });
  initCounters();
  initGalleryFilter();
  updateCartCount();
  renderCartSidebar();
  renderCartPage();
});
