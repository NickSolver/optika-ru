(() => {
  var __getOwnPropNames = Object.getOwnPropertyNames;
  var __esm = (fn, res, err) => function __init() {
    if (err) throw err[0];
    try {
      return fn && (res = (0, fn[__getOwnPropNames(fn)[0]])(fn = 0)), res;
    } catch (e) {
      throw err = [e], e;
    }
  };
  var __commonJS = (cb, mod) => function __require() {
    try {
      return mod || (0, cb[__getOwnPropNames(cb)[0]])((mod = { exports: {} }).exports, mod), mod.exports;
    } catch (e) {
      throw mod = 0, e;
    }
  };

  // src/js/shared.js
  function closeMega() {
    megaMenu.classList.remove("is-open");
    catalogBtn.setAttribute("aria-expanded", "false");
  }
  function activateMegaCat(cat) {
    document.querySelectorAll(".mega-cat").forEach((b) => b.classList.toggle("is-active", b.dataset.cat === cat));
    document.querySelectorAll(".mega-panel").forEach((p) => p.classList.toggle("is-active", p.dataset.panel === cat));
  }
  function showCatalogList() {
    catalogView = "list";
    mobileCatalogList.style.display = "";
    mobileCatalogDetail.style.display = "none";
    mobileCatalogBack.style.display = "";
    mobileCatalogTitle.textContent = "\u041A\u0430\u0442\u0430\u043B\u043E\u0433";
  }
  function showCatalogDetail(cat, label) {
    const megaPanel = document.querySelector(`.mega-panel[data-panel="${cat}"]`);
    if (!megaPanel) return;
    catalogView = "detail";
    mobileCatalogDetail.innerHTML = megaPanel.innerHTML;
    mobileCatalogDetail.querySelectorAll("a").forEach((a) => a.addEventListener("click", () => {
      mobileCatalogPanel.classList.remove("is-open");
      showCatalogList();
    }));
    mobileCatalogList.style.display = "none";
    mobileCatalogDetail.style.display = "";
    mobileCatalogBack.style.display = "";
    mobileCatalogTitle.textContent = label;
  }
  function openModal(modal) {
    modal.classList.add("is-open");
    document.body.style.overflow = "hidden";
  }
  function closeModal(modal) {
    modal.classList.remove("is-open");
    document.body.style.overflow = "";
  }
  function clearCart() {
    CART.length = 0;
  }
  function renderCart() {
    const cartItems = document.getElementById("cartItems");
    const cartCount = document.getElementById("cartCount");
    const cartTotal = document.getElementById("cartTotal");
    if (!CART.length) {
      cartItems.innerHTML = '<p class="drawer-empty">\u041A\u043E\u0440\u0437\u0438\u043D\u0430 \u043F\u0443\u0441\u0442\u0430</p>';
    } else {
      cartItems.innerHTML = CART.map((item) => `
      <div class="cart-row" data-id="${item.id}">
        <img src="${item.img}" alt="${item.name}">
        <div class="cart-row-info">
          <div class="cart-row-name">${item.name}</div>
          <div class="cart-row-qty">
            <button data-action="dec" aria-label="\u0423\u043C\u0435\u043D\u044C\u0448\u0438\u0442\u044C"><svg class="icon"><use href="#i-minus"/></svg></button>
            <span>${item.qty}</span>
            <button data-action="inc" aria-label="\u0423\u0432\u0435\u043B\u0438\u0447\u0438\u0442\u044C"><svg class="icon"><use href="#i-plus"/></svg></button>
          </div>
          <div class="cart-row-prices">
            <span class="cart-row-unit">${item.price.toLocaleString("ru-RU")} \u20BD/\u0448\u0442</span>
            <span class="cart-row-sum">${(item.price * item.qty).toLocaleString("ru-RU")} \u20BD</span>
          </div>
        </div>
        <button class="cart-row-remove" data-action="remove" aria-label="\u0423\u0434\u0430\u043B\u0438\u0442\u044C"><svg class="icon" style="width:14px;height:14px"><use href="#i-close"/></svg><span>\u0423\u0434\u0430\u043B\u0438\u0442\u044C</span></button>
      </div>
    `).join("");
    }
    const total = CART.reduce((sum, item) => sum + item.price * item.qty, 0);
    cartTotal.textContent = total.toLocaleString("ru-RU") + " \u20BD";
    cartCount.textContent = CART.reduce((sum, item) => sum + item.qty, 0);
  }
  function renderFav() {
    const favItems = document.getElementById("favItems");
    const favCount = document.getElementById("favCount");
    if (!FAVORITES.length) {
      favItems.innerHTML = '<p class="drawer-empty">\u0421\u043F\u0438\u0441\u043E\u043A \u0438\u0437\u0431\u0440\u0430\u043D\u043D\u043E\u0433\u043E \u043F\u0443\u0441\u0442</p>';
    } else {
      favItems.innerHTML = FAVORITES.map((item) => `
      <div class="fav-row" data-id="${item.id}">
        <img src="${item.img}" alt="${item.name}">
        <div class="fav-row-info">
          <div class="fav-row-name">${item.name}</div>
          <div class="fav-row-price">${item.price.toLocaleString("ru-RU")} \u20BD</div>
        </div>
        <button class="fav-row-add" data-action="add-to-cart" title="\u0412 \u043A\u043E\u0440\u0437\u0438\u043D\u0443" aria-label="\u0412 \u043A\u043E\u0440\u0437\u0438\u043D\u0443"><svg class="icon"><use href="#i-cart"/></svg></button>
        <button class="fav-row-add" data-action="buy-now" title="\u041A\u0443\u043F\u0438\u0442\u044C \u0432 \u043E\u0434\u0438\u043D \u043A\u043B\u0438\u043A" aria-label="\u041A\u0443\u043F\u0438\u0442\u044C \u0432 \u043E\u0434\u0438\u043D \u043A\u043B\u0438\u043A"><svg class="icon"><use href="#i-bolt"/></svg></button>
        <button class="fav-row-remove" data-action="remove" aria-label="\u0423\u0434\u0430\u043B\u0438\u0442\u044C"><svg class="icon" style="width:14px;height:14px"><use href="#i-close"/></svg></button>
      </div>
    `).join("");
    }
    favCount.textContent = FAVORITES.length;
  }
  function applyPhoneMask(e) {
    const input = e.target;
    let digits = input.value.replace(/\D/g, "");
    if (digits.startsWith("7") || digits.startsWith("8")) digits = digits.slice(1);
    digits = digits.slice(0, 10);
    let formatted = "+7";
    if (digits.length > 0) formatted += " (" + digits.slice(0, 3);
    if (digits.length >= 3) formatted += ") " + digits.slice(3, 6);
    if (digits.length >= 6) formatted += "-" + digits.slice(6, 8);
    if (digits.length >= 8) formatted += "-" + digits.slice(8, 10);
    input.value = formatted;
  }
  function wirePhoneMasks(scope) {
    scope.querySelectorAll("[data-phone-mask]").forEach((input) => input.addEventListener("input", applyPhoneMask));
  }
  function demoAuthenticate() {
    closeModal(loginModal);
    loginBtn.style.display = "none";
    accountLink.style.display = "";
  }
  function wireSearchDropdown(wrapEl, inputEl, dropdownEl) {
    dropdownEl.innerHTML = '<div class="search-dropdown-title">\u041F\u043E\u043F\u0443\u043B\u044F\u0440\u043D\u044B\u0435 \u0442\u043E\u0432\u0430\u0440\u044B</div>' + SEARCH_DEMO.map((p) => `
    <a href="product.php" class="search-item">
      <img src="${p.img}" alt="${p.name}">
      <div><div class="search-item-name">${p.name}</div><div class="search-item-price">${p.price}</div></div>
    </a>
  `).join("");
    inputEl.addEventListener("focus", () => dropdownEl.classList.add("is-open"));
    dropdownEl.querySelectorAll(".search-item").forEach((a) => a.addEventListener("click", () => dropdownEl.classList.remove("is-open")));
    document.addEventListener("click", (e) => {
      if (!wrapEl.contains(e.target)) dropdownEl.classList.remove("is-open");
    });
    document.addEventListener("keydown", (e) => {
      if (e.key === "Escape") dropdownEl.classList.remove("is-open");
    });
  }
  function whenVisible(el, callback) {
    if (!el) return;
    if ("IntersectionObserver" in window) {
      const io = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
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
  function starsRow(n) {
    return Array.from({ length: 5 }).map(
      (_, i) => i < n ? `<svg class="icon icon-fill" style="color:var(--green)"><use href="#i-star"/></svg>` : `<svg class="icon" style="color:var(--border)"><use href="#i-star"/></svg>`
    ).join("");
  }
  function makeSlider(track, dotsWrap, prevBtn, nextBtn, gap) {
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
      track.scrollTo({ left: Math.max(0, target), behavior: "smooth" });
    }
    function renderDots() {
      pageCount = Math.max(1, Math.ceil(itemCount / perPage()));
      const ms = maxScroll();
      let activePage = 0;
      if (ms > 0) {
        if (track.scrollLeft >= ms - 2) activePage = pageCount - 1;
        else activePage = Math.min(pageCount - 1, Math.round(track.scrollLeft / (perPage() * step())));
      }
      dotsWrap.innerHTML = Array.from({ length: pageCount }).map(
        (_, i) => `<button class="review-dot${i === activePage ? " is-active" : ""}" data-i="${i}" aria-label="\u0421\u0442\u0440\u0430\u043D\u0438\u0446\u0430 ${i + 1}"></button>`
      ).join("");
      dots = dotsWrap.querySelectorAll(".review-dot");
      dots.forEach((d) => d.addEventListener("click", () => scrollToPage(Number(d.dataset.i))));
    }
    function buildDots(count) {
      itemCount = count;
      requestAnimationFrame(renderDots);
    }
    prevBtn.addEventListener("click", () => track.scrollBy({ left: -step() * perPage(), behavior: "smooth" }));
    nextBtn.addEventListener("click", () => track.scrollBy({ left: step() * perPage(), behavior: "smooth" }));
    let t;
    track.addEventListener("scroll", () => {
      clearTimeout(t);
      t = setTimeout(() => {
        const ms = maxScroll();
        let page;
        if (track.scrollLeft >= ms - 2) page = pageCount - 1;
        else if (track.scrollLeft <= 1) page = 0;
        else page = Math.min(pageCount - 1, Math.round(track.scrollLeft / (perPage() * step())));
        dots.forEach((d, i) => d.classList.toggle("is-active", i === page));
      }, 100);
    });
    let resizeT;
    window.addEventListener("resize", () => {
      clearTimeout(resizeT);
      resizeT = setTimeout(renderDots, 150);
    });
    return { buildDots };
  }
  function makeDraggable(el) {
    let isDown = false, startX = 0, startScroll = 0, moved = false;
    el.addEventListener("mousedown", (e) => {
      e.preventDefault();
      isDown = true;
      moved = false;
      el.classList.add("is-dragging");
      el.style.scrollBehavior = "auto";
      startX = e.pageX;
      startScroll = el.scrollLeft;
    });
    window.addEventListener("mouseup", () => {
      if (!isDown) return;
      isDown = false;
      el.classList.remove("is-dragging");
      setTimeout(() => {
        el.style.scrollBehavior = "";
      }, 80);
    });
    window.addEventListener("mousemove", (e) => {
      if (!isDown) return;
      const walk = e.pageX - startX;
      if (Math.abs(walk) > 5) moved = true;
      el.scrollLeft = startScroll - walk;
    });
    el.addEventListener("click", (e) => {
      if (moved) {
        e.preventDefault();
        e.stopPropagation();
        moved = false;
      }
    }, true);
  }
  var catalogBtn, megaMenu, panel, mobileCatalogPanel, mobileCatalogList, mobileCatalogDetail, mobileCatalogBack, mobileCatalogTitle, catalogView, mobileSearchBar, newsletterForm, newsletterThanks, newsletterTimer, CART, FAVORITES, loginBtn, accountLink, loginModal, loginForm, SEARCH_DEMO, toTop, cookieBanner, revealEls;
  var init_shared = __esm({
    "src/js/shared.js"() {
      document.addEventListener("click", (e) => {
        const a = e.target.closest('a[href="#"], .subnav a, .mobile-panel nav a, .hero-actions a, .blog-card');
        if (a && a.getAttribute("href") === "#") e.preventDefault();
      });
      catalogBtn = document.getElementById("catalogBtn");
      megaMenu = document.getElementById("megaMenu");
      catalogBtn.addEventListener("click", () => {
        if (window.matchMedia("(max-width:1024px)").matches) {
          showCatalogList();
          document.getElementById("mobileCatalogPanel").classList.add("is-open");
          return;
        }
        const willOpen = !megaMenu.classList.contains("is-open");
        megaMenu.classList.toggle("is-open", willOpen);
        catalogBtn.setAttribute("aria-expanded", String(willOpen));
      });
      document.addEventListener("click", (e) => {
        if (!megaMenu.contains(e.target) && !catalogBtn.contains(e.target)) closeMega();
      });
      document.addEventListener("keydown", (e) => {
        if (e.key === "Escape") closeMega();
      });
      document.querySelectorAll(".mega-cat").forEach((btn) => {
        btn.addEventListener("mouseenter", () => activateMegaCat(btn.dataset.cat));
        btn.addEventListener("click", () => activateMegaCat(btn.dataset.cat));
      });
      megaMenu.querySelectorAll(".mega-col a").forEach((a) => a.addEventListener("click", closeMega));
      document.getElementById("catalogNavLink").addEventListener("click", (e) => {
        if (window.matchMedia("(min-width:1025px)").matches) {
          e.preventDefault();
          e.stopPropagation();
          catalogBtn.click();
        }
      });
      panel = document.getElementById("mobilePanel");
      document.getElementById("menuOpen").addEventListener("click", () => panel.classList.add("is-open"));
      document.getElementById("menuClose").addEventListener("click", () => panel.classList.remove("is-open"));
      panel.querySelectorAll("a").forEach((a) => a.addEventListener("click", () => panel.classList.remove("is-open")));
      document.getElementById("mobileCallbackBtn").addEventListener("click", () => {
        panel.classList.remove("is-open");
        openModal(document.getElementById("callbackModal"));
      });
      document.getElementById("mobileNavCatalog").addEventListener("click", (e) => {
        e.preventDefault();
        panel.classList.remove("is-open");
        showCatalogList();
        document.getElementById("mobileCatalogPanel").classList.add("is-open");
      });
      mobileCatalogPanel = document.getElementById("mobileCatalogPanel");
      mobileCatalogList = document.getElementById("mobileCatalogList");
      mobileCatalogDetail = document.getElementById("mobileCatalogDetail");
      mobileCatalogBack = document.getElementById("mobileCatalogBack");
      mobileCatalogTitle = document.getElementById("mobileCatalogTitle");
      catalogView = "list";
      mobileCatalogList.querySelectorAll(".mobile-catalog-item[data-cat]").forEach((item) => {
        item.addEventListener("click", (e) => {
          e.preventDefault();
          showCatalogDetail(item.dataset.cat, item.dataset.label);
        });
      });
      mobileCatalogBack.addEventListener("click", () => {
        if (catalogView === "detail") {
          showCatalogList();
        } else {
          mobileCatalogPanel.classList.remove("is-open");
          panel.classList.add("is-open");
        }
      });
      document.getElementById("mobileCatalogClose").addEventListener("click", () => {
        mobileCatalogPanel.classList.remove("is-open");
        showCatalogList();
      });
      mobileSearchBar = document.getElementById("mobileSearchBar");
      document.getElementById("mobileSearchBtn").addEventListener("click", () => {
        mobileSearchBar.classList.add("is-open");
        document.getElementById("mobileSearchInput").focus();
      });
      document.getElementById("mobileSearchClose").addEventListener("click", () => {
        mobileSearchBar.classList.remove("is-open");
        document.getElementById("mobileSearchDropdown").classList.remove("is-open");
      });
      newsletterForm = document.getElementById("newsletterForm");
      newsletterThanks = document.getElementById("newsletterThanks");
      newsletterForm.addEventListener("submit", (e) => {
        e.preventDefault();
        newsletterForm.reset();
        newsletterThanks.classList.add("is-visible");
        clearTimeout(newsletterTimer);
        newsletterTimer = setTimeout(() => newsletterThanks.classList.remove("is-visible"), 3500);
      });
      document.querySelectorAll(".modal-overlay").forEach((modal) => {
        modal.addEventListener("click", (e) => {
          if (e.target === modal) closeModal(modal);
        });
        modal.querySelectorAll("[data-modal-close]").forEach((btn) => btn.addEventListener("click", () => closeModal(modal)));
        if (modal.id === "loginModal" || modal.id === "addToCartModal" || modal.id === "reviewModal" || modal.id === "salonModal" || modal.id === "vacancyDetailsModal") return;
        const form = modal.querySelector("[data-modal-form]");
        const modalBody = modal.querySelector(".modal-body");
        const originalForm = form.outerHTML;
        form.addEventListener("submit", (e) => {
          e.preventDefault();
          modalBody.innerHTML = `
      <div class="modal-thanks">
        <div class="icon-wrap"><svg class="icon" style="width:26px;height:26px"><use href="#i-check"/></svg></div>
        <h4>\u0421\u043F\u0430\u0441\u0438\u0431\u043E!</h4>
        <p>\u0412\u0430\u0448\u0430 \u0437\u0430\u044F\u0432\u043A\u0430 \u043E\u0442\u043F\u0440\u0430\u0432\u043B\u0435\u043D\u0430, \u043C\u044B \u0441\u0432\u044F\u0436\u0435\u043C\u0441\u044F \u0441 \u0432\u0430\u043C\u0438 \u0432 \u0431\u043B\u0438\u0436\u0430\u0439\u0448\u0435\u0435 \u0432\u0440\u0435\u043C\u044F.</p>
      </div>`;
          setTimeout(() => {
            closeModal(modal);
            setTimeout(() => {
              modalBody.innerHTML = originalForm;
              wirePhoneMasks(modal);
            }, 300);
          }, 1800);
        });
      });
      document.addEventListener("keydown", (e) => {
        if (e.key === "Escape") {
          document.querySelectorAll(".modal-overlay.is-open").forEach(closeModal);
          document.querySelectorAll(".drawer-overlay.is-open").forEach(closeModal);
        }
      });
      document.querySelectorAll(".drawer-overlay").forEach((drawer) => {
        drawer.addEventListener("click", (e) => {
          if (e.target === drawer) closeModal(drawer);
        });
        drawer.querySelectorAll("[data-drawer-close]").forEach((btn) => btn.addEventListener("click", () => closeModal(drawer)));
      });
      CART = [
        { id: 1, name: "\u041E\u043F\u0440\u0430\u0432\u0430 \u0434\u043B\u044F \u043E\u0447\u043A\u043E\u0432 Lokamed 34133 C6-2", price: 5650, img: "assets/img/product1.png", qty: 1 },
        { id: 2, name: "\u041E\u043F\u0440\u0430\u0432\u0430 \u0434\u043B\u044F \u043E\u0447\u043A\u043E\u0432 Lokamed 37059 C9", price: 5650, img: "assets/img/product2.png", qty: 1 }
      ];
      FAVORITES = [
        { id: 3, name: "\u041E\u043F\u0440\u0430\u0432\u0430 \u0434\u043B\u044F \u043E\u0447\u043A\u043E\u0432 Lokamed 34132 C6-1", price: 5650, img: "assets/img/product3.png" },
        { id: 4, name: "\u041E\u043F\u0440\u0430\u0432\u0430 \u0434\u043B\u044F \u043E\u0447\u043A\u043E\u0432 Lokamed 34125 C2", price: 5650, img: "assets/img/product4.png" },
        { id: 2, name: "\u041E\u043F\u0440\u0430\u0432\u0430 \u0434\u043B\u044F \u043E\u0447\u043A\u043E\u0432 Lokamed 37059 C9", price: 5650, img: "assets/img/product2.png" },
        { id: 1, name: "\u041E\u043F\u0440\u0430\u0432\u0430 \u0434\u043B\u044F \u043E\u0447\u043A\u043E\u0432 Lokamed 34133 C6-2", price: 5650, img: "assets/img/product1.png" }
      ];
      document.getElementById("cartItems").addEventListener("click", (e) => {
        const btn = e.target.closest("button[data-action]");
        if (!btn) return;
        const id = Number(btn.closest(".cart-row").dataset.id);
        const item = CART.find((p) => p.id === id);
        if (btn.dataset.action === "inc") item.qty++;
        if (btn.dataset.action === "dec") item.qty = Math.max(1, item.qty - 1);
        if (btn.dataset.action === "remove") CART = CART.filter((p) => p.id !== id);
        renderCart();
      });
      document.getElementById("favItems").addEventListener("click", (e) => {
        const btn = e.target.closest("button[data-action]");
        if (!btn) return;
        const id = Number(btn.closest(".fav-row").dataset.id);
        const item = FAVORITES.find((p) => p.id === id);
        if (btn.dataset.action === "add-to-cart") {
          const existing = CART.find((p) => p.id === id);
          if (existing) existing.qty++;
          else CART.push({ ...item, qty: 1 });
          renderCart();
          openModal(document.getElementById("addToCartModal"));
        }
        if (btn.dataset.action === "buy-now") {
          document.getElementById("buyNowProductName").textContent = item.name;
          openModal(document.getElementById("buyNowModal"));
        }
        if (btn.dataset.action === "remove") FAVORITES = FAVORITES.filter((p) => p.id !== id);
        renderFav();
      });
      document.getElementById("cartOpen").addEventListener("click", (e) => {
        e.preventDefault();
        openModal(document.getElementById("cartDrawer"));
      });
      document.getElementById("goToCartBtn").addEventListener("click", () => {
        closeModal(document.getElementById("addToCartModal"));
        openModal(document.getElementById("cartDrawer"));
      });
      document.getElementById("favOpen").addEventListener("click", (e) => {
        e.preventDefault();
        openModal(document.getElementById("favDrawer"));
      });
      document.getElementById("cartBuyNowBtn").addEventListener("click", () => {
        if (!CART.length) return;
        const buyNowNameEl = document.getElementById("buyNowProductName");
        if (CART.length === 1) {
          buyNowNameEl.textContent = CART[0].name;
        } else {
          const total = CART.reduce((sum, item) => sum + item.price * item.qty, 0);
          buyNowNameEl.innerHTML = CART.map((item) => `${item.name} \xD7 ${item.qty}`).join("<br>") + `<br><strong>\u0418\u0442\u043E\u0433\u043E: ${total.toLocaleString("ru-RU")} \u20BD</strong>`;
        }
        openModal(document.getElementById("buyNowModal"));
      });
      document.getElementById("cartPromoBtn").addEventListener("click", () => {
        const input = document.getElementById("cartPromoInput");
        if (input.value.trim()) input.placeholder = "\u041F\u0440\u043E\u043C\u043E\u043A\u043E\u0434 \u043F\u0440\u0438\u043C\u0435\u043D\u0451\u043D";
        input.value = "";
      });
      renderCart();
      renderFav();
      wirePhoneMasks(document);
      document.getElementById("feedbackOpen").addEventListener("click", (e) => {
        e.preventDefault();
        openModal(document.getElementById("feedbackModal"));
      });
      document.getElementById("callbackBtn").addEventListener("click", () => openModal(document.getElementById("callbackModal")));
      loginBtn = document.getElementById("loginBtn");
      accountLink = document.getElementById("accountLink");
      loginModal = document.getElementById("loginModal");
      loginForm = document.getElementById("loginForm");
      loginBtn.addEventListener("click", () => openModal(loginModal));
      loginForm.addEventListener("submit", (e) => {
        e.preventDefault();
        demoAuthenticate();
      });
      loginModal.querySelectorAll("[data-social-login]").forEach((btn) => btn.addEventListener("click", demoAuthenticate));
      accountLink.addEventListener("click", (e) => {
        e.preventDefault();
        accountLink.style.display = "none";
        loginBtn.style.display = "";
      });
      SEARCH_DEMO = [
        { name: "\u041E\u043F\u0440\u0430\u0432\u0430 \u0434\u043B\u044F \u043E\u0447\u043A\u043E\u0432 Lokamed 34133 C6-2", price: "5 650 \u20BD", img: "assets/img/product1.png" },
        { name: "\u041E\u043F\u0440\u0430\u0432\u0430 \u0434\u043B\u044F \u043E\u0447\u043A\u043E\u0432 Lokamed 37059 C9", price: "5 650 \u20BD", img: "assets/img/product2.png" },
        { name: "\u041E\u043F\u0440\u0430\u0432\u0430 \u0434\u043B\u044F \u043E\u0447\u043A\u043E\u0432 Lokamed 34132 C6-1", price: "5 650 \u20BD", img: "assets/img/product3.png" },
        { name: "\u041E\u043F\u0440\u0430\u0432\u0430 \u0434\u043B\u044F \u043E\u0447\u043A\u043E\u0432 Lokamed 34125 C2", price: "5 650 \u20BD", img: "assets/img/product4.png" }
      ];
      wireSearchDropdown(document.getElementById("searchWrap"), document.getElementById("searchInput"), document.getElementById("searchDropdown"));
      wireSearchDropdown(document.getElementById("mobileSearchBar"), document.getElementById("mobileSearchInput"), document.getElementById("mobileSearchDropdown"));
      toTop = document.getElementById("toTop");
      window.addEventListener("scroll", () => {
        toTop.classList.toggle("is-visible", window.scrollY > 400);
      });
      cookieBanner = document.getElementById("cookieBanner");
      if (cookieBanner) {
        if (localStorage.getItem("cookieAccepted") === "1") {
          cookieBanner.classList.add("is-hidden");
        }
        document.getElementById("cookieAcceptBtn").addEventListener("click", () => {
          localStorage.setItem("cookieAccepted", "1");
          cookieBanner.classList.add("is-hidden");
        });
      }
      revealEls = document.querySelectorAll("[data-reveal]");
      if ("IntersectionObserver" in window) {
        const io = new IntersectionObserver((entries) => {
          entries.forEach((entry) => {
            if (entry.isIntersecting) {
              entry.target.classList.add("is-visible");
              io.unobserve(entry.target);
            }
          });
        }, { threshold: 0.15 });
        revealEls.forEach((el) => io.observe(el));
      } else {
        revealEls.forEach((el) => el.classList.add("is-visible"));
      }
      document.querySelectorAll(".spoiler-head").forEach((head) => {
        head.addEventListener("click", () => {
          head.closest(".spoiler").classList.toggle("is-open");
        });
      });
    }
  });

  // src/js/pages/salons.js
  function renderSalonList(SALONS) {
    const salonGrid = document.getElementById("salonGrid");
    salonGrid.innerHTML = SALONS.map((s, i) => `
    <div class="salon-tile" data-i="${i}">
      <div class="salon-tile-media"><img src="${s.img}" alt="\u0421\u0430\u043B\u043E\u043D \u043E\u043F\u0442\u0438\u043A\u0438: ${s.name}"></div>
      <div class="salon-tile-body">
        <h3>${s.name}</h3>
        <div class="salon-tile-addr"><svg class="icon"><use href="#i-pin"/></svg>${s.addr}</div>
        <div class="salon-tile-hours"><svg class="icon"><use href="#i-clock"/></svg>${HOURS}</div>
      </div>
    </div>
  `).join("");
    salonGrid.querySelectorAll(".salon-tile").forEach((tile) => {
      tile.addEventListener("click", () => {
        const s = SALONS[Number(tile.dataset.i)];
        document.getElementById("salonModalImg").src = s.img;
        document.getElementById("salonModalName").textContent = s.name;
        document.getElementById("salonModalAddr").innerHTML = `<svg class="icon"><use href="#i-pin"/></svg>${s.addr}`;
        document.getElementById("salonModalHours").innerHTML = `<svg class="icon"><use href="#i-clock"/></svg>${HOURS}`;
        document.getElementById("salonModalMap").src = `https://yandex.ru/map-widget/v1/?ll=${s.lon}%2C${s.lat}&z=15&pt=${s.lon},${s.lat},pm2rdl`;
        openModal(document.getElementById("salonModal"));
      });
    });
  }
  var HOURS;
  var init_salons = __esm({
    "src/js/pages/salons.js"() {
      init_shared();
      HOURS = "\u0415\u0436\u0435\u0434\u043D\u0435\u0432\u043D\u043E 10:00\u201321:00";
    }
  });

  // src/js/pages/paginated-grid.js
  function renderPaginatedGrid({ items, pageSize, gridId, paginationId, showMoreBtnId, cardHTML: cardHTML3, scrollAnchorSelector }) {
    let visibleCount = pageSize;
    const showMoreBtn = document.getElementById(showMoreBtnId);
    function renderGrid() {
      document.getElementById(gridId).innerHTML = items.slice(0, visibleCount).map(cardHTML3).join("");
      showMoreBtn.style.display = visibleCount >= items.length ? "none" : "";
    }
    function renderPagination() {
      const pageCount = Math.max(1, Math.ceil(items.length / pageSize));
      const currentPage = Math.max(1, Math.ceil(visibleCount / pageSize));
      const el = document.getElementById(paginationId);
      el.innerHTML = pageCount <= 1 ? "" : Array.from({ length: pageCount }).map(
        (_, i) => `<button data-page="${i + 1}" class="${i + 1 === currentPage ? "is-active" : ""}">${i + 1}</button>`
      ).join("");
      el.querySelectorAll("button").forEach((btn) => btn.addEventListener("click", () => {
        visibleCount = Number(btn.dataset.page) * pageSize;
        renderGrid();
        renderPagination();
        window.scrollTo({ top: document.querySelector(scrollAnchorSelector).offsetTop - 100, behavior: "smooth" });
      }));
    }
    showMoreBtn.addEventListener("click", () => {
      visibleCount = Math.min(items.length, visibleCount + pageSize);
      renderGrid();
      renderPagination();
    });
    renderGrid();
    renderPagination();
  }
  var init_paginated_grid = __esm({
    "src/js/pages/paginated-grid.js"() {
    }
  });

  // src/js/pages/aktsii-grid.js
  function initAktsiiGrid(promos) {
    renderPaginatedGrid({
      items: promos,
      pageSize: 6,
      gridId: "aktsiiGrid",
      paginationId: "aktsiiPagination",
      showMoreBtnId: "aktsiiShowMoreBtn",
      cardHTML,
      scrollAnchorSelector: ".section-head"
    });
  }
  var cardHTML;
  var init_aktsii_grid = __esm({
    "src/js/pages/aktsii-grid.js"() {
      init_paginated_grid();
      cardHTML = (p) => `
  <a href="${p.href}" class="blog-card promo-card">
    <div class="blog-media"><img src="${p.img}" alt=""></div>
    <span class="blog-tag">${p.tag}</span><h3>${p.title}</h3>
    <p style="font-size:.86rem;color:var(--ink-soft);margin-top:8px">${p.desc}</p>
    <span class="blog-read">${p.cta} <svg class="icon" style="width:14px;height:14px"><use href="#i-arrow-right"/></svg></span>
  </a>`;
    }
  });

  // src/js/pages/blog.js
  function initBlog(posts) {
    renderPaginatedGrid({
      items: posts,
      pageSize: 12,
      gridId: "blogListGrid",
      paginationId: "blogPagination",
      showMoreBtnId: "blogShowMoreBtn",
      cardHTML: cardHTML2,
      scrollAnchorSelector: ".section-head"
    });
  }
  var BLOG_IMGS, cardHTML2;
  var init_blog = __esm({
    "src/js/pages/blog.js"() {
      init_paginated_grid();
      BLOG_IMGS = ["assets/img/blog1.png", "assets/img/blog2.png", "assets/img/blog3.png", "assets/img/blog4.png", "assets/img/blog5.png", "assets/img/blog6.png"];
      cardHTML2 = (p, i) => `
  <a href="blog-detail.php" class="blog-card">
    <div class="blog-media"><img src="${BLOG_IMGS[i % BLOG_IMGS.length]}" alt=""></div>
    <span class="blog-card-date">${p.date}</span><h3>${p.title}</h3>
    <p style="font-size:.84rem;color:var(--ink-soft);margin-top:8px">${p.excerpt}</p>
    <span class="blog-read">\u0427\u0438\u0442\u0430\u0442\u044C <svg class="icon" style="width:14px;height:14px"><use href="#i-arrow-right"/></svg></span>
  </a>`;
    }
  });

  // src/js/pages/vakansii.js
  function initVacancies(VACANCIES) {
    const vacancyGrid = document.getElementById("vacancyGrid");
    vacancyGrid.innerHTML = VACANCIES.map((v, i) => `
    <div class="vacancy-card" data-vacancy-card="${i}">
      <h3>${v.title}</h3>
      <div class="vacancy-salary">${v.salary}</div>
      <div class="vacancy-meta"><svg class="icon"><use href="#i-pin"/></svg>${v.salon}</div>
      <p>${v.desc}</p>
      <button class="btn btn-primary btn-block" data-vacancy="${i}">\u041E\u0442\u043A\u043B\u0438\u043A\u043D\u0443\u0442\u044C\u0441\u044F</button>
    </div>
  `).join("");
    function openApplyModal(v) {
      document.getElementById("vacancyModalTitle").textContent = `\u041E\u0442\u043A\u043B\u0438\u043A \u043D\u0430 \u0432\u0430\u043A\u0430\u043D\u0441\u0438\u044E: ${v.title}`;
      document.getElementById("vacancyModalSalon").textContent = v.salon;
      openModal(document.getElementById("vacancyModal"));
    }
    let vacancyDetailsCurrent = null;
    vacancyGrid.addEventListener("click", (e) => {
      const btn = e.target.closest("[data-vacancy]");
      if (btn) {
        openApplyModal(VACANCIES[Number(btn.dataset.vacancy)]);
        return;
      }
      const card = e.target.closest("[data-vacancy-card]");
      if (card) {
        const v = VACANCIES[Number(card.dataset.vacancyCard)];
        vacancyDetailsCurrent = v;
        document.getElementById("vacancyDetailsTitle").textContent = v.title;
        document.getElementById("vacancyDetailsSalon").textContent = v.salon;
        openModal(document.getElementById("vacancyDetailsModal"));
      }
    });
    document.getElementById("vacancyDetailsApplyBtn").addEventListener("click", () => {
      closeModal(document.getElementById("vacancyDetailsModal"));
      if (vacancyDetailsCurrent) openApplyModal(vacancyDetailsCurrent);
    });
  }
  var init_vakansii = __esm({
    "src/js/pages/vakansii.js"() {
      init_shared();
    }
  });

  // src/js/pages/order.js
  function initOrder() {
    function renderOrderItems() {
      const wrap = document.getElementById("orderItems");
      if (!CART.length) {
        wrap.innerHTML = '<p class="order-empty">\u041A\u043E\u0440\u0437\u0438\u043D\u0430 \u043F\u0443\u0441\u0442\u0430</p>';
      } else {
        wrap.innerHTML = CART.map((item) => `
        <div class="order-basket-item">
          <img src="${item.img}" alt="${item.name}">
          <div class="order-basket-item-info">
            <div class="order-basket-item-name">${item.name}</div>
            <div class="order-basket-item-meta">${item.qty} \xD7 ${item.price.toLocaleString("ru-RU")} \u20BD</div>
          </div>
          <div class="order-basket-item-sum">${(item.price * item.qty).toLocaleString("ru-RU")} \u20BD</div>
        </div>
      `).join("");
      }
      const total = CART.reduce((sum, item) => sum + item.price * item.qty, 0);
      const count = CART.reduce((sum, item) => sum + item.qty, 0);
      document.getElementById("orderSummaryCount").textContent = count;
      document.getElementById("orderSummarySubtotal").textContent = total.toLocaleString("ru-RU") + " \u20BD";
      document.getElementById("orderTotal").textContent = total.toLocaleString("ru-RU") + " \u20BD";
      document.getElementById("orderStepConfirmSummary").textContent = `\u0422\u043E\u0432\u0430\u0440\u043E\u0432: ${count} \u043D\u0430 \u0441\u0443\u043C\u043C\u0443 ${total.toLocaleString("ru-RU")} \u20BD`;
    }
    renderOrderItems();
    document.querySelectorAll("[data-step-toggle]").forEach((link) => {
      link.addEventListener("click", () => {
        document.getElementById(link.dataset.stepToggle).classList.add("is-expanded");
      });
    });
    document.querySelectorAll('input[name="delivery"]').forEach((input) => {
      input.addEventListener("change", () => {
        document.querySelectorAll('.order-option-card[data-group="delivery"]').forEach((card) => {
          card.classList.toggle("is-selected", card.querySelector("input").checked);
        });
        document.getElementById("orderAddressWrap").style.display = document.getElementById("orderDeliveryCourier").checked ? "" : "none";
        document.getElementById("orderSalonWrap").style.display = document.getElementById("orderDeliveryPickup").checked ? "" : "none";
        document.getElementById("orderStepDeliverySummary").textContent = document.getElementById("orderDeliveryCourier").checked ? "\u041A\u0443\u0440\u044C\u0435\u0440\u043E\u043C \u043F\u043E \u041C\u043E\u0441\u043A\u0432\u0435 \u0438 \u043E\u0431\u043B\u0430\u0441\u0442\u0438" : "\u0421\u0430\u043C\u043E\u0432\u044B\u0432\u043E\u0437 \u0438\u0437 \u0441\u0430\u043B\u043E\u043D\u0430";
      });
    });
    document.querySelectorAll('input[name="payment"]').forEach((input) => {
      input.addEventListener("change", () => {
        document.querySelectorAll('.order-option-card[data-group="payment"]').forEach((card) => {
          card.classList.toggle("is-selected", card.querySelector("input").checked);
        });
        document.getElementById("orderStepPaymentSummary").textContent = document.querySelector('input[name="payment"]:checked').value === "online" ? "\u041E\u043D\u043B\u0430\u0439\u043D \u043A\u0430\u0440\u0442\u043E\u0439" : "\u041D\u0430\u043B\u0438\u0447\u043D\u044B\u043C\u0438 \u0438\u043B\u0438 \u043A\u0430\u0440\u0442\u043E\u0439 \u043F\u0440\u0438 \u043F\u043E\u043B\u0443\u0447\u0435\u043D\u0438\u0438";
      });
    });
    document.getElementById("orderCouponBtn").addEventListener("click", () => {
      const input = document.getElementById("orderCouponInput");
      if (input.value.trim()) input.placeholder = "\u041F\u0440\u043E\u043C\u043E\u043A\u043E\u0434 \u043F\u0440\u0438\u043C\u0435\u043D\u0451\u043D";
      input.value = "";
    });
    document.getElementById("orderForm").addEventListener("submit", (e) => {
      e.preventDefault();
      clearCart();
      renderCart();
      document.getElementById("orderLayout").style.display = "none";
      document.getElementById("orderThanks").style.display = "";
    });
  }
  var init_order = __esm({
    "src/js/pages/order.js"() {
      init_shared();
    }
  });

  // src/js/pages/promo.js
  function initPromo() {
    document.getElementById("promoCopyBtn").addEventListener("click", (e) => {
      const btn = e.currentTarget;
      const code = document.getElementById("promoCodeText").textContent.trim();
      const restore = () => {
        btn.textContent = "\u0421\u043A\u043E\u043F\u0438\u0440\u043E\u0432\u0430\u0442\u044C";
      };
      const showCopied = () => {
        btn.textContent = "\u0421\u043A\u043E\u043F\u0438\u0440\u043E\u0432\u0430\u043D\u043E!";
        setTimeout(restore, 1800);
      };
      if (navigator.clipboard && navigator.clipboard.writeText) {
        navigator.clipboard.writeText(code).then(showCopied).catch(showCopied);
      } else {
        showCopied();
      }
    });
  }
  var init_promo = __esm({
    "src/js/pages/promo.js"() {
    }
  });

  // src/js/pages/otzyvy.js
  function initOtzyvy() {
    const selectorOptik = document.getElementById("selectorOptik");
    const widget = document.getElementById("widget");
    selectorOptik.addEventListener("change", () => {
      widget.src = `https://yandex.ru/maps-reviews-widget/${selectorOptik.value}?comments`;
    });
  }
  var init_otzyvy = __esm({
    "src/js/pages/otzyvy.js"() {
    }
  });

  // src/js/pages/o-kompanii.js
  function initAboutGallery() {
    Fancybox.bind('[data-fancybox="about-gallery"]', {
      Toolbar: { display: { left: [], middle: [], right: ["close"] } }
    });
  }
  var init_o_kompanii = __esm({
    "src/js/pages/o-kompanii.js"() {
    }
  });

  // src/js/pages/primerka-ochkov.js
  function initTryOn(GLASSES) {
    let selectedGlasses = GLASSES[0];
    let uploadedImg = null;
    let faceLandmarks = null;
    let faceBox = null;
    let modelsReady = false;
    const statusEl = document.getElementById("tryonStatus");
    const placeholderEl = document.getElementById("tryonPlaceholder");
    const canvas = document.getElementById("tryonCanvas");
    const ctx = canvas.getContext("2d");
    const fileInput = document.getElementById("tryonFileInput");
    const resetBtn = document.getElementById("tryonResetBtn");
    const glassesListEl = document.getElementById("tryonGlassesList");
    function setStatus(text, isError) {
      statusEl.textContent = text;
      statusEl.classList.toggle("is-error", Boolean(isError));
    }
    function renderGlassesList() {
      glassesListEl.innerHTML = GLASSES.map((g) => `
      <button type="button" class="tryon-glasses-card${g.id === selectedGlasses.id ? " is-active" : ""}" data-id="${g.id}">
        <img src="${g.img}" alt="${g.name}">
        <span>${g.name}</span>
      </button>
    `).join("");
    }
    renderGlassesList();
    glassesListEl.addEventListener("click", (e) => {
      const btn = e.target.closest(".tryon-glasses-card");
      if (!btn) return;
      selectedGlasses = GLASSES.find((g) => g.id === Number(btn.dataset.id));
      renderGlassesList();
      if (faceLandmarks) drawOverlay();
    });
    async function loadModels() {
      try {
        await faceapi.nets.tinyFaceDetector.loadFromUri(MODEL_URL);
        await faceapi.nets.faceLandmark68Net.loadFromUri(MODEL_URL);
        modelsReady = true;
        setStatus("\u0417\u0430\u0433\u0440\u0443\u0437\u0438\u0442\u0435 \u0441\u0432\u043E\u0451 \u0444\u043E\u0442\u043E, \u0447\u0442\u043E\u0431\u044B \u043F\u0440\u0438\u043C\u0435\u0440\u0438\u0442\u044C \u043E\u0447\u043A\u0438.");
      } catch (err) {
        console.error("[\u041F\u0440\u0438\u043C\u0435\u0440\u043A\u0430 \u043E\u0447\u043A\u043E\u0432] \u041D\u0435 \u0443\u0434\u0430\u043B\u043E\u0441\u044C \u0437\u0430\u0433\u0440\u0443\u0437\u0438\u0442\u044C \u043C\u043E\u0434\u0435\u043B\u044C:", err);
        setStatus("\u041D\u0435 \u0443\u0434\u0430\u043B\u043E\u0441\u044C \u0437\u0430\u0433\u0440\u0443\u0437\u0438\u0442\u044C \u043C\u043E\u0434\u0435\u043B\u044C \u0440\u0430\u0441\u043F\u043E\u0437\u043D\u0430\u0432\u0430\u043D\u0438\u044F \u043B\u0438\u0446\u0430. \u041F\u0440\u043E\u0432\u0435\u0440\u044C\u0442\u0435 \u0441\u043E\u0435\u0434\u0438\u043D\u0435\u043D\u0438\u0435 \u0441 \u0438\u043D\u0442\u0435\u0440\u043D\u0435\u0442\u043E\u043C \u0438 \u043E\u0431\u043D\u043E\u0432\u0438\u0442\u0435 \u0441\u0442\u0440\u0430\u043D\u0438\u0446\u0443.", true);
      }
    }
    loadModels();
    fileInput.addEventListener("change", () => {
      const file = fileInput.files[0];
      if (!file) return;
      if (!modelsReady) {
        setStatus("\u041C\u043E\u0434\u0435\u043B\u044C \u0435\u0449\u0451 \u0437\u0430\u0433\u0440\u0443\u0436\u0430\u0435\u0442\u0441\u044F, \u043F\u043E\u043F\u0440\u043E\u0431\u0443\u0439\u0442\u0435 \u0447\u0435\u0440\u0435\u0437 \u043D\u0435\u0441\u043A\u043E\u043B\u044C\u043A\u043E \u0441\u0435\u043A\u0443\u043D\u0434.", true);
        return;
      }
      setStatus("\u041E\u043F\u0440\u0435\u0434\u0435\u043B\u044F\u0435\u043C \u043B\u0438\u0446\u043E \u043D\u0430 \u0444\u043E\u0442\u043E\u2026");
      const url = URL.createObjectURL(file);
      const img = new Image();
      img.onload = async () => {
        uploadedImg = img;
        canvas.width = img.naturalWidth;
        canvas.height = img.naturalHeight;
        canvas.classList.add("is-visible");
        placeholderEl.style.display = "none";
        resetBtn.style.display = "";
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        ctx.drawImage(img, 0, 0);
        const detection = await faceapi.detectSingleFace(img, new faceapi.TinyFaceDetectorOptions()).withFaceLandmarks();
        if (!detection) {
          faceLandmarks = null;
          faceBox = null;
          setStatus("\u041D\u0435 \u0443\u0434\u0430\u043B\u043E\u0441\u044C \u043D\u0430\u0439\u0442\u0438 \u043B\u0438\u0446\u043E \u043D\u0430 \u0444\u043E\u0442\u043E. \u041F\u043E\u043F\u0440\u043E\u0431\u0443\u0439\u0442\u0435 \u0434\u0440\u0443\u0433\u043E\u0435 \u0444\u043E\u0442\u043E \u2014 \u0430\u043D\u0444\u0430\u0441, \u043F\u0440\u0438 \u0445\u043E\u0440\u043E\u0448\u0435\u043C \u043E\u0441\u0432\u0435\u0449\u0435\u043D\u0438\u0438.", true);
          return;
        }
        faceLandmarks = detection.landmarks;
        faceBox = detection.detection.box;
        setStatus("\u0413\u043E\u0442\u043E\u0432\u043E! \u0412\u044B\u0431\u0435\u0440\u0438\u0442\u0435 \u043E\u043F\u0440\u0430\u0432\u0443 \u0441\u043F\u0440\u0430\u0432\u0430, \u0447\u0442\u043E\u0431\u044B \u043F\u0440\u0438\u043C\u0435\u0440\u0438\u0442\u044C \u0434\u0440\u0443\u0433\u0443\u044E \u043C\u043E\u0434\u0435\u043B\u044C.");
        drawOverlay();
      };
      img.src = url;
    });
    function drawOverlay() {
      ctx.clearRect(0, 0, canvas.width, canvas.height);
      ctx.drawImage(uploadedImg, 0, 0);
      const centroid = (pts) => ({
        x: pts.reduce((s, p) => s + p.x, 0) / pts.length,
        y: pts.reduce((s, p) => s + p.y, 0) / pts.length
      });
      const leftC = centroid(faceLandmarks.getLeftEye());
      const rightC = centroid(faceLandmarks.getRightEye());
      let midX = (leftC.x + rightC.x) / 2;
      let midY = (leftC.y + rightC.y) / 2;
      let dx = rightC.x - leftC.x;
      let dy = rightC.y - leftC.y;
      let eyeDist = Math.sqrt(dx * dx + dy * dy);
      let angle = Math.atan2(dy, dx);
      if (faceBox) {
        const eyeDistRatio = eyeDist / faceBox.width;
        const eyeYRatio = (midY - faceBox.y) / faceBox.height;
        const implausible = eyeDistRatio < 0.25 || eyeDistRatio > 0.65 || eyeYRatio < 0.1 || eyeYRatio > 0.6;
        if (implausible) {
          eyeDist = faceBox.width * 0.35;
          midX = faceBox.x + faceBox.width / 2;
          midY = faceBox.y + faceBox.height * 0.38;
          angle = 0;
        }
      }
      const glassesImg = new Image();
      glassesImg.onload = () => {
        const targetWidth = eyeDist * 2.6;
        const targetHeight = targetWidth * (glassesImg.naturalHeight / glassesImg.naturalWidth);
        ctx.save();
        ctx.translate(midX, midY);
        ctx.rotate(angle);
        ctx.drawImage(glassesImg, -targetWidth / 2, -targetHeight / 2, targetWidth, targetHeight);
        ctx.restore();
      };
      glassesImg.src = selectedGlasses.img;
    }
    resetBtn.addEventListener("click", () => {
      uploadedImg = null;
      faceLandmarks = null;
      faceBox = null;
      fileInput.value = "";
      canvas.classList.remove("is-visible");
      placeholderEl.style.display = "";
      resetBtn.style.display = "none";
      setStatus(modelsReady ? "\u0417\u0430\u0433\u0440\u0443\u0437\u0438\u0442\u0435 \u0441\u0432\u043E\u0451 \u0444\u043E\u0442\u043E, \u0447\u0442\u043E\u0431\u044B \u043F\u0440\u0438\u043C\u0435\u0440\u0438\u0442\u044C \u043E\u0447\u043A\u0438." : "\u0417\u0430\u0433\u0440\u0443\u0436\u0430\u0435\u043C \u043C\u043E\u0434\u0435\u043B\u044C \u0440\u0430\u0441\u043F\u043E\u0437\u043D\u0430\u0432\u0430\u043D\u0438\u044F \u043B\u0438\u0446\u0430\u2026");
    });
  }
  var MODEL_URL;
  var init_primerka_ochkov = __esm({
    "src/js/pages/primerka-ochkov.js"() {
      MODEL_URL = "assets/vendor/face-api";
    }
  });

  // src/js/pages/product.js
  function pdpInitials(name) {
    return name.split(" ").map((w) => w[0]).join("").slice(0, 2);
  }
  function initProduct({ color: PDP_COLOR, availability: AVAILABILITY, images }) {
    const PRODUCT = {
      name: "\u0421\u043E\u043B\u043D\u0446\u0435\u0437\u0430\u0449\u0438\u0442\u043D\u044B\u0435 \u0434\u0435\u0442\u0441\u043A\u0438\u0435 \u043E\u0447\u043A\u0438 Barbie SB-166",
      images,
      colors: [
        { key: "orange", name: "\u041E\u0440\u0430\u043D\u0436\u0435\u0432\u044B\u0439", hex: "#FF7A1A", page: "product.php" },
        { key: "pink", name: "\u0420\u043E\u0437\u043E\u0432\u044B\u0439", hex: "#FF5C97", page: "product-pink.php" },
        { key: "purple", name: "\u0424\u0438\u043E\u043B\u0435\u0442\u043E\u0432\u044B\u0439", hex: "#9B5CF6", page: "product-purple.php" }
      ],
      price: 1200,
      rating: 4
    };
    const pdpMainImg = document.getElementById("pdpMainImg");
    const pdpMainPhotoLink = document.getElementById("pdpMainPhotoLink");
    const pdpThumbs = document.getElementById("pdpThumbs");
    let pdpCurrentImageIndex = 0;
    pdpMainImg.src = PRODUCT.images[0];
    pdpMainPhotoLink.href = PRODUCT.images[0];
    if (PRODUCT.images.length > 1) {
      pdpThumbs.innerHTML = PRODUCT.images.map((src, i) => `
      <button class="pdp-thumb${i === 0 ? " is-active" : ""}" data-i="${i}" aria-label="\u0424\u043E\u0442\u043E ${i + 1}"><img src="${src}" alt=""></button>
    `).join("");
    } else {
      pdpThumbs.remove();
    }
    pdpThumbs.querySelectorAll(".pdp-thumb").forEach((btn) => btn.addEventListener("click", () => {
      pdpThumbs.querySelectorAll(".pdp-thumb").forEach((b) => b.classList.remove("is-active"));
      btn.classList.add("is-active");
      pdpCurrentImageIndex = Number(btn.dataset.i);
      const src = PRODUCT.images[pdpCurrentImageIndex];
      pdpMainImg.src = src;
      pdpMainPhotoLink.href = src;
    }));
    pdpMainPhotoLink.addEventListener("click", (e) => {
      if (!window.Fancybox) return;
      e.preventDefault();
      Fancybox.show(PRODUCT.images.map((src) => ({ src, type: "image" })), { startIndex: pdpCurrentImageIndex });
    });
    const pdpSwatches = document.getElementById("pdpSwatches");
    pdpSwatches.innerHTML = PRODUCT.colors.map((c) => `
    <a href="${c.page}" class="pdp-swatch${c.key === PDP_COLOR ? " is-active" : ""}" style="background:${c.hex}" aria-label="${c.name}" title="${c.name}"></a>
  `).join("");
    document.getElementById("pdpStars").innerHTML = starsRow(PRODUCT.rating);
    function renderAvailability() {
      const el = document.getElementById("pdpAvail");
      const buyRow = document.getElementById("pdpBuyRow");
      const buyNow = document.getElementById("pdpBuyNow");
      const checkRow = document.getElementById("pdpCheckRow");
      if (AVAILABILITY === "in_stock") {
        el.className = "pdp-avail is-in-stock";
        el.innerHTML = '<span class="dot"></span>\u0412 \u043D\u0430\u043B\u0438\u0447\u0438\u0438';
        buyRow.style.display = "";
        buyNow.style.display = "";
        checkRow.style.display = "none";
      } else if (AVAILABILITY === "out_of_stock") {
        el.className = "pdp-avail is-out";
        el.innerHTML = '<span class="dot"></span>\u041D\u0435\u0442 \u0432 \u043D\u0430\u043B\u0438\u0447\u0438\u0438';
        buyRow.style.display = "none";
        buyNow.style.display = "none";
        checkRow.style.display = "none";
      } else {
        el.className = "pdp-avail is-check";
        el.innerHTML = '<span class="dot"></span>\u0423\u0442\u043E\u0447\u043D\u0438\u0442\u0435 \u043D\u0430\u043B\u0438\u0447\u0438\u0435';
        buyRow.style.display = "none";
        buyNow.style.display = "none";
        checkRow.style.display = "";
      }
    }
    renderAvailability();
    document.getElementById("pdpCheckAvailBtn").addEventListener("click", () => {
      openModal(document.getElementById("checkAvailModal"));
    });
    let pdpQty = 1;
    const pdpQtyEl = document.getElementById("pdpQty");
    document.querySelector('[data-qty="inc"]').addEventListener("click", () => {
      pdpQty++;
      pdpQtyEl.textContent = pdpQty;
    });
    document.querySelector('[data-qty="dec"]').addEventListener("click", () => {
      pdpQty = Math.max(1, pdpQty - 1);
      pdpQtyEl.textContent = pdpQty;
    });
    document.getElementById("pdpAddCart").addEventListener("click", () => {
      const existing = CART.find((p) => p.name === PRODUCT.name);
      if (existing) existing.qty += pdpQty;
      else CART.push({ id: Date.now(), name: PRODUCT.name, price: PRODUCT.price, img: pdpMainImg.src, qty: pdpQty });
      renderCart();
      openModal(document.getElementById("addToCartModal"));
    });
    document.getElementById("pdpBuyNow").addEventListener("click", () => {
      document.getElementById("buyNowProductName").textContent = PRODUCT.name;
      openModal(document.getElementById("buyNowModal"));
    });
    function wireFavBtn(btn) {
      btn.addEventListener("click", () => {
        const isFav = btn.classList.toggle("is-active");
        document.querySelectorAll(".pdp-fav-btn").forEach((b) => b.classList.toggle("is-active", isFav));
        if (isFav) {
          if (!FAVORITES.find((p) => p.name === PRODUCT.name)) FAVORITES.push({ id: Date.now(), name: PRODUCT.name, price: PRODUCT.price, img: pdpMainImg.src });
        } else {
          FAVORITES.splice(0, FAVORITES.length, ...FAVORITES.filter((p) => p.name !== PRODUCT.name));
        }
        renderFav();
      });
    }
    wireFavBtn(document.getElementById("pdpFavBtn"));
    wireFavBtn(document.getElementById("pdpCheckFavBtn"));
    document.querySelectorAll("#pdpTabs .tab-btn").forEach((btn) => {
      btn.addEventListener("click", () => {
        document.querySelectorAll("#pdpTabs .tab-btn").forEach((b) => b.setAttribute("aria-selected", "false"));
        btn.setAttribute("aria-selected", "true");
        document.querySelectorAll(".pdp-tab-panel").forEach((p) => p.classList.toggle("is-active", p.dataset.panel === btn.dataset.tab));
      });
    });
    if (AVAILABILITY === "out_of_stock") {
      document.getElementById("pdpReviewList").innerHTML = `
      <p class="drawer-empty" style="padding:20px 0">\u041E\u0442\u0437\u044B\u0432\u043E\u0432 \u043F\u043E\u043A\u0430 \u043D\u0435\u0442. \u0421\u0442\u0430\u043D\u044C\u0442\u0435 \u043F\u0435\u0440\u0432\u044B\u043C, \u043A\u0442\u043E \u043E\u0441\u0442\u0430\u0432\u0438\u0442 \u043E\u0442\u0437\u044B\u0432 \u043E\u0431 \u044D\u0442\u043E\u043C \u0442\u043E\u0432\u0430\u0440\u0435!</p>`;
      document.getElementById("pdpReviewsSummary").textContent = "\u041F\u043E\u043A\u0430 \u043D\u0435\u0442 \u043E\u0446\u0435\u043D\u043E\u043A";
    } else {
      document.getElementById("pdpReviewList").innerHTML = PRODUCT_REVIEWS.map((r) => `
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
    `).join("");
    }
    document.getElementById("pdpWriteReview").addEventListener("click", () => openModal(document.getElementById("writeReviewModal")));
    let reviewStarValue = 5;
    const starPicker = document.getElementById("reviewStarPicker");
    function updateStarPicker() {
      starPicker.querySelectorAll("button").forEach((b) => b.classList.toggle("is-filled", Number(b.dataset.star) <= reviewStarValue));
    }
    starPicker.querySelectorAll("button").forEach((b) => b.addEventListener("click", () => {
      reviewStarValue = Number(b.dataset.star);
      updateStarPicker();
    }));
    updateStarPicker();
    function pdpMiniCardHTML(p) {
      return `
      <div class="product-card">
        <div class="product-media"><img src="${p.img}" alt="${p.name}"></div>
        <div class="product-name">${p.name}</div>
        <div class="product-price-row"><span class="product-price">${p.price.toLocaleString("ru-RU")} \u20BD</span></div>
        <div class="product-actions">
          <button class="btn btn-primary product-icon-btn" data-add-to-cart data-name="${p.name}" data-price="${p.price}" data-img="${p.img}" title="\u0412 \u043A\u043E\u0440\u0437\u0438\u043D\u0443" aria-label="\u0412 \u043A\u043E\u0440\u0437\u0438\u043D\u0443"><svg class="icon"><use href="#i-cart"/></svg></button>
          <button class="btn btn-outline product-icon-btn" data-buy-now data-name="${p.name}" title="\u041A\u0443\u043F\u0438\u0442\u044C \u0432 \u043E\u0434\u0438\u043D \u043A\u043B\u0438\u043A" aria-label="\u041A\u0443\u043F\u0438\u0442\u044C \u0432 \u043E\u0434\u0438\u043D \u043A\u043B\u0438\u043A"><svg class="icon"><use href="#i-bolt"/></svg></button>
        </div>
      </div>`;
    }
    function buildPdpSlider(items, prefix) {
      const track = document.getElementById(prefix + "Track");
      const dotsWrap = document.getElementById(prefix + "Dots");
      const prevBtn = document.getElementById(prefix + "ArrowPrev");
      const nextBtn = document.getElementById(prefix + "ArrowNext");
      track.innerHTML = items.map(pdpMiniCardHTML).join("");
      track.addEventListener("click", (e) => {
        const cartBtn = e.target.closest("[data-add-to-cart]");
        if (cartBtn) {
          const existing = CART.find((p) => p.name === cartBtn.dataset.name);
          if (existing) existing.qty++;
          else CART.push({ id: Date.now(), name: cartBtn.dataset.name, price: Number(cartBtn.dataset.price), img: cartBtn.dataset.img, qty: 1 });
          renderCart();
          openModal(document.getElementById("addToCartModal"));
          return;
        }
        const buyBtn = e.target.closest("[data-buy-now]");
        if (buyBtn) {
          document.getElementById("buyNowProductName").textContent = buyBtn.dataset.name;
          openModal(document.getElementById("buyNowModal"));
        }
      });
      const slider = makeSlider(track, dotsWrap, prevBtn, nextBtn, 18);
      slider.buildDots(items.length);
      makeDraggable(track);
    }
    function repeatItems(name, price, img, count) {
      return Array.from({ length: count }).map((_, i) => ({ name: `${name} ${i + 1}`, price, img }));
    }
    const PROMO_SLIDES = [
      { img: "assets/img/promo/aktsii-card1.jpg", alt: "\u0414\u043E -70% \u043D\u0430 \u0441\u043E\u043B\u043D\u0446\u0435\u0437\u0430\u0449\u0438\u0442\u043D\u044B\u0435 \u043E\u0447\u043A\u0438" },
      { img: "assets/img/promo/slide2.jpg", alt: "\u041B\u0435\u0442\u043E \u0433\u043B\u0430\u0437\u0430\u043C\u0438 \u0434\u0435\u0442\u0435\u0439: \u0440\u0438\u0441\u0443\u0439 \u0438 \u0432\u044B\u0438\u0433\u0440\u044B\u0432\u0430\u0439!" },
      { img: "assets/img/promo/slide3.jpg", alt: "\u0410\u043D\u0434\u0440\u0435\u0435\u0432\u044B \u0434\u043D\u0438 \u0432 Lokamed" },
      { img: "assets/img/promo/slide4.jpg", alt: "\u0421\u043F\u0435\u0446\u043F\u0440\u0435\u0434\u043B\u043E\u0436\u0435\u043D\u0438\u044F \u0432 \u043E\u043F\u0442\u0438\u043A\u0435 \u0410\u043D\u0434\u0440\u0435\u0435\u0432\u043A\u0430" },
      { img: "assets/img/promo/slide5.jpg", alt: "\u041F\u0435\u0440\u0432\u044B\u0435 \u043E\u0447\u043A\u0438 \u0441\u043E \u0441\u043A\u0438\u0434\u043A\u043E\u0439" },
      { img: "assets/img/promo/slide6.jpg", alt: "\u041E\u043F\u0440\u0430\u0432\u0430 \u0432 \u043F\u043E\u0434\u0430\u0440\u043E\u043A" },
      { img: "assets/img/promo/slide7.jpg", alt: "\u041E\u043F\u0442\u043E\u043C\u0435\u0442\u0440\u0438\u0441\u0442" },
      { img: "assets/img/promo/slide8.jpg", alt: "\u0418\u0437\u0433\u043E\u0442\u043E\u0432\u043B\u0435\u043D\u0438\u0435 \u043E\u0447\u043A\u043E\u0432 1 \u0447\u0430\u0441" }
    ];
    const promoTrack = document.getElementById("promoTrack");
    const promoSlider = makeSlider(promoTrack, document.getElementById("promoDots"), document.getElementById("promoArrowPrev"), document.getElementById("promoArrowNext"), 16);
    whenVisible(document.getElementById("pdpPromoSection"), () => {
      promoTrack.innerHTML = PROMO_SLIDES.map((s) => `
      <a href="promo.php" class="blog-card pdp-promo-slide"><div class="blog-media"><img src="${s.img}" alt="${s.alt}"></div></a>
    `).join("");
      promoSlider.buildDots(PROMO_SLIDES.length);
    });
    makeDraggable(promoTrack);
    buildPdpSlider(repeatItems("\u0424\u0443\u0442\u043B\u044F\u0440 \u0434\u043B\u044F \u043E\u0447\u043A\u043E\u0432", 650, "assets/img/catalog/access.jpg", 8), "case");
    buildPdpSlider(repeatItems("\u0421\u0430\u043B\u0444\u0435\u0442\u043A\u0430 \u0434\u043B\u044F \u043E\u0447\u043A\u043E\u0432", 180, "assets/img/product1.png", 8), "cloth");
    buildPdpSlider(repeatItems("\u0428\u043D\u0443\u0440\u043E\u043A \u0434\u043B\u044F \u043E\u0447\u043A\u043E\u0432", 350, "assets/img/product2.png", 8), "strap");
    buildPdpSlider(repeatItems("\u041E\u043F\u0440\u0430\u0432\u0430 \u0434\u043B\u044F \u043E\u0447\u043A\u043E\u0432 Lokamed", 5650, "assets/img/product3.png", 8), "similar");
  }
  var PRODUCT_REVIEWS;
  var init_product = __esm({
    "src/js/pages/product.js"() {
      init_shared();
      PRODUCT_REVIEWS = [
        { name: "\u0415\u043B\u0435\u043D\u0430 \u041A\u0440\u0430\u0432\u0446\u043E\u0432\u0430", bg: "var(--green-tint)", fg: "var(--green-dark)", rating: 5, date: "14.06.2026", text: "\u0414\u043E\u0447\u043A\u0430 \u0432 \u0432\u043E\u0441\u0442\u043E\u0440\u0433\u0435 \u043E\u0442 \u0446\u0432\u0435\u0442\u0430, \u043E\u043F\u0440\u0430\u0432\u0430 \u043B\u0451\u0433\u043A\u0430\u044F \u0438 \u0443\u0434\u043E\u0431\u043D\u043E \u0441\u0438\u0434\u0438\u0442. \u041D\u043E\u0441\u0438\u0442 \u0443\u0436\u0435 \u0432\u0442\u043E\u0440\u043E\u0439 \u043C\u0435\u0441\u044F\u0446 \u2014 \u043D\u0438 \u0446\u0430\u0440\u0430\u043F\u0438\u043D\u044B." },
        { name: "\u041C\u0430\u0440\u0438\u043D\u0430 \u0421\u043E\u043A\u043E\u043B\u043E\u0432\u0430", bg: "var(--blue-tint)", fg: "var(--blue)", rating: 4, date: "02.06.2026", text: "\u0425\u043E\u0440\u043E\u0448\u0435\u0435 \u043A\u0430\u0447\u0435\u0441\u0442\u0432\u043E \u0437\u0430 \u0441\u0432\u043E\u044E \u0446\u0435\u043D\u0443, \u043D\u043E \u043D\u043E\u0441\u043E\u0443\u043F\u043E\u0440\u044B \u043D\u0435\u043C\u043D\u043E\u0433\u043E \u0432\u0435\u043B\u0438\u043A\u043E\u0432\u0430\u0442\u044B \u0434\u043B\u044F \u0442\u0440\u0451\u0445\u043B\u0435\u0442\u043D\u0435\u0433\u043E \u0440\u0435\u0431\u0451\u043D\u043A\u0430 \u2014 \u043F\u0440\u0438\u0448\u043B\u043E\u0441\u044C \u043F\u043E\u0434\u043E\u0433\u043D\u0443\u0442\u044C." }
      ];
    }
  });

  // src/js/pages/index.js
  function initHomepage() {
    const heroTrack = document.getElementById("heroTrack");
    const heroSlides = heroTrack.children;
    const heroDots = document.getElementById("heroDots");
    let heroIndex = 0;
    function buildHeroDots() {
      heroDots.innerHTML = Array.from(heroSlides).map(
        (_, i) => `<button class="review-dot${i === 0 ? " is-active" : ""}" data-i="${i}" aria-label="\u0421\u043B\u0430\u0439\u0434 ${i + 1}"></button>`
      ).join("");
      heroDots.querySelectorAll(".review-dot").forEach((d) => d.addEventListener("click", () => {
        goToHero(Number(d.dataset.i));
        restartHeroAutoplay();
      }));
    }
    function goToHero(i) {
      heroIndex = (i + heroSlides.length) % heroSlides.length;
      heroTrack.style.transform = `translateX(-${heroIndex * 100}%)`;
      heroDots.querySelectorAll(".review-dot").forEach((d, idx) => d.classList.toggle("is-active", idx === heroIndex));
    }
    let heroTimer;
    function restartHeroAutoplay() {
      clearInterval(heroTimer);
      heroTimer = setInterval(() => goToHero(heroIndex + 1), 6e3);
    }
    document.getElementById("heroPrev").addEventListener("click", () => {
      goToHero(heroIndex - 1);
      restartHeroAutoplay();
    });
    document.getElementById("heroNext").addEventListener("click", () => {
      goToHero(heroIndex + 1);
      restartHeroAutoplay();
    });
    buildHeroDots();
    const heroSlider = document.querySelector(".hero-slider");
    let heroDown = false, heroStartX = 0, heroStartY = 0, heroBaseIndex = 0, heroDragDelta = 0, heroMoved = false, heroAxisLocked = null;
    function heroDragStart(x, y) {
      heroDown = true;
      heroMoved = false;
      heroAxisLocked = null;
      heroDragDelta = 0;
      heroBaseIndex = heroIndex;
      heroStartX = x;
      heroStartY = y;
      heroTrack.style.transition = "none";
      heroSlider.classList.add("is-dragging");
      clearInterval(heroTimer);
    }
    function heroDragMove(x, y) {
      if (!heroDown) return;
      heroDragDelta = x - heroStartX;
      if (heroAxisLocked === null && (Math.abs(heroDragDelta) > 5 || Math.abs(y - heroStartY) > 5)) {
        heroAxisLocked = Math.abs(heroDragDelta) > Math.abs(y - heroStartY) ? "x" : "y";
      }
      if (heroAxisLocked !== "x") return;
      heroMoved = true;
      const pct = heroDragDelta / heroTrack.getBoundingClientRect().width * 100;
      heroTrack.style.transform = `translateX(${-heroBaseIndex * 100 + pct}%)`;
    }
    function heroDragEnd() {
      if (!heroDown) return;
      heroDown = false;
      heroSlider.classList.remove("is-dragging");
      heroTrack.style.transition = "";
      if (heroAxisLocked === "x") {
        const threshold = heroTrack.getBoundingClientRect().width * 0.15;
        if (heroDragDelta <= -threshold) goToHero(heroBaseIndex + 1);
        else if (heroDragDelta >= threshold) goToHero(heroBaseIndex - 1);
        else goToHero(heroBaseIndex);
      }
      restartHeroAutoplay();
    }
    heroSlider.addEventListener("mousedown", (e) => {
      if (e.target.closest(".hero-arrow")) return;
      e.preventDefault();
      heroDragStart(e.pageX, e.pageY);
    });
    window.addEventListener("mousemove", (e) => heroDragMove(e.pageX, e.pageY));
    window.addEventListener("mouseup", heroDragEnd);
    heroSlider.addEventListener("touchstart", (e) => {
      if (e.target.closest(".hero-arrow")) return;
      const t = e.touches[0];
      heroDragStart(t.clientX, t.clientY);
    }, { passive: true });
    heroSlider.addEventListener("touchmove", (e) => {
      if (!heroDown) return;
      const t = e.touches[0];
      heroDragMove(t.clientX, t.clientY);
      if (heroAxisLocked === "x" && e.cancelable) e.preventDefault();
    }, { passive: false });
    heroSlider.addEventListener("touchend", heroDragEnd);
    heroSlider.addEventListener("touchcancel", heroDragEnd);
    heroSlider.addEventListener("click", (e) => {
      if (heroMoved) {
        e.preventDefault();
        e.stopPropagation();
        heroMoved = false;
      }
    }, true);
    whenVisible(document.querySelector(".hero"), restartHeroAutoplay);
    const PRODUCTS = {
      hits: [
        { name: "\u041E\u043F\u0440\u0430\u0432\u0430 \u0434\u043B\u044F \u043E\u0447\u043A\u043E\u0432 Lokamed 34133 C6-2", price: 5650, old: null, img: "assets/img/product1.png", badge: "\u0425\u0418\u0422", rating: 5, reviews: 18 },
        { name: "\u041E\u043F\u0440\u0430\u0432\u0430 \u0434\u043B\u044F \u043E\u0447\u043A\u043E\u0432 Lokamed 37059 C9", price: 5650, old: null, img: "assets/img/product2.png", badge: "\u0425\u0418\u0422", rating: 4, reviews: 11 },
        { name: "\u041E\u043F\u0440\u0430\u0432\u0430 \u0434\u043B\u044F \u043E\u0447\u043A\u043E\u0432 Lokamed 34132 C6-1", price: 5650, old: null, img: "assets/img/product3.png", badge: "\u0425\u0418\u0422", rating: 5, reviews: 23 },
        { name: "\u041E\u043F\u0440\u0430\u0432\u0430 \u0434\u043B\u044F \u043E\u0447\u043A\u043E\u0432 Lokamed 34125 C2", price: 5650, old: null, img: "assets/img/product4.png", badge: "\u0425\u0418\u0422", rating: 5, reviews: 9 }
      ],
      new: [
        { name: "\u041E\u043F\u0440\u0430\u0432\u0430 \u0434\u043B\u044F \u043E\u0447\u043A\u043E\u0432 Lokamed 34125 C2", price: 5650, old: null, img: "assets/img/product4.png", badge: "NEW", rating: 0, reviews: 0 },
        { name: "\u041E\u043F\u0440\u0430\u0432\u0430 \u0434\u043B\u044F \u043E\u0447\u043A\u043E\u0432 Lokamed 34133 C6-2", price: 5650, old: null, img: "assets/img/product1.png", badge: "NEW", rating: 0, reviews: 0 },
        { name: "\u041E\u043F\u0440\u0430\u0432\u0430 \u0434\u043B\u044F \u043E\u0447\u043A\u043E\u0432 Lokamed 34132 C6-1", price: 5650, old: null, img: "assets/img/product3.png", badge: "NEW", rating: 0, reviews: 0 },
        { name: "\u041E\u043F\u0440\u0430\u0432\u0430 \u0434\u043B\u044F \u043E\u0447\u043A\u043E\u0432 Lokamed 37059 C9", price: 5650, old: null, img: "assets/img/product2.png", badge: "NEW", rating: 0, reviews: 0 }
      ],
      sale: [
        { name: "\u041E\u043F\u0440\u0430\u0432\u0430 \u0434\u043B\u044F \u043E\u0447\u043A\u043E\u0432 Lokamed 37059 C9", price: 5650, old: 6650, img: "assets/img/product2.png", badge: "-15%", rating: 4, reviews: 11 },
        { name: "\u041E\u043F\u0440\u0430\u0432\u0430 \u0434\u043B\u044F \u043E\u0447\u043A\u043E\u0432 Lokamed 34132 C6-1", price: 5650, old: 6650, img: "assets/img/product3.png", badge: "-15%", rating: 5, reviews: 23 },
        { name: "\u041E\u043F\u0440\u0430\u0432\u0430 \u0434\u043B\u044F \u043E\u0447\u043A\u043E\u0432 Lokamed 34125 C2", price: 5650, old: 6650, img: "assets/img/product4.png", badge: "-15%", rating: 5, reviews: 9 },
        { name: "\u041E\u043F\u0440\u0430\u0432\u0430 \u0434\u043B\u044F \u043E\u0447\u043A\u043E\u0432 Lokamed 34133 C6-2", price: 5650, old: 6650, img: "assets/img/product1.png", badge: "-15%", rating: 5, reviews: 18 }
      ]
    };
    const productTrack = document.getElementById("productTrack");
    const productSlider = makeSlider(productTrack, document.getElementById("productDots"), document.getElementById("prodPrev"), document.getElementById("prodNext"), 18);
    function renderProducts(key) {
      const items = [...PRODUCTS[key], ...PRODUCTS[key]];
      productTrack.innerHTML = items.map((p) => `
      <div class="product-card">
        <span class="product-badge">${p.badge}</span>
        <button class="product-wish" aria-label="\u0412 \u0438\u0437\u0431\u0440\u0430\u043D\u043D\u043E\u0435"><svg class="icon" style="width:16px;height:16px"><use href="#i-heart"/></svg></button>
        <a href="product.php"><div class="product-media"><img src="${p.img}" alt="${p.name}"></div></a>
        <div class="product-avail"><span class="dot"></span>\u0412 \u043D\u0430\u043B\u0438\u0447\u0438\u0438</div>
        <a href="product.php" class="product-name" style="display:block">${p.name}</a>
        <div class="product-stars">${starsRow(p.rating)}<span style="font-size:.76rem;color:var(--ink-faint);margin-left:4px">${p.reviews ? "(" + p.reviews + ")" : "\u043D\u0435\u0442 \u043E\u0442\u0437\u044B\u0432\u043E\u0432"}</span></div>
        <div class="product-price-row">
          <span class="product-price">${p.price.toLocaleString("ru-RU")} \u20BD</span>
          ${p.old ? `<span class="product-price-old">${p.old.toLocaleString("ru-RU")} \u20BD</span>` : ""}
        </div>
        <div class="product-actions">
          <button class="btn btn-primary product-icon-btn" data-add-to-cart data-name="${p.name}" data-price="${p.price}" data-img="${p.img}" title="\u0412 \u043A\u043E\u0440\u0437\u0438\u043D\u0443" aria-label="\u0412 \u043A\u043E\u0440\u0437\u0438\u043D\u0443">
            <svg class="icon"><use href="#i-cart"/></svg>
          </button>
          <button class="btn btn-outline product-icon-btn" data-buy-now data-name="${p.name}" data-price="${p.price}" data-img="${p.img}" title="\u041A\u0443\u043F\u0438\u0442\u044C \u0432 \u043E\u0434\u0438\u043D \u043A\u043B\u0438\u043A" aria-label="\u041A\u0443\u043F\u0438\u0442\u044C \u0432 \u043E\u0434\u0438\u043D \u043A\u043B\u0438\u043A">
            <svg class="icon"><use href="#i-bolt"/></svg>
          </button>
        </div>
      </div>
    `).join("");
      productTrack.scrollTo({ left: 0 });
      productSlider.buildDots(items.length);
    }
    productTrack.addEventListener("click", (e) => {
      const cartBtn = e.target.closest("[data-add-to-cart]");
      if (cartBtn) {
        const id = Number(cartBtn.dataset.img.match(/(\d+)/)[1]);
        const existing = CART.find((p) => p.id === id);
        if (existing) existing.qty++;
        else CART.push({ id, name: cartBtn.dataset.name, price: Number(cartBtn.dataset.price), img: cartBtn.dataset.img, qty: 1 });
        renderCart();
        openModal(document.getElementById("addToCartModal"));
        return;
      }
      const buyBtn = e.target.closest("[data-buy-now]");
      if (buyBtn) {
        document.getElementById("buyNowProductName").textContent = buyBtn.dataset.name;
        openModal(document.getElementById("buyNowModal"));
      }
    });
    whenVisible(document.getElementById("products"), () => renderProducts("hits"));
    document.querySelectorAll(".tab-btn").forEach((btn) => {
      btn.addEventListener("click", () => {
        document.querySelectorAll(".tab-btn").forEach((b) => b.setAttribute("aria-selected", "false"));
        btn.setAttribute("aria-selected", "true");
        renderProducts(btn.dataset.tab);
      });
    });
    const REVIEWS = [
      { name: "\u041C\u0430\u0440\u0438\u043D\u0430 \u0421\u043E\u043A\u043E\u043B\u043E\u0432\u0430", meta: "\u0421\u0430\u043B\u043E\u043D \u0432 \u0417\u0435\u043B\u0435\u043D\u043E\u0433\u0440\u0430\u0434\u0435", rating: 5, text: "\u041E\u0447\u0435\u043D\u044C \u0434\u043E\u0432\u043E\u043B\u044C\u043D\u0430 \u0432\u044B\u0431\u043E\u0440\u043E\u043C \u043E\u043F\u0440\u0430\u0432 \u0438 \u0432\u043D\u0438\u043C\u0430\u043D\u0438\u0435\u043C \u043C\u0430\u0441\u0442\u0435\u0440\u043E\u0432. \u041F\u043E\u0434\u043E\u0431\u0440\u0430\u043B\u0438 \u043B\u0438\u043D\u0437\u044B \u0437\u0430 \u043E\u0434\u0438\u043D \u0432\u0438\u0437\u0438\u0442, \u0432\u0441\u0451 \u043E\u0431\u044A\u044F\u0441\u043D\u0438\u043B\u0438 \u043F\u0440\u043E\u0441\u0442\u044B\u043C\u0438 \u0441\u043B\u043E\u0432\u0430\u043C\u0438, \u043F\u043E\u043A\u0430\u0437\u0430\u043B\u0438 \u043D\u0435\u0441\u043A\u043E\u043B\u044C\u043A\u043E \u0432\u0430\u0440\u0438\u0430\u043D\u0442\u043E\u0432 \u043E\u043F\u0440\u0430\u0432 \u043F\u043E\u0434 \u0444\u043E\u0440\u043C\u0443 \u043B\u0438\u0446\u0430 \u0438 \u0431\u044E\u0434\u0436\u0435\u0442, \u0430 \u043F\u043E\u0441\u043B\u0435 \u0443\u0441\u0442\u0430\u043D\u043E\u0432\u043A\u0438 \u043B\u0438\u043D\u0437 \u0435\u0449\u0451 \u0440\u0430\u0437 \u0431\u0435\u0441\u043F\u043B\u0430\u0442\u043D\u043E \u043F\u0440\u043E\u0432\u0435\u0440\u0438\u043B\u0438 \u043F\u043E\u0441\u0430\u0434\u043A\u0443 \u2014 \u043E\u0447\u0435\u043D\u044C \u0432\u043D\u0438\u043C\u0430\u0442\u0435\u043B\u044C\u043D\u043E\u0435 \u043E\u0442\u043D\u043E\u0448\u0435\u043D\u0438\u0435, \u043E\u0431\u044F\u0437\u0430\u0442\u0435\u043B\u044C\u043D\u043E \u043F\u0440\u0438\u0434\u0443 \u0441\u043D\u043E\u0432\u0430.", bg: "var(--green-tint)", fg: "var(--green-dark)" },
      { name: "\u0414\u043C\u0438\u0442\u0440\u0438\u0439 \u0412\u043E\u043B\u043A\u043E\u0432", meta: "\u0421\u0430\u043B\u043E\u043D \u0432 \u041E\u0434\u0438\u043D\u0446\u043E\u0432\u043E", rating: 5, text: "\u0411\u044B\u0441\u0442\u0440\u043E, \u0432\u0435\u0436\u043B\u0438\u0432\u043E, \u0431\u0435\u0437 \u043D\u0430\u0432\u044F\u0437\u044B\u0432\u0430\u043D\u0438\u044F \u043B\u0438\u0448\u043D\u0435\u0433\u043E. \u0417\u0430\u043A\u0430\u0437 \u043F\u0440\u0438\u0448\u0451\u043B \u043D\u0430 \u0441\u043B\u0435\u0434\u0443\u044E\u0449\u0438\u0439 \u0434\u0435\u043D\u044C \u043F\u043E\u0441\u043B\u0435 \u043F\u0440\u0438\u043C\u0435\u0440\u043A\u0438.", bg: "var(--blue-tint)", fg: "var(--blue)" },
      { name: "\u0415\u043B\u0435\u043D\u0430 \u041A\u0440\u0430\u0432\u0446\u043E\u0432\u0430", meta: "\u0421\u0430\u043B\u043E\u043D \u0432 \u0421\u043E\u043B\u043D\u0435\u0447\u043D\u043E\u0433\u043E\u0440\u0441\u043A\u0435", rating: 4, text: "\u0425\u043E\u0440\u043E\u0448\u0438\u0439 \u0430\u0441\u0441\u043E\u0440\u0442\u0438\u043C\u0435\u043D\u0442 \u0441\u043E\u043B\u043D\u0446\u0435\u0437\u0430\u0449\u0438\u0442\u043D\u044B\u0445 \u043E\u0447\u043A\u043E\u0432 \u0438 \u043F\u0440\u0438\u044F\u0442\u043D\u044B\u0435 \u0446\u0435\u043D\u044B \u043D\u0430 \u0430\u043A\u0446\u0438\u0438.", bg: "var(--green-tint)", fg: "var(--green-dark)" },
      { name: "\u0410\u0440\u0442\u0451\u043C \u0411\u0435\u043B\u043E\u0432", meta: "\u0421\u0430\u043B\u043E\u043D \u0432 \u0417\u0435\u043B\u0435\u043D\u043E\u0433\u0440\u0430\u0434\u0435", rating: 5, text: "\u041F\u0440\u043E\u0432\u0435\u0440\u0438\u043B\u0438 \u0437\u0440\u0435\u043D\u0438\u0435 \u0431\u0435\u0441\u043F\u043B\u0430\u0442\u043D\u043E \u0438 \u0441\u0440\u0430\u0437\u0443 \u043F\u043E\u0434\u043E\u0431\u0440\u0430\u043B\u0438 \u043A\u043E\u043D\u0442\u0430\u043A\u0442\u043D\u044B\u0435 \u043B\u0438\u043D\u0437\u044B \u043F\u043E\u0434 \u043C\u043E\u0439 \u0433\u0440\u0430\u0444\u0438\u043A \u043D\u043E\u0448\u0435\u043D\u0438\u044F \u2014 \u0440\u0430\u043D\u044C\u0448\u0435 \u043D\u043E\u0441\u0438\u043B \u043E\u0447\u043A\u0438 \u0438 \u043F\u043E\u0441\u0442\u043E\u044F\u043D\u043D\u043E \u0437\u0430\u0431\u044B\u0432\u0430\u043B \u0438\u0445 \u0434\u043E\u043C\u0430, \u0430 \u0442\u0443\u0442 \u0437\u0430 \u043E\u0434\u0438\u043D \u0432\u0438\u0437\u0438\u0442 \u043F\u043E\u0434\u043E\u0431\u0440\u0430\u043B\u0438 \u0438\u043C\u0435\u043D\u043D\u043E \u0442\u043E, \u0447\u0442\u043E \u043D\u0443\u0436\u043D\u043E, \u043E\u0431\u044A\u044F\u0441\u043D\u0438\u043B\u0438 \u043A\u0430\u043A \u0443\u0445\u0430\u0436\u0438\u0432\u0430\u0442\u044C \u0437\u0430 \u043B\u0438\u043D\u0437\u0430\u043C\u0438 \u0438 \u0437\u0430\u043F\u0438\u0441\u0430\u043B\u0438 \u043D\u0430 \u0431\u0435\u0441\u043F\u043B\u0430\u0442\u043D\u0443\u044E \u043F\u043E\u0432\u0442\u043E\u0440\u043D\u0443\u044E \u043A\u043E\u043D\u0441\u0443\u043B\u044C\u0442\u0430\u0446\u0438\u044E \u0447\u0435\u0440\u0435\u0437 \u043C\u0435\u0441\u044F\u0446.", bg: "var(--blue-tint)", fg: "var(--blue)" },
      { name: "\u041E\u043B\u044C\u0433\u0430 \u0422\u0438\u043C\u043E\u0444\u0435\u0435\u0432\u0430", meta: "\u041E\u043D\u043B\u0430\u0439\u043D-\u0437\u0430\u043A\u0430\u0437", rating: 5, text: "\u041D\u043E\u0448\u0443 \u043E\u0447\u043A\u0438 Lokamed \u0443\u0436\u0435 \u0442\u0440\u0435\u0442\u0438\u0439 \u0433\u043E\u0434 \u043F\u043E\u0434\u0440\u044F\u0434, \u043A\u0430\u0447\u0435\u0441\u0442\u0432\u043E \u0441\u0442\u0430\u0431\u0438\u043B\u044C\u043D\u043E \u0440\u0430\u0434\u0443\u0435\u0442.", bg: "var(--green-tint)", fg: "var(--green-dark)" },
      { name: "\u0418\u0433\u043E\u0440\u044C \u041F\u0440\u043E\u0445\u043E\u0440\u043E\u0432", meta: "\u0421\u0430\u043B\u043E\u043D \u0432 \u041E\u0434\u0438\u043D\u0446\u043E\u0432\u043E", rating: 4, text: "\u0423\u0434\u043E\u0431\u043D\u043E, \u0447\u0442\u043E \u0435\u0441\u0442\u044C \u0434\u043E\u0441\u0442\u0430\u0432\u043A\u0430 \u0438 \u043F\u0440\u0438\u043C\u0435\u0440\u043A\u0430 \u043D\u0430 \u0434\u043E\u043C\u0443, \u0441\u044D\u043A\u043E\u043D\u043E\u043C\u0438\u043B \u0432\u0440\u0435\u043C\u044F.", bg: "var(--blue-tint)", fg: "var(--blue)" }
    ];
    function initials(name) {
      return name.split(" ").map((w) => w[0]).join("").slice(0, 2);
    }
    const track = document.getElementById("reviewTrack");
    const reviewSlider = makeSlider(track, document.getElementById("reviewDots"), document.getElementById("revPrev"), document.getElementById("revNext"), 16);
    const REVIEW_LIMIT = 110;
    whenVisible(document.getElementById("reviews"), () => {
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
        <p class="review-text">${shown}${isLong ? `<span class="review-more">...</span>` : ""}</p>
      </div>
    `;
      }).join("");
      reviewSlider.buildDots(REVIEWS.length);
    });
    track.addEventListener("click", (e) => {
      const card = e.target.closest(".review-card");
      if (!card) return;
      const r = REVIEWS[Number(card.dataset.reviewIndex)];
      const top = document.getElementById("reviewModalTop");
      top.innerHTML = `
      <div class="review-avatar" style="background:${r.bg};color:${r.fg}">${initials(r.name)}</div>
      <div>
        <div class="review-name">${r.name}</div>
        <div class="review-meta">${r.meta}</div>
      </div>
    `;
      document.getElementById("reviewModalStars").innerHTML = starsRow(r.rating);
      document.getElementById("reviewModalText").textContent = r.text;
      openModal(document.getElementById("reviewModal"));
    });
    const HOME_BLOG_POSTS = [
      { img: "assets/img/blog1.png", tag: "\u041F\u043E\u043A\u0443\u043F\u0430\u0442\u0435\u043B\u044F\u043C", title: "\u041A\u0430\u043A \u043F\u043E\u0434\u043E\u0431\u0440\u0430\u0442\u044C \u043E\u0447\u043A\u0438: \u0447\u0442\u043E \u0434\u0435\u0439\u0441\u0442\u0432\u0438\u0442\u0435\u043B\u044C\u043D\u043E \u0432\u0430\u0436\u043D\u043E \u0443\u0447\u0438\u0442\u044B\u0432\u0430\u0442\u044C" },
      { img: "assets/img/blog2.png", tag: "\u041B\u0438\u043D\u0437\u044B", title: "\u041E\u0442 1.50 \u0434\u043E 1.74: \u043A\u0430\u043A \u0442\u043E\u043B\u0449\u0438\u043D\u0430 \u043B\u0438\u043D\u0437\u044B \u043C\u0435\u043D\u044F\u0435\u0442 \u043E\u0447\u043A\u0438" },
      { img: "assets/img/blog3.png", tag: "\u041B\u0438\u043D\u0437\u044B", title: "\u041A\u0430\u043A\u0438\u0435 \u0431\u044B\u0432\u0430\u044E\u0442 \u043F\u043E\u043A\u0440\u044B\u0442\u0438\u044F \u043D\u0430 \u043E\u0447\u043A\u043E\u0432\u044B\u0445 \u043B\u0438\u043D\u0437\u0430\u0445" },
      { img: "assets/img/blog4.png", tag: "\u041F\u043E\u043A\u0443\u043F\u0430\u0442\u0435\u043B\u044F\u043C", title: "\u041F\u043E\u0447\u0435\u043C\u0443 \u0432\u0430\u0436\u043D\u043E \u043F\u043E\u043A\u0443\u043F\u0430\u0442\u044C \u043E\u0447\u043A\u0438 \u0443 \u043F\u0440\u043E\u0444\u0435\u0441\u0441\u0438\u043E\u043D\u0430\u043B\u043E\u0432" },
      { img: "assets/img/blog5.png", tag: "\u0417\u0434\u043E\u0440\u043E\u0432\u044C\u0435 \u0433\u043B\u0430\u0437", title: "\u0421\u0438\u043D\u0434\u0440\u043E\u043C \u0441\u0443\u0445\u043E\u0433\u043E \u0433\u043B\u0430\u0437\u0430: \u043F\u043E\u0447\u0435\u043C\u0443 \u0441\u043E\u0445\u043D\u0443\u0442 \u0433\u043B\u0430\u0437\u0430" },
      { img: "assets/img/blog6.png", tag: "\u0417\u0434\u043E\u0440\u043E\u0432\u044C\u0435 \u0433\u043B\u0430\u0437", title: "\u0410\u0441\u0442\u0438\u0433\u043C\u0430\u0442\u0438\u0437\u043C: \u043F\u043E\u0447\u0435\u043C\u0443 \u0438\u0437\u043E\u0431\u0440\u0430\u0436\u0435\u043D\u0438\u0435 \u0440\u0430\u0437\u043C\u044B\u0442\u043E \u0438 \u043A\u0430\u043A \u044D\u0442\u043E \u0438\u0441\u043F\u0440\u0430\u0432\u0438\u0442\u044C" }
    ];
    const blogTrack = document.getElementById("blogTrack");
    const blogSlider = makeSlider(blogTrack, document.getElementById("blogDots"), document.getElementById("blogPrev"), document.getElementById("blogNext"), 16);
    whenVisible(document.getElementById("blog"), () => {
      blogTrack.innerHTML = HOME_BLOG_POSTS.map((p) => `
      <a href="blog-detail.php" class="blog-card">
        <div class="blog-media"><img src="${p.img}" alt=""></div>
        <span class="blog-tag">${p.tag}</span><h3>${p.title}</h3><span class="blog-read">\u0427\u0438\u0442\u0430\u0442\u044C <svg class="icon" style="width:14px;height:14px"><use href="#i-arrow-right"/></svg></span>
      </a>
    `).join("");
      blogSlider.buildDots(HOME_BLOG_POSTS.length);
    });
    [productTrack, track, blogTrack].forEach(makeDraggable);
  }
  var init_pages = __esm({
    "src/js/pages/index.js"() {
      init_shared();
    }
  });

  // src/js/pages/catalog-section.js
  function initCatalogSection() {
    const filterFab = document.getElementById("filterFab");
    const filterPanel = document.getElementById("filterPanel");
    const filterScrim = document.getElementById("filterScrim");
    function openFilter() {
      filterPanel.classList.add("is-open");
      filterScrim.classList.add("is-open");
      filterFab.classList.add("is-open");
      document.body.style.overflow = "hidden";
    }
    function closeFilter() {
      filterPanel.classList.remove("is-open");
      filterScrim.classList.remove("is-open");
      filterFab.classList.remove("is-open");
      document.body.style.overflow = "";
    }
    filterFab.addEventListener("click", () => {
      filterPanel.classList.contains("is-open") ? closeFilter() : openFilter();
    });
    document.getElementById("filterClose").addEventListener("click", closeFilter);
    filterScrim.addEventListener("click", closeFilter);
    document.addEventListener("keydown", (e) => {
      if (e.key === "Escape") closeFilter();
    });
    const FACETS = {
      gender: [
        { v: "kids", l: "\u0414\u0435\u0442\u0441\u043A\u0438\u0435" },
        { v: "women", l: "\u0416\u0435\u043D\u0441\u043A\u0438\u0435" },
        { v: "men", l: "\u041C\u0443\u0436\u0441\u043A\u0438\u0435" },
        { v: "unisex", l: "\u0423\u043D\u0438\u0441\u0435\u043A\u0441" }
      ],
      color: ["\u0411\u0435\u0436\u0435\u0432\u044B\u0439", "\u0411\u0435\u043B\u044B\u0439", "\u0411\u043E\u0440\u0434\u043E\u0432\u044B\u0439", "\u0413\u043E\u043B\u0443\u0431\u043E\u0439", "\u0416\u0435\u043B\u0442\u044B\u0439", "\u0417\u0435\u043B\u0451\u043D\u044B\u0439", "\u0417\u043E\u043B\u043E\u0442\u043E\u0439", "\u041A\u043E\u0440\u0438\u0447\u043D\u0435\u0432\u044B\u0439", "\u041A\u0440\u0430\u0441\u043D\u044B\u0439", "\u041E\u0440\u0430\u043D\u0436\u0435\u0432\u044B\u0439", "\u041F\u0440\u043E\u0437\u0440\u0430\u0447\u043D\u044B\u0439", "\u0420\u043E\u0437\u043E\u0432\u044B\u0439", "\u0421\u0435\u0440\u0435\u0431\u0440\u044F\u043D\u044B\u0439", "\u0421\u0435\u0440\u044B\u0439", "\u0421\u0438\u043D\u0438\u0439", "\u0424\u0438\u043E\u043B\u0435\u0442\u043E\u0432\u044B\u0439", "\u0427\u0451\u0440\u043D\u044B\u0439"].map((l) => ({ v: l, l })),
      shape: ["Wayfarer", "\u0410\u0432\u0438\u0430\u0442\u043E\u0440\u044B", "\u0411\u0430\u0431\u043E\u0447\u043A\u0438", "\u0413\u0435\u043E\u043C\u0435\u0442\u0440\u0438\u044F", "\u041A\u0432\u0430\u0434\u0440\u0430\u0442\u043D\u044B\u0435", "\u041A\u043B\u0430\u0441\u0441\u0438\u0447\u0435\u0441\u043A\u0438\u0435", "\u041A\u043E\u0448\u0430\u0447\u0438\u0439 \u0433\u043B\u0430\u0437", "\u041A\u0440\u0443\u0433\u043B\u044B\u0435", "\u041E\u0432\u0430\u043B\u044C\u043D\u044B\u0435", "\u041F\u0440\u044F\u043C\u043E\u0443\u0433\u043E\u043B\u044C\u043D\u044B\u0435"].map((l) => ({ v: l, l })),
      material: ["\u041F\u043B\u0430\u0441\u0442\u0438\u043A", "\u041C\u0435\u0442\u0430\u043B\u043B", "\u041A\u043E\u043C\u0431\u0438\u043D\u0438\u0440\u043E\u0432\u0430\u043D\u043D\u044B\u0439", "\u0414\u0435\u0440\u0435\u0432\u043E"].map((l) => ({ v: l, l })),
      brand: ["Ray Ban", "Carrera", "Hugo Boss", "Lacoste", "Nike", "Pierre Cardin", "Silhouette", "Vogue", "Tommy Hilfiger", "Givenchy", "Maxmara", "Polaroid", "Prada", "Armani", "Etro", "LIU JO", "Invu", "Ferelli", "Spring Time", "Sulz"].map((l) => ({ v: l, l }))
    };
    const FAQ_TAGS = ["Hugo Boss", "Lacoste", "Sulz", "\u0416\u0435\u043D\u0441\u043A\u0438\u0435", "Armani", "Ferelli", "Invu", "LIU JO", "Etro", "Spring Time"];
    const AVAIL_STATES = ["in_stock", "in_stock", "in_stock", "in_stock", "out_of_stock", "check"];
    const AVAIL_PAGE = { in_stock: "product.php", out_of_stock: "product-out-of-stock.php", check: "product-check-availability.php" };
    const AVAIL_LABEL = { in_stock: "\u0412 \u043D\u0430\u043B\u0438\u0447\u0438\u0438", out_of_stock: "\u041D\u0435\u0442 \u0432 \u043D\u0430\u043B\u0438\u0447\u0438\u0438", check: "\u0423\u0442\u043E\u0447\u043D\u0438\u0442\u0435 \u043D\u0430\u043B\u0438\u0447\u0438\u0435" };
    const CATALOG_PRODUCTS = (() => {
      const imgs = ["assets/img/product1.png", "assets/img/product2.png", "assets/img/product3.png", "assets/img/product4.png"];
      const skus = ["34133 C6-2", "37059 C9", "34132 C6-1", "34125 C2"];
      const items = [];
      for (let i = 0; i < 204; i++) {
        const ci = i % 4;
        const price = 1400 + i % 9 * 1650;
        items.push({
          id: i + 1,
          name: `\u041E\u043F\u0440\u0430\u0432\u0430 \u0434\u043B\u044F \u043E\u0447\u043A\u043E\u0432 Lokamed ${skus[ci]}`,
          price,
          old: i % 3 === 0 ? price + 900 : null,
          img: imgs[ci],
          badge: i % 5 === 0 ? "\u0425\u0418\u0422" : i % 5 === 1 ? "NEW" : "",
          rating: 3 + i % 3,
          reviews: i * 3 % 20,
          availability: AVAIL_STATES[i % AVAIL_STATES.length],
          gender: FACETS.gender[i % FACETS.gender.length].v,
          color: FACETS.color[i % FACETS.color.length].v,
          shape: FACETS.shape[i % FACETS.shape.length].v,
          material: FACETS.material[i % FACETS.material.length].v,
          brand: FACETS.brand[i % FACETS.brand.length].v
        });
      }
      return items;
    })();
    let perPage = 36;
    let catalogFiltered = CATALOG_PRODUCTS.slice();
    let catalogVisibleCount = perPage;
    let sortKey = null;
    let sortDir = { name: "asc", price: "asc" };
    function pluralGoods(n) {
      const mod10 = n % 10, mod100 = n % 100;
      if (mod10 === 1 && mod100 !== 11) return "\u0442\u043E\u0432\u0430\u0440";
      if ([2, 3, 4].includes(mod10) && ![12, 13, 14].includes(mod100)) return "\u0442\u043E\u0432\u0430\u0440\u0430";
      return "\u0442\u043E\u0432\u0430\u0440\u043E\u0432";
    }
    function catalogCardHTML(p) {
      const page = AVAIL_PAGE[p.availability];
      const availClass = p.availability === "in_stock" ? "is-in-stock" : p.availability === "out_of_stock" ? "is-out" : "is-check";
      const actions = p.availability === "in_stock" ? `<button class="btn btn-primary product-icon-btn" data-add-to-cart data-name="${p.name}" data-price="${p.price}" data-img="${p.img}" title="\u0412 \u043A\u043E\u0440\u0437\u0438\u043D\u0443" aria-label="\u0412 \u043A\u043E\u0440\u0437\u0438\u043D\u0443"><svg class="icon"><use href="#i-cart"/></svg></button>
         <button class="btn btn-outline product-icon-btn" data-buy-now data-name="${p.name}" data-price="${p.price}" data-img="${p.img}" title="\u041A\u0443\u043F\u0438\u0442\u044C \u0432 \u043E\u0434\u0438\u043D \u043A\u043B\u0438\u043A" aria-label="\u041A\u0443\u043F\u0438\u0442\u044C \u0432 \u043E\u0434\u0438\u043D \u043A\u043B\u0438\u043A"><svg class="icon"><use href="#i-bolt"/></svg></button>` : `<a href="${page}" class="btn btn-outline btn-block" style="font-size:.82rem">\u041F\u043E\u0434\u0440\u043E\u0431\u043D\u0435\u0435</a>`;
      return `
      <div class="product-card">
        ${p.badge ? `<span class="product-badge">${p.badge}</span>` : ""}
        <button class="product-wish" aria-label="\u0412 \u0438\u0437\u0431\u0440\u0430\u043D\u043D\u043E\u0435"><svg class="icon" style="width:16px;height:16px"><use href="#i-heart"/></svg></button>
        <a href="${page}"><div class="product-media"><img src="${p.img}" alt="${p.name}"></div></a>
        <div class="product-avail ${availClass}"><span class="dot"></span>${AVAIL_LABEL[p.availability]}</div>
        <a href="${page}" class="product-name" style="display:block">${p.name}</a>
        <div class="product-stars">${starsRow(p.rating)}<span style="font-size:.76rem;color:var(--ink-faint);margin-left:4px">${p.reviews ? "(" + p.reviews + ")" : "\u043D\u0435\u0442 \u043E\u0442\u0437\u044B\u0432\u043E\u0432"}</span></div>
        <div class="product-price-row">
          <span class="product-price">${p.price.toLocaleString("ru-RU")} \u20BD</span>
          ${p.old ? `<span class="product-price-old">${p.old.toLocaleString("ru-RU")} \u20BD</span>` : ""}
        </div>
        <div class="product-actions">${actions}</div>
      </div>`;
    }
    const catalogGrid = document.getElementById("catalogGrid");
    const catalogCount = document.getElementById("catalogCount");
    const showMoreBtn = document.getElementById("showMoreBtn");
    const paginationEl = document.getElementById("pagination");
    function renderCatalogGrid() {
      const shown = catalogFiltered.slice(0, catalogVisibleCount);
      catalogGrid.innerHTML = shown.length ? shown.map(catalogCardHTML).join("") : '<p style="grid-column:1/-1;color:var(--ink-faint);padding:50px 0;text-align:center">\u041D\u0438\u0447\u0435\u0433\u043E \u043D\u0435 \u043D\u0430\u0439\u0434\u0435\u043D\u043E \u043F\u043E\u0434 \u0432\u044B\u0431\u0440\u0430\u043D\u043D\u044B\u0435 \u0443\u0441\u043B\u043E\u0432\u0438\u044F</p>';
      catalogCount.textContent = `\u041D\u0430\u0439\u0434\u0435\u043D\u043E ${catalogFiltered.length} ${pluralGoods(catalogFiltered.length)}`;
      showMoreBtn.style.display = catalogVisibleCount >= catalogFiltered.length ? "none" : "";
      renderPagination();
    }
    function renderPagination() {
      const pageCount = Math.max(1, Math.ceil(catalogFiltered.length / perPage));
      const currentPage = Math.max(1, Math.ceil(catalogVisibleCount / perPage));
      paginationEl.innerHTML = pageCount <= 1 ? "" : Array.from({ length: pageCount }).map(
        (_, i) => `<button data-page="${i + 1}" class="${i + 1 === currentPage ? "is-active" : ""}">${i + 1}</button>`
      ).join("");
      paginationEl.querySelectorAll("button").forEach((btn) => btn.addEventListener("click", () => {
        catalogVisibleCount = Number(btn.dataset.page) * perPage;
        renderCatalogGrid();
        window.scrollTo({ top: document.querySelector(".catalog-head").offsetTop - 100, behavior: "smooth" });
      }));
    }
    function applySort() {
      if (!sortKey) return;
      const dir = sortDir[sortKey] === "asc" ? 1 : -1;
      catalogFiltered.sort((a, b) => {
        if (sortKey === "name") return a.name.localeCompare(b.name, "ru") * dir;
        return (a.price - b.price) * dir;
      });
    }
    function getCheckedValues(groupName) {
      return [...document.querySelectorAll(`.filter-group[data-group="${groupName}"] input[type=checkbox]:checked`)].map((i) => i.value);
    }
    function applyCatalogFilters() {
      const genders = getCheckedValues("gender");
      const colors = getCheckedValues("color");
      const shapes = getCheckedValues("shape");
      const materials = getCheckedValues("material");
      const brands = getCheckedValues("brand");
      const min = Number(document.getElementById("priceMinRange").value);
      const max = Number(document.getElementById("priceMaxRange").value);
      const lo = Math.min(min, max), hi = Math.max(min, max);
      const onlyStock = document.getElementById("onlyInStock").checked;
      catalogFiltered = CATALOG_PRODUCTS.filter(
        (p) => (!genders.length || genders.includes(p.gender)) && (!colors.length || colors.includes(p.color)) && (!shapes.length || shapes.includes(p.shape)) && (!materials.length || materials.includes(p.material)) && (!brands.length || brands.includes(p.brand)) && p.price >= lo && p.price <= hi && (!onlyStock || p.inStock)
      );
      applySort();
      catalogVisibleCount = perPage;
      renderCatalogGrid();
    }
    showMoreBtn.addEventListener("click", () => {
      catalogVisibleCount = Math.min(catalogFiltered.length, catalogVisibleCount + perPage);
      renderCatalogGrid();
    });
    catalogGrid.addEventListener("click", (e) => {
      const cartBtn = e.target.closest("[data-add-to-cart]");
      if (cartBtn) {
        const existing = CART.find((p) => p.name === cartBtn.dataset.name);
        if (existing) existing.qty++;
        else CART.push({ id: Date.now(), name: cartBtn.dataset.name, price: Number(cartBtn.dataset.price), img: cartBtn.dataset.img, qty: 1 });
        renderCart();
        openModal(document.getElementById("addToCartModal"));
        return;
      }
      const buyBtn = e.target.closest("[data-buy-now]");
      if (buyBtn) {
        document.getElementById("buyNowProductName").textContent = buyBtn.dataset.name;
        openModal(document.getElementById("buyNowModal"));
      }
    });
    const VISIBLE_LIMIT = 5;
    function buildFilterGroups() {
      document.querySelectorAll(".filter-group[data-group]").forEach((group) => {
        const key = group.dataset.group;
        const options = FACETS[key];
        const optionsWrap = group.querySelector(".filter-options");
        optionsWrap.innerHTML = options.map((o, i) => {
          const isPopular = FAQ_TAGS.includes(o.l);
          const isPlain = i % 5 === 4;
          const optionEl = isPlain ? `<span class="filter-check-link filter-check-plain">${o.l}</span>` : `<a href="#" class="filter-check-link${isPopular ? " is-highlighted" : ""}">${o.l}</a>`;
          return `
        <div class="filter-check" data-i="${i}">
          <input type="checkbox" id="filter-${key}-${i}" name="${key}" value="${o.v}">
          ${optionEl}
        </div>
      `;
        }).join("");
        optionsWrap.querySelectorAll("a.filter-check-link").forEach((link) => {
          link.addEventListener("click", (e) => {
            e.preventDefault();
            const cb = link.previousElementSibling;
            cb.checked = !cb.checked;
          });
        });
        if (options.length > VISIBLE_LIMIT) {
          const btn = document.createElement("button");
          btn.type = "button";
          btn.className = "filter-showmore-btn";
          group.appendChild(btn);
        }
        const search = group.querySelector(".filter-search");
        const checks = [...optionsWrap.querySelectorAll(".filter-check")];
        const showMore = group.querySelector(".filter-showmore-btn");
        let expanded = false;
        function refresh() {
          const q = search.value.trim().toLowerCase();
          checks.forEach((el, i) => {
            const matches = !q || el.textContent.toLowerCase().includes(q);
            const visible = q ? matches : expanded || i < VISIBLE_LIMIT;
            el.style.display = visible ? "" : "none";
          });
          if (showMore) {
            showMore.style.display = q ? "none" : "";
            showMore.textContent = expanded ? "\u0421\u0432\u0435\u0440\u043D\u0443\u0442\u044C" : `\u041F\u043E\u043A\u0430\u0437\u0430\u0442\u044C \u0435\u0449\u0451 (${options.length - VISIBLE_LIMIT})`;
          }
        }
        search.addEventListener("input", refresh);
        if (showMore) showMore.addEventListener("click", () => {
          expanded = !expanded;
          refresh();
        });
        refresh();
      });
    }
    buildFilterGroups();
    (function initPriceRange() {
      const minR = document.getElementById("priceMinRange");
      const maxR = document.getElementById("priceMaxRange");
      const fill = document.getElementById("priceFill");
      const minLabel = document.getElementById("priceMinLabel");
      const maxLabel = document.getElementById("priceMaxLabel");
      const minInput = document.getElementById("priceMinInput");
      const maxInput = document.getElementById("priceMaxInput");
      const min = Number(minR.min), max = Number(minR.max);
      function update() {
        let a = Number(minR.value), b = Number(maxR.value);
        if (a > b) {
          const t = a;
          a = b;
          b = t;
        }
        fill.style.left = (a - min) / (max - min) * 100 + "%";
        fill.style.width = (b - a) / (max - min) * 100 + "%";
        minLabel.textContent = Number(minR.value).toLocaleString("ru-RU") + " \u20BD";
        maxLabel.textContent = Number(maxR.value).toLocaleString("ru-RU") + " \u20BD";
        minInput.value = minR.value;
        maxInput.value = maxR.value;
      }
      minR.addEventListener("input", () => {
        if (Number(minR.value) > Number(maxR.value)) minR.value = maxR.value;
        update();
      });
      maxR.addEventListener("input", () => {
        if (Number(maxR.value) < Number(minR.value)) maxR.value = minR.value;
        update();
      });
      minInput.addEventListener("input", () => {
        let v = Math.min(max, Math.max(min, Number(minInput.value) || min));
        minR.value = Math.min(v, Number(maxR.value));
        update();
      });
      maxInput.addEventListener("input", () => {
        let v = Math.min(max, Math.max(min, Number(maxInput.value) || max));
        maxR.value = Math.max(v, Number(minR.value));
        update();
      });
      update();
    })();
    const tagPills = document.getElementById("tagPills");
    tagPills.innerHTML = FAQ_TAGS.map((t) => `<button type="button" class="tag-pill" data-tag="${t}">${t}</button>`).join("");
    tagPills.querySelectorAll(".tag-pill").forEach((btn) => {
      btn.addEventListener("click", () => {
        const tag = btn.dataset.tag;
        document.querySelectorAll(".tag-pill").forEach((b) => b.classList.toggle("is-active", b === btn && !b.classList.contains("is-active")));
        const active = btn.classList.contains("is-active");
        document.querySelectorAll("input[type=checkbox][name]").forEach((cb) => {
          cb.checked = false;
        });
        if (active) {
          const genderMatch = FACETS.gender.find((g) => g.l === tag);
          const brandMatch = FACETS.brand.find((b) => b.l === tag);
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
    function setSort(key) {
      if (sortKey === key) {
        sortDir[key] = sortDir[key] === "asc" ? "desc" : "asc";
      } else {
        sortKey = key;
      }
      document.getElementById("sortByName").classList.toggle("is-active", key === "name");
      document.getElementById("sortByPrice").classList.toggle("is-active", key === "price");
      document.getElementById("sortByName").classList.toggle("is-desc", key === "name" && sortDir.name === "desc");
      document.getElementById("sortByPrice").classList.toggle("is-desc", key === "price" && sortDir.price === "desc");
      applySort();
      catalogVisibleCount = perPage;
      renderCatalogGrid();
    }
    document.getElementById("sortByName").addEventListener("click", () => setSort("name"));
    document.getElementById("sortByPrice").addEventListener("click", () => setSort("price"));
    document.querySelectorAll(".per-page-row button").forEach((btn) => {
      btn.addEventListener("click", () => {
        document.querySelectorAll(".per-page-row button").forEach((b) => b.classList.remove("is-active"));
        btn.classList.add("is-active");
        perPage = Number(btn.dataset.per);
        catalogVisibleCount = perPage;
        renderCatalogGrid();
      });
    });
    document.getElementById("filterApply").addEventListener("click", () => {
      applyCatalogFilters();
      closeFilter();
    });
    document.getElementById("filterReset").addEventListener("click", () => {
      document.querySelectorAll(".filter-panel input[type=checkbox]").forEach((i) => i.checked = false);
      document.getElementById("priceMinRange").value = document.getElementById("priceMinRange").min;
      document.getElementById("priceMaxRange").value = document.getElementById("priceMaxRange").max;
      document.getElementById("priceMinRange").dispatchEvent(new Event("input"));
      document.querySelectorAll(".tag-pill").forEach((b) => b.classList.remove("is-active"));
      applyCatalogFilters();
    });
    renderCatalogGrid();
  }
  var init_catalog_section = __esm({
    "src/js/pages/catalog-section.js"() {
      init_shared();
    }
  });

  // src/js/main.js
  var require_main = __commonJS({
    "src/js/main.js"() {
      init_shared();
      init_salons();
      init_aktsii_grid();
      init_blog();
      init_vakansii();
      init_order();
      init_promo();
      init_otzyvy();
      init_o_kompanii();
      init_primerka_ochkov();
      init_product();
      init_pages();
      init_catalog_section();
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
        initCatalogSection
      };
    }
  });
  require_main();
})();
