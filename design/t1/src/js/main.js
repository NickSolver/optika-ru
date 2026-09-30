// Entry point bundled by esbuild into assets/js/bundle.js.
// shared.js runs its site-wide behaviors immediately on import (menus, drawers,
// modals, cart/favorites, sliders that exist in the header/footer on every page).
// Page-specific init functions are exposed on window.Bundle - each page's own
// inline <script> (with that page's data) decides which one to call.
import './shared.js';

import { renderSalonList } from './pages/salons.js';
import { initAktsiiGrid } from './pages/aktsii-grid.js';
import { initBlog } from './pages/blog.js';
import { initVacancies } from './pages/vakansii.js';
import { initOrder } from './pages/order.js';
import { initPromo } from './pages/promo.js';
import { initOtzyvy } from './pages/otzyvy.js';
import { initAboutGallery } from './pages/o-kompanii.js';
import { initTryOn } from './pages/primerka-ochkov.js';
import { initProduct } from './pages/product.js';
import { initHomepage } from './pages/index.js';
import { initCatalogSection } from './pages/catalog-section.js';

window.Bundle = {
  renderSalonList,
  initAktsiiGrid,
  initBlog,
  initVacancies,
  initOrder,
  initPromo,
  initOtzyvy,
  initAboutGallery,
  initTryOn,
  initProduct,
  initHomepage,
  initCatalogSection,
};
