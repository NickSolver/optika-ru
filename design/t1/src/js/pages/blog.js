import { renderPaginatedGrid } from './paginated-grid.js';

const BLOG_IMGS = ['assets/img/blog1.png', 'assets/img/blog2.png', 'assets/img/blog3.png', 'assets/img/blog4.png', 'assets/img/blog5.png', 'assets/img/blog6.png'];

const cardHTML = (p, i) => `
  <a href="blog-detail.php" class="blog-card">
    <div class="blog-media"><img src="${BLOG_IMGS[i % BLOG_IMGS.length]}" alt=""></div>
    <span class="blog-card-date">${p.date}</span><h3>${p.title}</h3>
    <p style="font-size:.84rem;color:var(--ink-soft);margin-top:8px">${p.excerpt}</p>
    <span class="blog-read">Читать <svg class="icon" style="width:14px;height:14px"><use href="#i-arrow-right"/></svg></span>
  </a>`;

export function initBlog(posts) {
  renderPaginatedGrid({
    items: posts,
    pageSize: 12,
    gridId: 'blogListGrid',
    paginationId: 'blogPagination',
    showMoreBtnId: 'blogShowMoreBtn',
    cardHTML,
    scrollAnchorSelector: '.section-head',
  });
}
