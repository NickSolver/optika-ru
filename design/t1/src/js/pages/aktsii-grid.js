import { renderPaginatedGrid } from './paginated-grid.js';

const cardHTML = (p) => `
  <a href="${p.href}" class="blog-card promo-card">
    <div class="blog-media"><img src="${p.img}" alt=""></div>
    <span class="blog-tag">${p.tag}</span><h3>${p.title}</h3>
    <p style="font-size:.86rem;color:var(--ink-soft);margin-top:8px">${p.desc}</p>
    <span class="blog-read">${p.cta} <svg class="icon" style="width:14px;height:14px"><use href="#i-arrow-right"/></svg></span>
  </a>`;

/**
 * Shared by aktsii.php + aktsii-andreevka.php + aktsii-deystvuyushchie.php +
 * aktsii-postoyannye.php - each passes its own (filtered) AKTSII_PROMOS array inline.
 */
export function initAktsiiGrid(promos) {
  renderPaginatedGrid({
    items: promos,
    pageSize: 6,
    gridId: 'aktsiiGrid',
    paginationId: 'aktsiiPagination',
    showMoreBtnId: 'aktsiiShowMoreBtn',
    cardHTML,
    scrollAnchorSelector: '.section-head',
  });
}
