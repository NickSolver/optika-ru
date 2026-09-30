import { openModal, starsRow, CART, renderCart } from '../shared.js';

export function initCatalogSection() {
  /* ---------- Filter panel open/close ---------- */
  const filterFab = document.getElementById('filterFab');
  const filterPanel = document.getElementById('filterPanel');
  const filterScrim = document.getElementById('filterScrim');

  function openFilter() {
    filterPanel.classList.add('is-open');
    filterScrim.classList.add('is-open');
    filterFab.classList.add('is-open');
    document.body.style.overflow = 'hidden';
  }
  function closeFilter() {
    filterPanel.classList.remove('is-open');
    filterScrim.classList.remove('is-open');
    filterFab.classList.remove('is-open');
    document.body.style.overflow = '';
  }
  filterFab.addEventListener('click', () => {
    filterPanel.classList.contains('is-open') ? closeFilter() : openFilter();
  });
  document.getElementById('filterClose').addEventListener('click', closeFilter);
  filterScrim.addEventListener('click', closeFilter);
  document.addEventListener('keydown', (e) => { if (e.key === 'Escape') closeFilter(); });

  /* ---------- Facets ---------- */
  const FACETS = {
    gender: [
      { v: 'kids', l: 'Детские' },
      { v: 'women', l: 'Женские' },
      { v: 'men', l: 'Мужские' },
      { v: 'unisex', l: 'Унисекс' },
    ],
    color: ['Бежевый', 'Белый', 'Бордовый', 'Голубой', 'Желтый', 'Зелёный', 'Золотой', 'Коричневый', 'Красный', 'Оранжевый', 'Прозрачный', 'Розовый', 'Серебряный', 'Серый', 'Синий', 'Фиолетовый', 'Чёрный'].map(l => ({ v: l, l })),
    shape: ['Wayfarer', 'Авиаторы', 'Бабочки', 'Геометрия', 'Квадратные', 'Классические', 'Кошачий глаз', 'Круглые', 'Овальные', 'Прямоугольные'].map(l => ({ v: l, l })),
    material: ['Пластик', 'Металл', 'Комбинированный', 'Дерево'].map(l => ({ v: l, l })),
    brand: ['Ray Ban', 'Carrera', 'Hugo Boss', 'Lacoste', 'Nike', 'Pierre Cardin', 'Silhouette', 'Vogue', 'Tommy Hilfiger', 'Givenchy', 'Maxmara', 'Polaroid', 'Prada', 'Armani', 'Etro', 'LIU JO', 'Invu', 'Ferelli', 'Spring Time', 'Sulz'].map(l => ({ v: l, l })),
  };
  const FAQ_TAGS = ['Hugo Boss', 'Lacoste', 'Sulz', 'Женские', 'Armani', 'Ferelli', 'Invu', 'LIU JO', 'Etro', 'Spring Time'];

  /* ---------- Demo catalog data (~200 items) ---------- */
  const AVAIL_STATES = ['in_stock', 'in_stock', 'in_stock', 'in_stock', 'out_of_stock', 'check'];
  const AVAIL_PAGE = { in_stock: 'product.php', out_of_stock: 'product-out-of-stock.php', check: 'product-check-availability.php' };
  const AVAIL_LABEL = { in_stock: 'В наличии', out_of_stock: 'Нет в наличии', check: 'Уточните наличие' };

  const CATALOG_PRODUCTS = (() => {
    const imgs = ['assets/img/product1.png', 'assets/img/product2.png', 'assets/img/product3.png', 'assets/img/product4.png'];
    const skus = ['34133 C6-2', '37059 C9', '34132 C6-1', '34125 C2'];
    const items = [];
    for (let i = 0; i < 204; i++) {
      const ci = i % 4;
      const price = 1400 + (i % 9) * 1650;
      items.push({
        id: i + 1,
        name: `Оправа для очков Lokamed ${skus[ci]}`,
        price,
        old: i % 3 === 0 ? price + 900 : null,
        img: imgs[ci],
        badge: i % 5 === 0 ? 'ХИТ' : (i % 5 === 1 ? 'NEW' : ''),
        rating: 3 + (i % 3),
        reviews: (i * 3) % 20,
        availability: AVAIL_STATES[i % AVAIL_STATES.length],
        gender: FACETS.gender[i % FACETS.gender.length].v,
        color: FACETS.color[i % FACETS.color.length].v,
        shape: FACETS.shape[i % FACETS.shape.length].v,
        material: FACETS.material[i % FACETS.material.length].v,
        brand: FACETS.brand[i % FACETS.brand.length].v,
      });
    }
    return items;
  })();

  let perPage = 36;
  let catalogFiltered = CATALOG_PRODUCTS.slice();
  let catalogVisibleCount = perPage;
  let sortKey = null;
  let sortDir = { name: 'asc', price: 'asc' };

  function pluralGoods(n) {
    const mod10 = n % 10, mod100 = n % 100;
    if (mod10 === 1 && mod100 !== 11) return 'товар';
    if ([2, 3, 4].includes(mod10) && ![12, 13, 14].includes(mod100)) return 'товара';
    return 'товаров';
  }

  function catalogCardHTML(p) {
    const page = AVAIL_PAGE[p.availability];
    const availClass = p.availability === 'in_stock' ? 'is-in-stock' : (p.availability === 'out_of_stock' ? 'is-out' : 'is-check');
    const actions = p.availability === 'in_stock'
      ? `<button class="btn btn-primary product-icon-btn" data-add-to-cart data-name="${p.name}" data-price="${p.price}" data-img="${p.img}" title="В корзину" aria-label="В корзину"><svg class="icon"><use href="#i-cart"/></svg></button>
         <button class="btn btn-outline product-icon-btn" data-buy-now data-name="${p.name}" data-price="${p.price}" data-img="${p.img}" title="Купить в один клик" aria-label="Купить в один клик"><svg class="icon"><use href="#i-bolt"/></svg></button>`
      : `<a href="${page}" class="btn btn-outline btn-block" style="font-size:.82rem">Подробнее</a>`;
    return `
      <div class="product-card">
        ${p.badge ? `<span class="product-badge">${p.badge}</span>` : ''}
        <button class="product-wish" aria-label="В избранное"><svg class="icon" style="width:16px;height:16px"><use href="#i-heart"/></svg></button>
        <a href="${page}"><div class="product-media"><img src="${p.img}" alt="${p.name}"></div></a>
        <div class="product-avail ${availClass}"><span class="dot"></span>${AVAIL_LABEL[p.availability]}</div>
        <a href="${page}" class="product-name" style="display:block">${p.name}</a>
        <div class="product-stars">${starsRow(p.rating)}<span style="font-size:.76rem;color:var(--ink-faint);margin-left:4px">${p.reviews ? '(' + p.reviews + ')' : 'нет отзывов'}</span></div>
        <div class="product-price-row">
          <span class="product-price">${p.price.toLocaleString('ru-RU')} ₽</span>
          ${p.old ? `<span class="product-price-old">${p.old.toLocaleString('ru-RU')} ₽</span>` : ''}
        </div>
        <div class="product-actions">${actions}</div>
      </div>`;
  }

  const catalogGrid = document.getElementById('catalogGrid');
  const catalogCount = document.getElementById('catalogCount');
  const showMoreBtn = document.getElementById('showMoreBtn');
  const paginationEl = document.getElementById('pagination');

  function renderCatalogGrid() {
    const shown = catalogFiltered.slice(0, catalogVisibleCount);
    catalogGrid.innerHTML = shown.length
      ? shown.map(catalogCardHTML).join('')
      : '<p style="grid-column:1/-1;color:var(--ink-faint);padding:50px 0;text-align:center">Ничего не найдено под выбранные условия</p>';
    catalogCount.textContent = `Найдено ${catalogFiltered.length} ${pluralGoods(catalogFiltered.length)}`;
    showMoreBtn.style.display = catalogVisibleCount >= catalogFiltered.length ? 'none' : '';
    renderPagination();
  }

  function renderPagination() {
    const pageCount = Math.max(1, Math.ceil(catalogFiltered.length / perPage));
    const currentPage = Math.max(1, Math.ceil(catalogVisibleCount / perPage));
    paginationEl.innerHTML = pageCount <= 1 ? '' : Array.from({ length: pageCount }).map((_, i) =>
      `<button data-page="${i + 1}" class="${i + 1 === currentPage ? 'is-active' : ''}">${i + 1}</button>`
    ).join('');
    paginationEl.querySelectorAll('button').forEach(btn => btn.addEventListener('click', () => {
      catalogVisibleCount = Number(btn.dataset.page) * perPage;
      renderCatalogGrid();
      window.scrollTo({ top: document.querySelector('.catalog-head').offsetTop - 100, behavior: 'smooth' });
    }));
  }

  function applySort() {
    if (!sortKey) return;
    const dir = sortDir[sortKey] === 'asc' ? 1 : -1;
    catalogFiltered.sort((a, b) => {
      if (sortKey === 'name') return a.name.localeCompare(b.name, 'ru') * dir;
      return (a.price - b.price) * dir;
    });
  }

  function getCheckedValues(groupName) {
    return [...document.querySelectorAll(`.filter-group[data-group="${groupName}"] input[type=checkbox]:checked`)].map(i => i.value);
  }

  function applyCatalogFilters() {
    const genders = getCheckedValues('gender');
    const colors = getCheckedValues('color');
    const shapes = getCheckedValues('shape');
    const materials = getCheckedValues('material');
    const brands = getCheckedValues('brand');
    const min = Number(document.getElementById('priceMinRange').value);
    const max = Number(document.getElementById('priceMaxRange').value);
    const lo = Math.min(min, max), hi = Math.max(min, max);
    const onlyStock = document.getElementById('onlyInStock').checked;

    catalogFiltered = CATALOG_PRODUCTS.filter(p =>
      (!genders.length || genders.includes(p.gender)) &&
      (!colors.length || colors.includes(p.color)) &&
      (!shapes.length || shapes.includes(p.shape)) &&
      (!materials.length || materials.includes(p.material)) &&
      (!brands.length || brands.includes(p.brand)) &&
      p.price >= lo && p.price <= hi &&
      (!onlyStock || p.inStock)
    );
    applySort();
    catalogVisibleCount = perPage;
    renderCatalogGrid();
  }

  showMoreBtn.addEventListener('click', () => {
    catalogVisibleCount = Math.min(catalogFiltered.length, catalogVisibleCount + perPage);
    renderCatalogGrid();
  });

  catalogGrid.addEventListener('click', (e) => {
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

  /* ---------- Filter groups: render options + search + show more ---------- */
  const VISIBLE_LIMIT = 5;
  function buildFilterGroups() {
    document.querySelectorAll('.filter-group[data-group]').forEach(group => {
      const key = group.dataset.group;
      const options = FACETS[key];
      const optionsWrap = group.querySelector('.filter-options');
      optionsWrap.innerHTML = options.map((o, i) => {
        const isPopular = FAQ_TAGS.includes(o.l);
        const isPlain = (i % 5 === 4); /* ~80% styled as real (green, underlined) links, ~20% as plain black text */
        const optionEl = isPlain
          ? `<span class="filter-check-link filter-check-plain">${o.l}</span>`
          : `<a href="#" class="filter-check-link${isPopular ? ' is-highlighted' : ''}">${o.l}</a>`;
        return `
        <div class="filter-check" data-i="${i}">
          <input type="checkbox" id="filter-${key}-${i}" name="${key}" value="${o.v}">
          ${optionEl}
        </div>
      `;
      }).join('');
      optionsWrap.querySelectorAll('a.filter-check-link').forEach(link => {
        link.addEventListener('click', (e) => {
          e.preventDefault();
          const cb = link.previousElementSibling;
          cb.checked = !cb.checked;
        });
      });
      if (options.length > VISIBLE_LIMIT) {
        const btn = document.createElement('button');
        btn.type = 'button';
        btn.className = 'filter-showmore-btn';
        group.appendChild(btn);
      }

      const search = group.querySelector('.filter-search');
      const checks = [...optionsWrap.querySelectorAll('.filter-check')];
      const showMore = group.querySelector('.filter-showmore-btn');
      let expanded = false;

      function refresh() {
        const q = search.value.trim().toLowerCase();
        checks.forEach((el, i) => {
          const matches = !q || el.textContent.toLowerCase().includes(q);
          const visible = q ? matches : (expanded || i < VISIBLE_LIMIT);
          el.style.display = visible ? '' : 'none';
        });
        if (showMore) {
          showMore.style.display = q ? 'none' : '';
          showMore.textContent = expanded ? 'Свернуть' : `Показать ещё (${options.length - VISIBLE_LIMIT})`;
        }
      }
      search.addEventListener('input', refresh);
      if (showMore) showMore.addEventListener('click', () => { expanded = !expanded; refresh(); });
      refresh();
    });
  }
  buildFilterGroups();

  /* ---------- Price range slider ---------- */
  (function initPriceRange() {
    const minR = document.getElementById('priceMinRange');
    const maxR = document.getElementById('priceMaxRange');
    const fill = document.getElementById('priceFill');
    const minLabel = document.getElementById('priceMinLabel');
    const maxLabel = document.getElementById('priceMaxLabel');
    const minInput = document.getElementById('priceMinInput');
    const maxInput = document.getElementById('priceMaxInput');
    const min = Number(minR.min), max = Number(minR.max);
    function update() {
      let a = Number(minR.value), b = Number(maxR.value);
      if (a > b) { const t = a; a = b; b = t; }
      fill.style.left = ((a - min) / (max - min)) * 100 + '%';
      fill.style.width = ((b - a) / (max - min)) * 100 + '%';
      minLabel.textContent = Number(minR.value).toLocaleString('ru-RU') + ' ₽';
      maxLabel.textContent = Number(maxR.value).toLocaleString('ru-RU') + ' ₽';
      minInput.value = minR.value;
      maxInput.value = maxR.value;
    }
    minR.addEventListener('input', () => { if (Number(minR.value) > Number(maxR.value)) minR.value = maxR.value; update(); });
    maxR.addEventListener('input', () => { if (Number(maxR.value) < Number(minR.value)) maxR.value = minR.value; update(); });
    minInput.addEventListener('input', () => {
      let v = Math.min(max, Math.max(min, Number(minInput.value) || min));
      minR.value = Math.min(v, Number(maxR.value));
      update();
    });
    maxInput.addEventListener('input', () => {
      let v = Math.min(max, Math.max(min, Number(maxInput.value) || max));
      maxR.value = Math.max(v, Number(minR.value));
      update();
    });
    update();
  })();

  /* ---------- FAQ tag pills (quick filters) ---------- */
  const tagPills = document.getElementById('tagPills');
  tagPills.innerHTML = FAQ_TAGS.map(t => `<button type="button" class="tag-pill" data-tag="${t}">${t}</button>`).join('');
  tagPills.querySelectorAll('.tag-pill').forEach(btn => {
    btn.addEventListener('click', () => {
      const tag = btn.dataset.tag;
      document.querySelectorAll('.tag-pill').forEach(b => b.classList.toggle('is-active', b === btn && !b.classList.contains('is-active')));
      const active = btn.classList.contains('is-active');
      document.querySelectorAll('input[type=checkbox][name]').forEach(cb => { cb.checked = false; });
      if (active) {
        const genderMatch = FACETS.gender.find(g => g.l === tag);
        const brandMatch = FACETS.brand.find(b => b.l === tag);
        if (genderMatch) {
          const cb = document.querySelector(`input[name="gender"][value="${genderMatch.v}"]`);
          if (cb) cb.checked = true;
        } else if (brandMatch) {
          const cb = document.querySelector(`input[name="brand"][value="${brandMatch.v}"]`);
          if (cb) cb.checked = true;
        }
      }
      applyCatalogFilters();
    });
  });

  /* ---------- Sort buttons ---------- */
  function setSort(key) {
    if (sortKey === key) {
      sortDir[key] = sortDir[key] === 'asc' ? 'desc' : 'asc';
    } else {
      sortKey = key;
    }
    document.getElementById('sortByName').classList.toggle('is-active', key === 'name');
    document.getElementById('sortByPrice').classList.toggle('is-active', key === 'price');
    document.getElementById('sortByName').classList.toggle('is-desc', key === 'name' && sortDir.name === 'desc');
    document.getElementById('sortByPrice').classList.toggle('is-desc', key === 'price' && sortDir.price === 'desc');
    applySort();
    catalogVisibleCount = perPage;
    renderCatalogGrid();
  }
  document.getElementById('sortByName').addEventListener('click', () => setSort('name'));
  document.getElementById('sortByPrice').addEventListener('click', () => setSort('price'));

  /* ---------- Per-page selector ---------- */
  document.querySelectorAll('.per-page-row button').forEach(btn => {
    btn.addEventListener('click', () => {
      document.querySelectorAll('.per-page-row button').forEach(b => b.classList.remove('is-active'));
      btn.classList.add('is-active');
      perPage = Number(btn.dataset.per);
      catalogVisibleCount = perPage;
      renderCatalogGrid();
    });
  });

  document.getElementById('filterApply').addEventListener('click', () => { applyCatalogFilters(); closeFilter(); });
  document.getElementById('filterReset').addEventListener('click', () => {
    document.querySelectorAll('.filter-panel input[type=checkbox]').forEach(i => i.checked = false);
    document.getElementById('priceMinRange').value = document.getElementById('priceMinRange').min;
    document.getElementById('priceMaxRange').value = document.getElementById('priceMaxRange').max;
    document.getElementById('priceMinRange').dispatchEvent(new Event('input'));
    document.querySelectorAll('.tag-pill').forEach(b => b.classList.remove('is-active'));
    applyCatalogFilters();
  });

  renderCatalogGrid();
}
