/* ---------- Placeholder links never navigate/jump (real hrefs still work) ---------- */
document.addEventListener('click', (e) => {
  const a = e.target.closest('a[href="#"], .subnav a, .mobile-panel nav a, .hero-actions a, .blog-card');
  if (a && a.getAttribute('href') === '#') e.preventDefault();
});

/* ---------- Catalog mega menu ---------- */
const catalogBtn = document.getElementById('catalogBtn');
const megaMenu = document.getElementById('megaMenu');

function closeMega() {
  megaMenu.classList.remove('is-open');
  catalogBtn.setAttribute('aria-expanded', 'false');
}
catalogBtn.addEventListener('click', () => {
  if (window.matchMedia('(max-width:1024px)').matches) {
    showCatalogList();
    document.getElementById('mobileCatalogPanel').classList.add('is-open');
    return;
  }
  const willOpen = !megaMenu.classList.contains('is-open');
  megaMenu.classList.toggle('is-open', willOpen);
  catalogBtn.setAttribute('aria-expanded', String(willOpen));
});
document.addEventListener('click', (e) => {
  if (!megaMenu.contains(e.target) && !catalogBtn.contains(e.target)) closeMega();
});
document.addEventListener('keydown', (e) => { if (e.key === 'Escape') closeMega(); });

document.querySelectorAll('.mega-cat').forEach(btn => {
  btn.addEventListener('mouseenter', () => activateMegaCat(btn.dataset.cat));
  btn.addEventListener('click', () => activateMegaCat(btn.dataset.cat));
});
function activateMegaCat(cat) {
  document.querySelectorAll('.mega-cat').forEach(b => b.classList.toggle('is-active', b.dataset.cat === cat));
  document.querySelectorAll('.mega-panel').forEach(p => p.classList.toggle('is-active', p.dataset.panel === cat));
}
megaMenu.querySelectorAll('.mega-col a').forEach(a => a.addEventListener('click', closeMega));

document.getElementById('catalogNavLink').addEventListener('click', (e) => {
  if (window.matchMedia('(min-width:1025px)').matches) {
    e.preventDefault();
    e.stopPropagation();
    catalogBtn.click();
  }
});

/* ---------- Mobile menu ---------- */
const panel = document.getElementById('mobilePanel');
document.getElementById('menuOpen').addEventListener('click', () => panel.classList.add('is-open'));
document.getElementById('menuClose').addEventListener('click', () => panel.classList.remove('is-open'));
panel.querySelectorAll('a').forEach(a => a.addEventListener('click', () => panel.classList.remove('is-open')));
document.getElementById('mobileCallbackBtn').addEventListener('click', () => {
  panel.classList.remove('is-open');
  openModal(document.getElementById('callbackModal'));
});

document.getElementById('mobileNavCatalog').addEventListener('click', (e) => {
  e.preventDefault();
  panel.classList.remove('is-open');
  showCatalogList();
  document.getElementById('mobileCatalogPanel').classList.add('is-open');
});

/* ---------- Mobile catalog panel ---------- */
const mobileCatalogPanel = document.getElementById('mobileCatalogPanel');
const mobileCatalogList = document.getElementById('mobileCatalogList');
const mobileCatalogDetail = document.getElementById('mobileCatalogDetail');
const mobileCatalogBack = document.getElementById('mobileCatalogBack');
const mobileCatalogTitle = document.getElementById('mobileCatalogTitle');

