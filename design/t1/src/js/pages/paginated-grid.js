/**
 * Generic "grid + numbered pagination + show more" behavior shared by the
 * aktsii listing pages and the blog listing page - only the item data and
 * card markup differ between them.
 */
export function renderPaginatedGrid({ items, pageSize, gridId, paginationId, showMoreBtnId, cardHTML, scrollAnchorSelector }) {
  let visibleCount = pageSize;
  const showMoreBtn = document.getElementById(showMoreBtnId);

  function renderGrid() {
    document.getElementById(gridId).innerHTML = items.slice(0, visibleCount).map(cardHTML).join('');
    showMoreBtn.style.display = visibleCount >= items.length ? 'none' : '';
  }

  function renderPagination() {
    const pageCount = Math.max(1, Math.ceil(items.length / pageSize));
    const currentPage = Math.max(1, Math.ceil(visibleCount / pageSize));
    const el = document.getElementById(paginationId);
    el.innerHTML = pageCount <= 1 ? '' : Array.from({ length: pageCount }).map((_, i) =>
      `<button data-page="${i + 1}" class="${i + 1 === currentPage ? 'is-active' : ''}">${i + 1}</button>`
    ).join('');
    el.querySelectorAll('button').forEach(btn => btn.addEventListener('click', () => {
      visibleCount = Number(btn.dataset.page) * pageSize;
      renderGrid();
      renderPagination();
      window.scrollTo({ top: document.querySelector(scrollAnchorSelector).offsetTop - 100, behavior: 'smooth' });
    }));
  }

  showMoreBtn.addEventListener('click', () => {
    visibleCount = Math.min(items.length, visibleCount + pageSize);
    renderGrid();
    renderPagination();
  });

  renderGrid();
  renderPagination();
}
