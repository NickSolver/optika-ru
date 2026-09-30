import { openModal, starsRow, CART, FAVORITES, renderCart, renderFav, makeSlider, makeDraggable, whenVisible } from '../shared.js';

const PRODUCT_REVIEWS = [
  { name: 'Елена Кравцова', bg: 'var(--green-tint)', fg: 'var(--green-dark)', rating: 5, date: '14.06.2026', text: 'Дочка в восторге от цвета, оправа лёгкая и удобно сидит. Носит уже второй месяц — ни царапины.' },
  { name: 'Марина Соколова', bg: 'var(--blue-tint)', fg: 'var(--blue)', rating: 4, date: '02.06.2026', text: 'Хорошее качество за свою цену, но носоупоры немного великоваты для трёхлетнего ребёнка — пришлось подогнуть.' },
];

function pdpInitials(name) { return name.split(' ').map(w => w[0]).join('').slice(0, 2); }

/**
 * Renders the whole product-detail page. $color/$availability/$images are the
 * only things that differ between product.php and its 4 variant pages.
 */
export function initProduct({ color: PDP_COLOR, availability: AVAILABILITY, images }) {
  const PRODUCT = {
    name: 'Солнцезащитные детские очки Barbie SB-166',
    images,
    colors: [
      { key: 'orange', name: 'Оранжевый', hex: '#FF7A1A', page: 'product.php' },
      { key: 'pink', name: 'Розовый', hex: '#FF5C97', page: 'product-pink.php' },
      { key: 'purple', name: 'Фиолетовый', hex: '#9B5CF6', page: 'product-purple.php' },
    ],
    price: 1200,
    rating: 4,
  };

  /* ---------- Gallery ---------- */
  const pdpMainImg = document.getElementById('pdpMainImg');
  const pdpMainPhotoLink = document.getElementById('pdpMainPhotoLink');
  const pdpThumbs = document.getElementById('pdpThumbs');
  let pdpCurrentImageIndex = 0;
  pdpMainImg.src = PRODUCT.images[0];
  pdpMainPhotoLink.href = PRODUCT.images[0];
  if (PRODUCT.images.length > 1) {
    pdpThumbs.innerHTML = PRODUCT.images.map((src, i) => `
      <button class="pdp-thumb${i === 0 ? ' is-active' : ''}" data-i="${i}" aria-label="Фото ${i + 1}"><img src="${src}" alt=""></button>
    `).join('');
  } else {
    pdpThumbs.remove();
  }
  pdpThumbs.querySelectorAll('.pdp-thumb').forEach(btn => btn.addEventListener('click', () => {
    pdpThumbs.querySelectorAll('.pdp-thumb').forEach(b => b.classList.remove('is-active'));
    btn.classList.add('is-active');
    pdpCurrentImageIndex = Number(btn.dataset.i);
    const src = PRODUCT.images[pdpCurrentImageIndex];
    pdpMainImg.src = src;
    pdpMainPhotoLink.href = src;
  }));
  pdpMainPhotoLink.addEventListener('click', (e) => {
    if (!window.Fancybox) return;
    e.preventDefault();
    Fancybox.show(PRODUCT.images.map(src => ({ src, type: 'image' })), { startIndex: pdpCurrentImageIndex });
  });

  /* ---------- Color swatches (each links to its own variant page) ---------- */
  const pdpSwatches = document.getElementById('pdpSwatches');
  pdpSwatches.innerHTML = PRODUCT.colors.map(c => `
    <a href="${c.page}" class="pdp-swatch${c.key === PDP_COLOR ? ' is-active' : ''}" style="background:${c.hex}" aria-label="${c.name}" title="${c.name}"></a>
  `).join('');

  /* ---------- Rating stars ---------- */
  document.getElementById('pdpStars').innerHTML = starsRow(PRODUCT.rating);

  /* ---------- Availability (3 states) ---------- */
  function renderAvailability() {
    const el = document.getElementById('pdpAvail');
    const buyRow = document.getElementById('pdpBuyRow');
    const buyNow = document.getElementById('pdpBuyNow');
    const checkRow = document.getElementById('pdpCheckRow');
    if (AVAILABILITY === 'in_stock') {
      el.className = 'pdp-avail is-in-stock';
      el.innerHTML = '<span class="dot"></span>В наличии';
      buyRow.style.display = '';
      buyNow.style.display = '';
      checkRow.style.display = 'none';
    } else if (AVAILABILITY === 'out_of_stock') {
      el.className = 'pdp-avail is-out';
      el.innerHTML = '<span class="dot"></span>Нет в наличии';
      buyRow.style.display = 'none';
      buyNow.style.display = 'none';
      checkRow.style.display = 'none';
    } else {
      el.className = 'pdp-avail is-check';
      el.innerHTML = '<span class="dot"></span>Уточните наличие';
      buyRow.style.display = 'none';
      buyNow.style.display = 'none';
      checkRow.style.display = '';
    }
  }
  renderAvailability();
  document.getElementById('pdpCheckAvailBtn').addEventListener('click', () => {
    openModal(document.getElementById('checkAvailModal'));
  });

  /* ---------- Quantity stepper ---------- */
  let pdpQty = 1;
  const pdpQtyEl = document.getElementById('pdpQty');
  document.querySelector('[data-qty="inc"]').addEventListener('click', () => { pdpQty++; pdpQtyEl.textContent = pdpQty; });
  document.querySelector('[data-qty="dec"]').addEventListener('click', () => { pdpQty = Math.max(1, pdpQty - 1); pdpQtyEl.textContent = pdpQty; });

  /* ---------- Add to cart / buy now / favorite ---------- */
  document.getElementById('pdpAddCart').addEventListener('click', () => {
    const existing = CART.find(p => p.name === PRODUCT.name);
    if (existing) existing.qty += pdpQty;
    else CART.push({ id: Date.now(), name: PRODUCT.name, price: PRODUCT.price, img: pdpMainImg.src, qty: pdpQty });
    renderCart();
    openModal(document.getElementById('addToCartModal'));
  });
  document.getElementById('pdpBuyNow').addEventListener('click', () => {
    document.getElementById('buyNowProductName').textContent = PRODUCT.name;
    openModal(document.getElementById('buyNowModal'));
  });
  function wireFavBtn(btn) {
    btn.addEventListener('click', () => {
      const isFav = btn.classList.toggle('is-active');
      document.querySelectorAll('.pdp-fav-btn').forEach(b => b.classList.toggle('is-active', isFav));
      if (isFav) {
        if (!FAVORITES.find(p => p.name === PRODUCT.name)) FAVORITES.push({ id: Date.now(), name: PRODUCT.name, price: PRODUCT.price, img: pdpMainImg.src });
      } else {
        FAVORITES.splice(0, FAVORITES.length, ...FAVORITES.filter(p => p.name !== PRODUCT.name));
      }
      renderFav();
    });
  }
  wireFavBtn(document.getElementById('pdpFavBtn'));
  wireFavBtn(document.getElementById('pdpCheckFavBtn'));

  /* ---------- Tabs (Характеристики / Оплата / Доставка / Гарантии / Услуги) ---------- */
  document.querySelectorAll('#pdpTabs .tab-btn').forEach(btn => {
    btn.addEventListener('click', () => {
      document.querySelectorAll('#pdpTabs .tab-btn').forEach(b => b.setAttribute('aria-selected', 'false'));
      btn.setAttribute('aria-selected', 'true');
      document.querySelectorAll('.pdp-tab-panel').forEach(p => p.classList.toggle('is-active', p.dataset.panel === btn.dataset.tab));
    });
  });

  /* ---------- Reviews ---------- */
  if (AVAILABILITY === 'out_of_stock') {
    document.getElementById('pdpReviewList').innerHTML = `
      <p class="drawer-empty" style="padding:20px 0">Отзывов пока нет. Станьте первым, кто оставит отзыв об этом товаре!</p>`;
    document.getElementById('pdpReviewsSummary').textContent = 'Пока нет оценок';
  } else {
    document.getElementById('pdpReviewList').innerHTML = PRODUCT_REVIEWS.map(r => `
      <div class="pdp-review-card">
        <div class="pdp-review-top">
          <div class="review-avatar" style="background:${r.bg};color:${r.fg}">${pdpInitials(r.name)}</div>
          <div>
            <div class="review-name">${r.name}</div>
            <div class="review-stars">${starsRow(r.rating)}</div>
          </div>
          <span class="pdp-review-date">${r.date}</span>
        </div>
        <p class="review-text">${r.text}</p>
      </div>
    `).join('');
  }
  document.getElementById('pdpWriteReview').addEventListener('click', () => openModal(document.getElementById('writeReviewModal')));

  /* ---------- Review modal: star picker ---------- */
  let reviewStarValue = 5;
  const starPicker = document.getElementById('reviewStarPicker');
  function updateStarPicker() {
    starPicker.querySelectorAll('button').forEach(b => b.classList.toggle('is-filled', Number(b.dataset.star) <= reviewStarValue));
  }
  starPicker.querySelectorAll('button').forEach(b => b.addEventListener('click', () => { reviewStarValue = Number(b.dataset.star); updateStarPicker(); }));
  updateStarPicker();

  /* ---------- Related item sliders (Футляры / Салфетки / Шнурки / Похожие) ---------- */
  function pdpMiniCardHTML(p) {
    return `
      <div class="product-card">
        <div class="product-media"><img src="${p.img}" alt="${p.name}"></div>
        <div class="product-name">${p.name}</div>
        <div class="product-price-row"><span class="product-price">${p.price.toLocaleString('ru-RU')} ₽</span></div>
        <div class="product-actions">
          <button class="btn btn-primary product-icon-btn" data-add-to-cart data-name="${p.name}" data-price="${p.price}" data-img="${p.img}" title="В корзину" aria-label="В корзину"><svg class="icon"><use href="#i-cart"/></svg></button>
          <button class="btn btn-outline product-icon-btn" data-buy-now data-name="${p.name}" title="Купить в один клик" aria-label="Купить в один клик"><svg class="icon"><use href="#i-bolt"/></svg></button>
        </div>
      </div>`;
  }
  function buildPdpSlider(items, prefix) {
    const track = document.getElementById(prefix + 'Track');
    const dotsWrap = document.getElementById(prefix + 'Dots');
    const prevBtn = document.getElementById(prefix + 'ArrowPrev');
    const nextBtn = document.getElementById(prefix + 'ArrowNext');
    track.innerHTML = items.map(pdpMiniCardHTML).join('');
    track.addEventListener('click', (e) => {
      const cartBtn = e.target.closest('[data-add-to-cart]');
      if (cartBtn) {
        const existing = CART.find(p => p.name === cartBtn.dataset.name);
        if (existing) existing.qty++;
        else CART.push({ id: Date.now(), name: cartBtn.dataset.name, price: Number(cartBtn.dataset.price), img: cartBtn.dataset.img, qty: 1 });
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
    const slider = makeSlider(track, dotsWrap, prevBtn, nextBtn, 18);
    slider.buildDots(items.length);
    makeDraggable(track);
  }
  function repeatItems(name, price, img, count) {
    return Array.from({ length: count }).map((_, i) => ({ name: `${name} ${i + 1}`, price, img }));
  }
  /* ---------- Promo image slider (real banners from reference site) ---------- */
  const PROMO_SLIDES = [
    { img: 'assets/img/promo/aktsii-card1.jpg', alt: 'До -70% на солнцезащитные очки' },
    { img: 'assets/img/promo/slide2.jpg', alt: 'Лето глазами детей: рисуй и выигрывай!' },
    { img: 'assets/img/promo/slide3.jpg', alt: 'Андреевы дни в Lokamed' },
    { img: 'assets/img/promo/slide4.jpg', alt: 'Спецпредложения в оптике Андреевка' },
    { img: 'assets/img/promo/slide5.jpg', alt: 'Первые очки со скидкой' },
    { img: 'assets/img/promo/slide6.jpg', alt: 'Оправа в подарок' },
    { img: 'assets/img/promo/slide7.jpg', alt: 'Оптометрист' },
    { img: 'assets/img/promo/slide8.jpg', alt: 'Изготовление очков 1 час' },
  ];
  const promoTrack = document.getElementById('promoTrack');
  const promoSlider = makeSlider(promoTrack, document.getElementById('promoDots'), document.getElementById('promoArrowPrev'), document.getElementById('promoArrowNext'), 16);
  whenVisible(document.getElementById('pdpPromoSection'), () => {
    promoTrack.innerHTML = PROMO_SLIDES.map(s => `
      <a href="promo.php" class="blog-card pdp-promo-slide"><div class="blog-media"><img src="${s.img}" alt="${s.alt}"></div></a>
    `).join('');
    promoSlider.buildDots(PROMO_SLIDES.length);
  });
  makeDraggable(promoTrack);

  buildPdpSlider(repeatItems('Футляр для очков', 650, 'assets/img/catalog/access.jpg', 8), 'case');
  buildPdpSlider(repeatItems('Салфетка для очков', 180, 'assets/img/product1.png', 8), 'cloth');
  buildPdpSlider(repeatItems('Шнурок для очков', 350, 'assets/img/product2.png', 8), 'strap');
  buildPdpSlider(repeatItems('Оправа для очков Lokamed', 5650, 'assets/img/product3.png', 8), 'similar');
}