let catalogView = 'list';
function showCatalogList() {
  catalogView = 'list';
  mobileCatalogList.style.display = '';
  mobileCatalogDetail.style.display = 'none';
  mobileCatalogBack.style.display = '';
  mobileCatalogTitle.textContent = 'Каталог';
}
function showCatalogDetail(cat, label) {
  const megaPanel = document.querySelector(`.mega-panel[data-panel="${cat}"]`);
  if (!megaPanel) return;
  catalogView = 'detail';
  mobileCatalogDetail.innerHTML = megaPanel.innerHTML;
  mobileCatalogDetail.querySelectorAll('a').forEach(a => a.addEventListener('click', () => {
    mobileCatalogPanel.classList.remove('is-open');
    showCatalogList();
  }));
  mobileCatalogList.style.display = 'none';
  mobileCatalogDetail.style.display = '';
  mobileCatalogBack.style.display = '';
  mobileCatalogTitle.textContent = label;
}
mobileCatalogList.querySelectorAll('.mobile-catalog-item[data-cat]').forEach(item => {
  item.addEventListener('click', (e) => {
    e.preventDefault();
    showCatalogDetail(item.dataset.cat, item.dataset.label);
  });
});
mobileCatalogBack.addEventListener('click', () => {
  if (catalogView === 'detail') {
    showCatalogList();
  } else {
    mobileCatalogPanel.classList.remove('is-open');
    panel.classList.add('is-open');
  }
});
document.getElementById('mobileCatalogClose').addEventListener('click', () => {
  mobileCatalogPanel.classList.remove('is-open');
  showCatalogList();
});

/* ---------- Mobile search bar ---------- */
const mobileSearchBar = document.getElementById('mobileSearchBar');
document.getElementById('mobileSearchBtn').addEventListener('click', () => {
  mobileSearchBar.classList.add('is-open');
  document.getElementById('mobileSearchInput').focus();
});
document.getElementById('mobileSearchClose').addEventListener('click', () => {
  mobileSearchBar.classList.remove('is-open');
  document.getElementById('mobileSearchDropdown').classList.remove('is-open');
});

/* ---------- Newsletter demo ---------- */
const newsletterForm = document.getElementById('newsletterForm');
const newsletterThanks = document.getElementById('newsletterThanks');
let newsletterTimer;
newsletterForm.addEventListener('submit', (e) => {
  e.preventDefault();
  newsletterForm.reset();
  newsletterThanks.classList.add('is-visible');
  clearTimeout(newsletterTimer);
  newsletterTimer = setTimeout(() => newsletterThanks.classList.remove('is-visible'), 3500);
});

/* ---------- Modals ---------- */
export function openModal(modal) {
  modal.classList.add('is-open');
  document.body.style.overflow = 'hidden';
}
export function closeModal(modal) {
  modal.classList.remove('is-open');
  document.body.style.overflow = '';
}
document.querySelectorAll('.modal-overlay').forEach(modal => {
  modal.addEventListener('click', (e) => { if (e.target === modal) closeModal(modal); });
  modal.querySelectorAll('[data-modal-close]').forEach(btn => btn.addEventListener('click', () => closeModal(modal)));
  if (modal.id === 'loginModal' || modal.id === 'addToCartModal' || modal.id === 'reviewModal' || modal.id === 'salonModal' || modal.id === 'vacancyDetailsModal') return;
  const form = modal.querySelector('[data-modal-form]');
  const modalBody = modal.querySelector('.modal-body');
  const originalForm = form.outerHTML;
  form.addEventListener('submit', (e) => {
    e.preventDefault();
    modalBody.innerHTML = `
      <div class="modal-thanks">
        <div class="icon-wrap"><svg class="icon" style="width:26px;height:26px"><use href="#i-check"/></svg></div>
        <h4>Спасибо!</h4>
        <p>Ваша заявка отправлена, мы свяжемся с вами в ближайшее время.</p>
      </div>`;
    setTimeout(() => {
      closeModal(modal);
      setTimeout(() => { modalBody.innerHTML = originalForm; wirePhoneMasks(modal); }, 300);
    }, 1800);
  });
});
document.addEventListener('keydown', (e) => {
  if (e.key === 'Escape') {
    document.querySelectorAll('.modal-overlay.is-open').forEach(closeModal);
    document.querySelectorAll('.drawer-overlay.is-open').forEach(closeModal);
  }
});

/* ---------- Drawers (cart / favorites) ---------- */
document.querySelectorAll('.drawer-overlay').forEach(drawer => {
  drawer.addEventListener('click', (e) => { if (e.target === drawer) closeModal(drawer); });
  drawer.querySelectorAll('[data-drawer-close]').forEach(btn => btn.addEventListener('click', () => closeModal(drawer)));
});

