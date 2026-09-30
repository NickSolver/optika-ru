import { openModal, starsRow, CART, renderCart, makeSlider, makeDraggable, whenVisible } from '../shared.js';

export function initHomepage() {
  /* ---------- Hero slider ---------- */
  const heroTrack = document.getElementById('heroTrack');
  const heroSlides = heroTrack.children;
  const heroDots = document.getElementById('heroDots');
  let heroIndex = 0;

  function buildHeroDots() {
    heroDots.innerHTML = Array.from(heroSlides).map((_, i) =>
      `<button class="review-dot${i === 0 ? ' is-active' : ''}" data-i="${i}" aria-label="Слайд ${i + 1}"></button>`
    ).join('');
    heroDots.querySelectorAll('.review-dot').forEach(d => d.addEventListener('click', () => { goToHero(Number(d.dataset.i)); restartHeroAutoplay(); }));
  }
  function goToHero(i) {
    heroIndex = (i + heroSlides.length) % heroSlides.length;
    heroTrack.style.transform = `translateX(-${heroIndex * 100}%)`;
    heroDots.querySelectorAll('.review-dot').forEach((d, idx) => d.classList.toggle('is-active', idx === heroIndex));
  }
  let heroTimer;
  function restartHeroAutoplay() {
    clearInterval(heroTimer);
    heroTimer = setInterval(() => goToHero(heroIndex + 1), 6000);
  }
  document.getElementById('heroPrev').addEventListener('click', () => { goToHero(heroIndex - 1); restartHeroAutoplay(); });
  document.getElementById('heroNext').addEventListener('click', () => { goToHero(heroIndex + 1); restartHeroAutoplay(); });
  buildHeroDots();

  /* ---------- Hero slider: mouse + touch drag ---------- */
  const heroSlider = document.querySelector('.hero-slider');
  let heroDown = false, heroStartX = 0, heroStartY = 0, heroBaseIndex = 0, heroDragDelta = 0, heroMoved = false, heroAxisLocked = null;

  function heroDragStart(x, y) {
    heroDown = true;
    heroMoved = false;
    heroAxisLocked = null;
    heroDragDelta = 0;
    heroBaseIndex = heroIndex;
    heroStartX = x;
    heroStartY = y;
    heroTrack.style.transition = 'none';
    heroSlider.classList.add('is-dragging');
    clearInterval(heroTimer);
  }
  function heroDragMove(x, y) {
    if (!heroDown) return;
    heroDragDelta = x - heroStartX;
    if (heroAxisLocked === null && (Math.abs(heroDragDelta) > 5 || Math.abs(y - heroStartY) > 5)) {
      heroAxisLocked = Math.abs(heroDragDelta) > Math.abs(y - heroStartY) ? 'x' : 'y';
    }
    if (heroAxisLocked !== 'x') return;
    heroMoved = true;
    const pct = (heroDragDelta / heroTrack.getBoundingClientRect().width) * 100;
    heroTrack.style.transform = `translateX(${-heroBaseIndex * 100 + pct}%)`;
  }
  function heroDragEnd() {
    if (!heroDown) return;
    heroDown = false;
    heroSlider.classList.remove('is-dragging');
    heroTrack.style.transition = '';
    if (heroAxisLocked === 'x') {
      const threshold = heroTrack.getBoundingClientRect().width * 0.15;
      if (heroDragDelta <= -threshold) goToHero(heroBaseIndex + 1);
      else if (heroDragDelta >= threshold) goToHero(heroBaseIndex - 1);
      else goToHero(heroBaseIndex);
    }
    restartHeroAutoplay();
  }

  heroSlider.addEventListener('mousedown', (e) => {
    if (e.target.closest('.hero-arrow')) return;
    e.preventDefault();
    heroDragStart(e.pageX, e.pageY);
  });
  window.addEventListener('mousemove', (e) => heroDragMove(e.pageX, e.pageY));
  window.addEventListener('mouseup', heroDragEnd);

  heroSlider.addEventListener('touchstart', (e) => {
    if (e.target.closest('.hero-arrow')) return;
    const t = e.touches[0];
    heroDragStart(t.clientX, t.clientY);
  }, { passive: true });
  heroSlider.addEventListener('touchmove', (e) => {
    if (!heroDown) return;
    const t = e.touches[0];
    heroDragMove(t.clientX, t.clientY);
    if (heroAxisLocked === 'x' && e.cancelable) e.preventDefault();
  }, { passive: false });
  heroSlider.addEventListener('touchend', heroDragEnd);
  heroSlider.addEventListener('touchcancel', heroDragEnd);

  heroSlider.addEventListener('click', (e) => {
    if (heroMoved) { e.preventDefault(); e.stopPropagation(); heroMoved = false; }
  }, true);

  whenVisible(document.querySelector('.hero'), restartHeroAutoplay);

  /* ---------- Products ---------- */
  const PRODUCTS = {
    hits: [
      { name: 'Оправа для очков Lokamed 34133 C6-2', price: 5650, old: null, img: 'assets/img/product1.png', badge: 'ХИТ', rating: 5, reviews: 18 },
      { name: 'Оправа для очков Lokamed 37059 C9', price: 5650, old: null, img: 'assets/img/product2.png', badge: 'ХИТ', rating: 4, reviews: 11 },
      { name: 'Оправа для очков Lokamed 34132 C6-1', price: 5650, old: null, img: 'assets/img/product3.png', badge: 'ХИТ', rating: 5, reviews: 23 },
      { name: 'Оправа для очков Lokamed 34125 C2', price: 5650, old: null, img: 'assets/img/product4.png', badge: 'ХИТ', rating: 5, reviews: 9 },
    ],
    new: [
      { name: 'Оправа для очков Lokamed 34125 C2', price: 5650, old: null, img: 'assets/img/product4.png', badge: 'NEW', rating: 0, reviews: 0 },
      { name: 'Оправа для очков Lokamed 34133 C6-2', price: 5650, old: null, img: 'assets/img/product1.png', badge: 'NEW', rating: 0, reviews: 0 },
      { name: 'Оправа для очков Lokamed 34132 C6-1', price: 5650, old: null, img: 'assets/img/product3.png', badge: 'NEW', rating: 0, reviews: 0 },
      { name: 'Оправа для очков Lokamed 37059 C9', price: 5650, old: null, img: 'assets/img/product2.png', badge: 'NEW', rating: 0, reviews: 0 },
    ],
    sale: [
      { name: 'Оправа для очков Lokamed 37059 C9', price: 5650, old: 6650, img: 'assets/img/product2.png', badge: '-15%', rating: 4, reviews: 11 },
      { name: 'Оправа для очков Lokamed 34132 C6-1', price: 5650, old: 6650, img: 'assets/img/product3.png', badge: '-15%', rating: 5, reviews: 23 },
      { name: 'Оправа для очков Lokamed 34125 C2', price: 5650, old: 6650, img: 'assets/img/product4.png', badge: '-15%', rating: 5, reviews: 9 },
      { name: 'Оправа для очков Lokamed 34133 C6-2', price: 5650, old: 6650, img: 'assets/img/product1.png', badge: '-15%', rating: 5, reviews: 18 },
    ],
  };

  const productTrack = document.getElementById('productTrack');
  const productSlider = makeSlider(productTrack, document.getElementById('productDots'), document.getElementById('prodPrev'), document.getElementById('prodNext'), 18);

  function renderProducts(key) {
    const items = [...PRODUCTS[key], ...PRODUCTS[key]];
    productTrack.innerHTML = items.map(p => `
      <div class="product-card">
        <span class="product-badge">${p.badge}</span>
        <button class="product-wish" aria-label="В избранное"><svg class="icon" style="width:16px;height:16px"><use href="#i-heart"/></svg></button>
        <a href="product.php"><div class="product-media"><img src="${p.img}" alt="${p.name}"></div></a>
        <div class="product-avail"><span class="dot"></span>В наличии</div>
        <a href="product.php" class="product-name" style="display:block">${p.name}</a>
        <div class="product-stars">${starsRow(p.rating)}<span style="font-size:.76rem;color:var(--ink-faint);margin-left:4px">${p.reviews ? '(' + p.reviews + ')' : 'нет отзывов'}</span></div>
        <div class="product-price-row">
          <span class="product-price">${p.price.toLocaleString('ru-RU')} ₽</span>
          ${p.old ? `<span class="product-price-old">${p.old.toLocaleString('ru-RU')} ₽</span>` : ''}
        </div>
        <div class="product-actions">
          <button class="btn btn-primary product-icon-btn" data-add-to-cart data-name="${p.name}" data-price="${p.price}" data-img="${p.img}" title="В корзину" aria-label="В корзину">
            <svg class="icon"><use href="#i-cart"/></svg>
          </button>
          <button class="btn btn-outline product-icon-btn" data-buy-now data-name="${p.name}" data-price="${p.price}" data-img="${p.img}" title="Купить в один клик" aria-label="Купить в один клик">
            <svg class="icon"><use href="#i-bolt"/></svg>
          </button>
        </div>
      </div>
    `).join('');
    productTrack.scrollTo({ left: 0 });
    productSlider.buildDots(items.length);
  }
  productTrack.addEventListener('click', (e) => {
    const cartBtn = e.target.closest('[data-add-to-cart]');
    if (cartBtn) {
      const id = Number(cartBtn.dataset.img.match(/(\d+)/)[1]);
      const existing = CART.find(p => p.id === id);
      if (existing) existing.qty++;
      else CART.push({ id, name: cartBtn.dataset.name, price: Number(cartBtn.dataset.price), img: cartBtn.dataset.img, qty: 1 });
      renderCart();
      openModal(document.getElementById('addToCartModal'));
      return;
    }
    const buyBtn = e.target.closest('[data-buy-now]');
    if (buyBtn) {
      document.getElementById('buyNowProductName').textContent = buyBtn.dataset.name;
      openModal(document.getElementById('buyNowModal'));
    }
  });
  whenVisible(document.getElementById('products'), () => renderProducts('hits'));

  document.querySelectorAll('.tab-btn').forEach(btn => {
    btn.addEventListener('click', () => {
      document.querySelectorAll('.tab-btn').forEach(b => b.setAttribute('aria-selected', 'false'));
      btn.setAttribute('aria-selected', 'true');
      renderProducts(btn.dataset.tab);
    });
  });

  /* ---------- Reviews ---------- */
  const REVIEWS = [
    { name: 'Марина Соколова', meta: 'Салон в Зеленограде', rating: 5, text: 'Очень довольна выбором оправ и вниманием мастеров. Подобрали линзы за один визит, всё объяснили простыми словами, показали несколько вариантов оправ под форму лица и бюджет, а после установки линз ещё раз бесплатно проверили посадку — очень внимательное отношение, обязательно приду снова.', bg: 'var(--green-tint)', fg: 'var(--green-dark)' },
    { name: 'Дмитрий Волков', meta: 'Салон в Одинцово', rating: 5, text: 'Быстро, вежливо, без навязывания лишнего. Заказ пришёл на следующий день после примерки.', bg: 'var(--blue-tint)', fg: 'var(--blue)' },
    { name: 'Елена Кравцова', meta: 'Салон в Солнечногорске', rating: 4, text: 'Хороший ассортимент солнцезащитных очков и приятные цены на акции.', bg: 'var(--green-tint)', fg: 'var(--green-dark)' },
    { name: 'Артём Белов', meta: 'Салон в Зеленограде', rating: 5, text: 'Проверили зрение бесплатно и сразу подобрали контактные линзы под мой график ношения — раньше носил очки и постоянно забывал их дома, а тут за один визит подобрали именно то, что нужно, объяснили как ухаживать за линзами и записали на бесплатную повторную консультацию через месяц.', bg: 'var(--blue-tint)', fg: 'var(--blue)' },
    { name: 'Ольга Тимофеева', meta: 'Онлайн-заказ', rating: 5, text: 'Ношу очки Lokamed уже третий год подряд, качество стабильно радует.', bg: 'var(--green-tint)', fg: 'var(--green-dark)' },
    { name: 'Игорь Прохоров', meta: 'Салон в Одинцово', rating: 4, text: 'Удобно, что есть доставка и примерка на дому, сэкономил время.', bg: 'var(--blue-tint)', fg: 'var(--blue)' },
  ];

  function initials(name) { return name.split(' ').map(w => w[0]).join('').slice(0, 2); }

  const track = document.getElementById('reviewTrack');
  const reviewSlider = makeSlider(track, document.getElementById('reviewDots'), document.getElementById('revPrev'), document.getElementById('revNext'), 16);
  const REVIEW_LIMIT = 110;
  whenVisible(document.getElementById('reviews'), () => {
    track.innerHTML = REVIEWS.map((r, i) => {
      const isLong = r.text.length > REVIEW_LIMIT;
      const shown = isLong ? r.text.slice(0, REVIEW_LIMIT).trim() : r.text;
      return `
      <div class="review-card" data-review-index="${i}">
        <div class="review-top">
          <div class="review-avatar" style="background:${r.bg};color:${r.fg}">${initials(r.name)}</div>
          <div>
            <div class="review-name">${r.name}</div>
            <div class="review-meta">${r.meta}</div>
          </div>
        </div>
        <div class="review-stars">${starsRow(r.rating)}</div>
        <p class="review-text">${shown}${isLong ? `<span class="review-more">...</span>` : ''}</p>
      </div>
    `;
    }).join('');
    reviewSlider.buildDots(REVIEWS.length);
  });

  track.addEventListener('click', (e) => {
    const card = e.target.closest('.review-card');
    if (!card) return;
    const r = REVIEWS[Number(card.dataset.reviewIndex)];
    const top = document.getElementById('reviewModalTop');
    top.innerHTML = `
      <div class="review-avatar" style="background:${r.bg};color:${r.fg}">${initials(r.name)}</div>
      <div>
        <div class="review-name">${r.name}</div>
        <div class="review-meta">${r.meta}</div>
      </div>
    `;
    document.getElementById('reviewModalStars').innerHTML = starsRow(r.rating);
    document.getElementById('reviewModalText').textContent = r.text;
    openModal(document.getElementById('reviewModal'));
  });

  /* ---------- Blog slider ---------- */
  const HOME_BLOG_POSTS = [
    { img: 'assets/img/blog1.png', tag: 'Покупателям', title: 'Как подобрать очки: что действительно важно учитывать' },
    { img: 'assets/img/blog2.png', tag: 'Линзы', title: 'От 1.50 до 1.74: как толщина линзы меняет очки' },
    { img: 'assets/img/blog3.png', tag: 'Линзы', title: 'Какие бывают покрытия на очковых линзах' },
    { img: 'assets/img/blog4.png', tag: 'Покупателям', title: 'Почему важно покупать очки у профессионалов' },
    { img: 'assets/img/blog5.png', tag: 'Здоровье глаз', title: 'Синдром сухого глаза: почему сохнут глаза' },
    { img: 'assets/img/blog6.png', tag: 'Здоровье глаз', title: 'Астигматизм: почему изображение размыто и как это исправить' },
  ];
  const blogTrack = document.getElementById('blogTrack');
  const blogSlider = makeSlider(blogTrack, document.getElementById('blogDots'), document.getElementById('blogPrev'), document.getElementById('blogNext'), 16);
  whenVisible(document.getElementById('blog'), () => {
    blogTrack.innerHTML = HOME_BLOG_POSTS.map(p => `
      <a href="blog-detail.php" class="blog-card">
        <div class="blog-media"><img src="${p.img}" alt=""></div>
        <span class="blog-tag">${p.tag}</span><h3>${p.title}</h3><span class="blog-read">Читать <svg class="icon" style="width:14px;height:14px"><use href="#i-arrow-right"/></svg></span>
      </a>
    `).join('');
    blogSlider.buildDots(HOME_BLOG_POSTS.length);
  });

  /* ---------- Drag-to-scroll (mouse + touch native) ---------- */
  [productTrack, track, blogTrack].forEach(makeDraggable);
}