export let CART = [
  { id: 1, name: 'Оправа для очков Lokamed 34133 C6-2', price: 5650, img: 'assets/img/product1.png', qty: 1 },
  { id: 2, name: 'Оправа для очков Lokamed 37059 C9', price: 5650, img: 'assets/img/product2.png', qty: 1 },
];
export let FAVORITES = [
  { id: 3, name: 'Оправа для очков Lokamed 34132 C6-1', price: 5650, img: 'assets/img/product3.png' },
  { id: 4, name: 'Оправа для очков Lokamed 34125 C2', price: 5650, img: 'assets/img/product4.png' },
  { id: 2, name: 'Оправа для очков Lokamed 37059 C9', price: 5650, img: 'assets/img/product2.png' },
  { id: 1, name: 'Оправа для очков Lokamed 34133 C6-2', price: 5650, img: 'assets/img/product1.png' },
];

export function clearCart() {
  CART.length = 0;
}

export function renderCart() {
  const cartItems = document.getElementById('cartItems');
  const cartCount = document.getElementById('cartCount');
  const cartTotal = document.getElementById('cartTotal');
  if (!CART.length) {
    cartItems.innerHTML = '<p class="drawer-empty">Корзина пуста</p>';
  } else {
    cartItems.innerHTML = CART.map(item => `
      <div class="cart-row" data-id="${item.id}">
        <img src="${item.img}" alt="${item.name}">
        <div class="cart-row-info">
          <div class="cart-row-name">${item.name}</div>
          <div class="cart-row-qty">
            <button data-action="dec" aria-label="Уменьшить"><svg class="icon"><use href="#i-minus"/></svg></button>
            <span>${item.qty}</span>
            <button data-action="inc" aria-label="Увеличить"><svg class="icon"><use href="#i-plus"/></svg></button>
          </div>
          <div class="cart-row-prices">
            <span class="cart-row-unit">${item.price.toLocaleString('ru-RU')} ₽/шт</span>
            <span class="cart-row-sum">${(item.price * item.qty).toLocaleString('ru-RU')} ₽</span>
          </div>
        </div>
        <button class="cart-row-remove" data-action="remove" aria-label="Удалить"><svg class="icon" style="width:14px;height:14px"><use href="#i-close"/></svg><span>Удалить</span></button>
      </div>
    `).join('');
  }
  const total = CART.reduce((sum, item) => sum + item.price * item.qty, 0);
  cartTotal.textContent = total.toLocaleString('ru-RU') + ' ₽';
  cartCount.textContent = CART.reduce((sum, item) => sum + item.qty, 0);
}

export function renderFav() {
  const favItems = document.getElementById('favItems');
  const favCount = document.getElementById('favCount');
  if (!FAVORITES.length) {
    favItems.innerHTML = '<p class="drawer-empty">Список избранного пуст</p>';
  } else {
    favItems.innerHTML = FAVORITES.map(item => `
      <div class="fav-row" data-id="${item.id}">
        <img src="${item.img}" alt="${item.name}">
        <div class="fav-row-info">
          <div class="fav-row-name">${item.name}</div>
          <div class="fav-row-price">${item.price.toLocaleString('ru-RU')} ₽</div>
        </div>
        <button class="fav-row-add" data-action="add-to-cart" title="В корзину" aria-label="В корзину"><svg class="icon"><use href="#i-cart"/></svg></button>
        <button class="fav-row-add" data-action="buy-now" title="Купить в один клик" aria-label="Купить в один клик"><svg class="icon"><use href="#i-bolt"/></svg></button>
        <button class="fav-row-remove" data-action="remove" aria-label="Удалить"><svg class="icon" style="width:14px;height:14px"><use href="#i-close"/></svg></button>
      </div>
    `).join('');
  }
  favCount.textContent = FAVORITES.length;
}

document.getElementById('cartItems').addEventListener('click', (e) => {
  const btn = e.target.closest('button[data-action]');
  if (!btn) return;
  const id = Number(btn.closest('.cart-row').dataset.id);
  const item = CART.find(p => p.id === id);
  if (btn.dataset.action === 'inc') item.qty++;
  if (btn.dataset.action === 'dec') item.qty = Math.max(1, item.qty - 1);
  if (btn.dataset.action === 'remove') CART = CART.filter(p => p.id !== id);
  renderCart();
});

document.getElementById('favItems').addEventListener('click', (e) => {
  const btn = e.target.closest('button[data-action]');
  if (!btn) return;
  const id = Number(btn.closest('.fav-row').dataset.id);
  const item = FAVORITES.find(p => p.id === id);
  if (btn.dataset.action === 'add-to-cart') {
    const existing = CART.find(p => p.id === id);
    if (existing) existing.qty++;
    else CART.push({ ...item, qty: 1 });
    renderCart();
    openModal(document.getElementById('addToCartModal'));
  }
  if (btn.dataset.action === 'buy-now') {
    document.getElementById('buyNowProductName').textContent = item.name;
    openModal(document.getElementById('buyNowModal'));
  }
  if (btn.dataset.action === 'remove') FAVORITES = FAVORITES.filter(p => p.id !== id);
  renderFav();
});

document.getElementById('cartOpen').addEventListener('click', (e) => { e.preventDefault(); openModal(document.getElementById('cartDrawer')); });
document.getElementById('goToCartBtn').addEventListener('click', () => {
  closeModal(document.getElementById('addToCartModal'));
  openModal(document.getElementById('cartDrawer'));
});
document.getElementById('favOpen').addEventListener('click', (e) => { e.preventDefault(); openModal(document.getElementById('favDrawer')); });

document.getElementById('cartBuyNowBtn').addEventListener('click', () => {
  if (!CART.length) return;
  const buyNowNameEl = document.getElementById('buyNowProductName');
  if (CART.length === 1) {
    buyNowNameEl.textContent = CART[0].name;
  } else {
    const total = CART.reduce((sum, item) => sum + item.price * item.qty, 0);
    buyNowNameEl.innerHTML = CART.map(item => `${item.name} × ${item.qty}`).join('<br>') + `<br><strong>Итого: ${total.toLocaleString('ru-RU')} ₽</strong>`;
  }
  openModal(document.getElementById('buyNowModal'));
});
document.getElementById('cartPromoBtn').addEventListener('click', () => {
  const input = document.getElementById('cartPromoInput');
  if (input.value.trim()) input.placeholder = 'Промокод применён';
  input.value = '';
});

renderCart();
renderFav();

function applyPhoneMask(e) {
  const input = e.target;
  let digits = input.value.replace(/\D/g, '');
  if (digits.startsWith('7') || digits.startsWith('8')) digits = digits.slice(1);
  digits = digits.slice(0, 10);
  let formatted = '+7';
  if (digits.length > 0) formatted += ' (' + digits.slice(0, 3);
  if (digits.length >= 3) formatted += ') ' + digits.slice(3, 6);
  if (digits.length >= 6) formatted += '-' + digits.slice(6, 8);
  if (digits.length >= 8) formatted += '-' + digits.slice(8, 10);
  input.value = formatted;
}
function wirePhoneMasks(scope) {
  scope.querySelectorAll('[data-phone-mask]').forEach(input => input.addEventListener('input', applyPhoneMask));
}
wirePhoneMasks(document);

document.getElementById('feedbackOpen').addEventListener('click', (e) => { e.preventDefault(); openModal(document.getElementById('feedbackModal')); });
document.getElementById('callbackBtn').addEventListener('click', () => openModal(document.getElementById('callbackModal')));

/* ---------- Auth demo ---------- */
const loginBtn = document.getElementById('loginBtn');
const accountLink = document.getElementById('accountLink');
const loginModal = document.getElementById('loginModal');
const loginForm = document.getElementById('loginForm');

function demoAuthenticate() {
  closeModal(loginModal);
  loginBtn.style.display = 'none';
  accountLink.style.display = '';
}
loginBtn.addEventListener('click', () => openModal(loginModal));
loginForm.addEventListener('submit', (e) => { e.preventDefault(); demoAuthenticate(); });
loginModal.querySelectorAll('[data-social-login]').forEach(btn => btn.addEventListener('click', demoAuthenticate));
accountLink.addEventListener('click', (e) => {
  e.preventDefault();
  accountLink.style.display = 'none';
  loginBtn.style.display = '';
});

/* ---------- Search demo dropdown ---------- */
const SEARCH_DEMO = [
  { name: 'Оправа для очков Lokamed 34133 C6-2', price: '5 650 ₽', img: 'assets/img/product1.png' },
  { name: 'Оправа для очков Lokamed 37059 C9', price: '5 650 ₽', img: 'assets/img/product2.png' },
  { name: 'Оправа для очков Lokamed 34132 C6-1', price: '5 650 ₽', img: 'assets/img/product3.png' },
  { name: 'Оправа для очков Lokamed 34125 C2', price: '5 650 ₽', img: 'assets/img/product4.png' },
];
function wireSearchDropdown(wrapEl, inputEl, dropdownEl) {
  dropdownEl.innerHTML = '<div class="search-dropdown-title">Популярные товары</div>' + SEARCH_DEMO.map(p => `
    <a href="product.php" class="search-item">
      <img src="${p.img}" alt="${p.name}">
      <div><div class="search-item-name">${p.name}</div><div class="search-item-price">${p.price}</div></div>
    </a>
  `).join('');
  inputEl.addEventListener('focus', () => dropdownEl.classList.add('is-open'));
  dropdownEl.querySelectorAll('.search-item').forEach(a => a.addEventListener('click', () => dropdownEl.classList.remove('is-open')));
  document.addEventListener('click', (e) => { if (!wrapEl.contains(e.target)) dropdownEl.classList.remove('is-open'); });
  document.addEventListener('keydown', (e) => { if (e.key === 'Escape') dropdownEl.classList.remove('is-open'); });
}
wireSearchDropdown(document.getElementById('searchWrap'), document.getElementById('searchInput'), document.getElementById('searchDropdown'));
wireSearchDropdown(document.getElementById('mobileSearchBar'), document.getElementById('mobileSearchInput'), document.getElementById('mobileSearchDropdown'));

/* ---------- To top ---------- */
const toTop = document.getElementById('toTop');
window.addEventListener('scroll', () => {
  toTop.classList.toggle('is-visible', window.scrollY > 400);
});

/* ---------- Cookie banner ---------- */
const cookieBanner = document.getElementById('cookieBanner');
if (cookieBanner) {
  if (localStorage.getItem('cookieAccepted') === '1') {
    cookieBanner.classList.add('is-hidden');
  }
  document.getElementById('cookieAcceptBtn').addEventListener('click', () => {
    localStorage.setItem('cookieAccepted', '1');
    cookieBanner.classList.add('is-hidden');
  });
}

/* ---------- Scroll reveal ---------- */
const revealEls = document.querySelectorAll('[data-reveal]');
if ('IntersectionObserver' in window) {
  const io = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add('is-visible');
        io.unobserve(entry.target);
      }
    });
  }, { threshold: 0.15 });
  revealEls.forEach(el => io.observe(el));
} else {
  revealEls.forEach(el => el.classList.add('is-visible'));
}

/* ---------- Lazy slider activation (only after intersect) ---------- */
export function whenVisible(el, callback) {
  if (!el) return;
  if ('IntersectionObserver' in window) {
    const io = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          callback();
          io.unobserve(entry.target);
        }
      });
    }, { threshold: 0.15 });
    io.observe(el);
  } else {
    callback();
  }
}
export function starsRow(n) {
  return Array.from({ length: 5 }).map((_, i) => i < n
    ? `<svg class="icon icon-fill" style="color:var(--green)"><use href="#i-star"/></svg>`
    : `<svg class="icon" style="color:var(--border)"><use href="#i-star"/></svg>`
  ).join('');
}

/* ---------- Generic slider helper (used by products + reviews) ---------- */
export function makeSlider(track, dotsWrap, prevBtn, nextBtn, gap) {
  let dots = [];
  let pageCount = 1;
  let itemCount = 1;
  function step() {
    return (track.firstElementChild ? track.firstElementChild.offsetWidth : track.clientWidth) + gap;
  }
  function perPage() {
    return Math.max(1, Math.round(track.clientWidth / step()));
  }
  function maxScroll() {
    return track.scrollWidth - track.clientWidth;
  }
  function scrollToPage(page) {
    const target = Math.min(page * perPage() * step(), maxScroll());
    track.scrollTo({ left: Math.max(0, target), behavior: 'smooth' });
  }
  function renderDots() {
    pageCount = Math.max(1, Math.ceil(itemCount / perPage()));
    const ms = maxScroll();
    let activePage = 0;
    if (ms > 0) {
      if (track.scrollLeft >= ms - 2) activePage = pageCount - 1;
      else activePage = Math.min(pageCount - 1, Math.round(track.scrollLeft / (perPage() * step())));
    }
    dotsWrap.innerHTML = Array.from({ length: pageCount }).map((_, i) =>
      `<button class="review-dot${i === activePage ? ' is-active' : ''}" data-i="${i}" aria-label="Страница ${i + 1}"></button>`
    ).join('');
    dots = dotsWrap.querySelectorAll('.review-dot');
    dots.forEach(d => d.addEventListener('click', () => scrollToPage(Number(d.dataset.i))));
  }
  function buildDots(count) {
    itemCount = count;
    requestAnimationFrame(renderDots);
  }
  prevBtn.addEventListener('click', () => track.scrollBy({ left: -step() * perPage(), behavior: 'smooth' }));
  nextBtn.addEventListener('click', () => track.scrollBy({ left: step() * perPage(), behavior: 'smooth' }));
  let t;
  track.addEventListener('scroll', () => {
    clearTimeout(t);
    t = setTimeout(() => {
      const ms = maxScroll();
      let page;
      if (track.scrollLeft >= ms - 2) page = pageCount - 1;
      else if (track.scrollLeft <= 1) page = 0;
      else page = Math.min(pageCount - 1, Math.round(track.scrollLeft / (perPage() * step())));
      dots.forEach((d, i) => d.classList.toggle('is-active', i === page));
    }, 100);
  });
  let resizeT;
  window.addEventListener('resize', () => {
    clearTimeout(resizeT);
    resizeT = setTimeout(renderDots, 150);
  });
  return { buildDots };
}

export function makeDraggable(el) {
  let isDown = false, startX = 0, startScroll = 0, moved = false;
  el.addEventListener('mousedown', (e) => {
    e.preventDefault();
    isDown = true;
    moved = false;
    el.classList.add('is-dragging');
    el.style.scrollBehavior = 'auto';
    startX = e.pageX;
    startScroll = el.scrollLeft;
  });
  window.addEventListener('mouseup', () => {
    if (!isDown) return;
    isDown = false;
    el.classList.remove('is-dragging');
    /* keep scroll-behavior:auto a beat longer so the browser's own
       scroll-snap realignment (mandatory) lands instantly instead of
       animating/gliding into place, then restore smooth for buttons/dots */
    setTimeout(() => { el.style.scrollBehavior = ''; }, 80);
  });
  window.addEventListener('mousemove', (e) => {
    if (!isDown) return;
    const walk = e.pageX - startX;
    if (Math.abs(walk) > 5) moved = true;
    el.scrollLeft = startScroll - walk;
  });
  el.addEventListener('click', (e) => {
    if (moved) { e.preventDefault(); e.stopPropagation(); moved = false; }
  }, true);
}

/* ---------- Spoiler / accordion toggle (rules.php, uslovia-pokupki.php) ---------- */
document.querySelectorAll('.spoiler-head').forEach(head => {
  head.addEventListener('click', () => {
    head.closest('.spoiler').classList.toggle('is-open');
  });
});
