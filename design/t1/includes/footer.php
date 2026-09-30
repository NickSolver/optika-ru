<?php
/**
 * Shared page shell (closing half): footer, drawers/modals, scripts, closing tags.
 * assets/js/bundle.js (built from src/js/ via `npm run build`) is always loaded -
 * it holds every page's behavior as a function on window.Bundle, but calls nothing
 * on its own. Expects (optional) variables set by the including page before this include:
 *   $vendorScripts  array   vendor <script src> paths (fancybox, face-api) to load before $inlineScript
 *   $inlineScript   string  raw inline JS: this page's own data + a window.Bundle.initX(...) call
 */
?>
<footer class="site" id="salons">
  <div class="container">
    <div class="footer-grid">
      <div class="footer-col">
        <h4>Покупателям</h4>
        <ul>
          <li><a href="uslugi.php">Услуги</a></li>
          <li><a href="aktsii.php" class="alarm-shake">Акции и скидки</a></li>
          <li><a href="salony.php">Салоны оптики</a></li>
          <li><a href="uslovia-pokupki.php">Условия покупки</a></li>
          <li><a href="o-kompanii.php">О компании</a></li>
          <li><a href="blog.php">Блог</a></li>
        </ul>
      </div>
      <div class="footer-col">
        <h4>Каталог товаров</h4>
        <ul>
          <li><a href="catalog-section.php">Оправы для очков</a></li>
          <li><a href="catalog-section.php">Солнцезащитные очки</a></li>
          <li><a href="catalog-section.php">Контактные линзы</a></li>
          <li><a href="catalog-section.php">Линзы для очков</a></li>
          <li><a href="catalog-section.php">Аксессуары</a></li>
          <li><a href="catalog-section.php">Подарочные сертификаты</a></li>
        </ul>
      </div>
      <div class="footer-col">
        <h4>Подписка на рассылку</h4>
        <form class="footer-form" id="newsletterForm">
          <input class="footer-input" type="email" placeholder="Ваш e-mail" required>
          <button class="btn btn-primary btn-sm" type="submit">Отправить</button>
        </form>
        <div class="newsletter-thanks" id="newsletterThanks">
          <div class="icon-wrap"><svg class="icon" style="width:18px;height:18px"><use href="#i-check"/></svg></div>
          <span>Спасибо! Вы подписаны на рассылку.</span>
        </div>
        <div class="footer-contact-item"><svg class="icon"><use href="#i-clock"/></svg>Ежедневно 10:00–21:00</div>
        <div class="footer-contact-item"><svg class="icon"><use href="#i-mail"/></svg><a href="mailto:info@optika-lokamed.ru">info@optika-lokamed.ru</a></div>
        <button class="btn btn-primary btn-sm" id="feedbackOpen" style="margin-top:12px">Обратная связь</button>
      </div>
      <div class="footer-col" id="contacts">
        <h4>Контактная информация</h4>
        <div class="footer-contact-item"><svg class="icon"><use href="#i-pin"/></svg><a href="zelenograd.php">Салоны оптики Зеленоград</a></div>
        <div class="footer-contact-item"><svg class="icon"><use href="#i-pin"/></svg><a href="solnechnogorsk.php">Салоны оптики Солнечногорск</a></div>
        <div class="footer-contact-item"><svg class="icon"><use href="#i-pin"/></svg><a href="odincovo.php">Салоны оптики Одинцово</a></div>
        <div class="footer-contact-item"><svg class="icon"><use href="#i-phone"/></svg><a href="tel:+78006005703">+7 800 600-57-03</a></div>
        <div class="footer-contact-item"><svg class="icon"><use href="#i-phone"/></svg><a href="tel:+79262772808">+7 926 277-28-08</a></div>
        <div class="footer-social">
          <a href="#" aria-label="Мы во VK" style="--brand:#0077FF"><svg class="icon icon-fill"><use href="#i-vk"/></svg></a>
          <a href="#" aria-label="Мы в Telegram" style="--brand:#26A5E4"><svg class="icon icon-fill"><use href="#i-telegram"/></svg></a>
          <a href="#" aria-label="Мы в MAX" style="--brand:#6E49F5"><svg class="icon icon-fill"><use href="#i-max"/></svg></a>
          <a href="#" aria-label="Мы в WhatsApp" style="--brand:#25D366"><svg class="icon"><use href="#i-whatsapp"/></svg></a>
          <a href="#" aria-label="Мы в Mail.ru" style="--brand:#168de2"><svg class="icon icon-fill"><use href="#i-mailru"/></svg></a>
          <a href="#" aria-label="Мы в Dzen" style="--brand:#000000"><svg class="icon icon-fill"><use href="#i-dzen"/></svg></a>
        </div>
      </div>
    </div>

    <div class="footer-bottom">
      <span class="footer-copy">© 2026 Салон оптики Lokamed. Все права защищены. Указанные на сайте цены являются ориентировочными, данный документ не является публичной офертой в соответствии со статьей 437.</span>
      <span class="footer-copy"><a href="#">Карта сайта</a> | <a href="#">Политика конфиденциальности</a></span>
    </div>
  </div>
</footer>

<a href="#top" class="to-top" id="toTop" aria-label="Наверх"><svg class="icon" style="width:18px;height:18px"><use href="#i-chev-up"/></svg></a>

<div class="cookie-banner" id="cookieBanner">
  <h3>Мы используем cookie</h3>
  <p>Мы используем cookie-файлы, в том числе сервис Яндекс Метрика, чтобы сайт работал корректно, анализировать посещаемость и улучшать качество работы сайта. Продолжая использовать сайт или нажимая «Принять», вы соглашаетесь с <a href="rules.php">политикой конфиденциальности</a>.</p>
  <div class="cookie-banner-actions">
    <button class="btn btn-primary btn-sm" id="cookieAcceptBtn">Принять</button>
  </div>
</div>

<!-- ================= DRAWERS ================= -->
<div class="drawer-overlay" id="cartDrawer">
  <div class="drawer-panel">
    <div class="drawer-head">
      <h3>Корзина</h3>
      <button class="modal-close" data-drawer-close aria-label="Закрыть"><svg class="icon"><use href="#i-close"/></svg></button>
    </div>
    <div class="drawer-body" id="cartItems"></div>
    <div class="drawer-footer">
      <div class="cart-promo">
        <input type="text" placeholder="Промокод:" id="cartPromoInput">
        <button type="button" id="cartPromoBtn" aria-label="Применить промокод"><svg class="icon"><use href="#i-arrow-right"/></svg></button>
      </div>
      <div class="drawer-total"><span>Стоимость</span><strong id="cartTotal">0 ₽</strong></div>
      <div class="drawer-footer-buttons">
        <button class="btn btn-outline" id="cartBuyNowBtn"><svg class="icon" style="width:16px;height:16px"><use href="#i-cart"/></svg>Купить в 1 клик</button>
        <a href="order.php" class="btn btn-primary">Оформить заказ</a>
      </div>
    </div>
  </div>
</div>

<div class="drawer-overlay" id="favDrawer">
  <div class="drawer-panel">
    <div class="drawer-head">
      <h3>Избранное</h3>
      <button class="modal-close" data-drawer-close aria-label="Закрыть"><svg class="icon"><use href="#i-close"/></svg></button>
    </div>
    <div class="drawer-body" id="favItems"></div>
  </div>
</div>

<!-- ================= MODALS ================= -->
<div class="modal-overlay" id="addToCartModal">
  <div class="modal-box" style="max-width:380px">
    <button class="modal-close" data-modal-close aria-label="Закрыть"><svg class="icon"><use href="#i-close"/></svg></button>
    <div class="modal-thanks">
      <div class="icon-wrap"><svg class="icon" style="width:26px;height:26px"><use href="#i-check"/></svg></div>
      <h4>Товар добавлен в корзину</h4>
      <p>Продолжите покупки или перейдите к оформлению заказа.</p>
    </div>
    <div style="display:flex;flex-direction:column;gap:10px;margin-top:8px">
      <button class="btn btn-outline btn-block" data-modal-close type="button">Продолжить покупки</button>
      <button class="btn btn-primary btn-block" id="goToCartBtn" type="button">Перейти в корзину</button>
    </div>
  </div>
</div>

<div class="modal-overlay" id="buyNowModal">
  <div class="modal-box" style="max-width:380px">
    <button class="modal-close" data-modal-close aria-label="Закрыть"><svg class="icon"><use href="#i-close"/></svg></button>
    <h3 style="font-size:1.25rem;margin-bottom:6px">Купить в один клик</h3>
    <p id="buyNowProductName" style="font-size:.88rem;color:var(--ink-soft);margin-bottom:18px"></p>
    <div class="modal-body">
      <form data-modal-form>
        <label class="field-label">Телефон <span class="req">*</span></label>
        <input class="field-input" type="tel" data-phone-mask placeholder="+7 (___) ___-__-__" required>

        <label class="check-row">
          <input type="checkbox" required>
          <span>Я принимаю <a href="rules.php" class="link"><span class="text">Условия политики конфиденциальности</span></a></span>
        </label>

        <button class="btn btn-primary btn-block" type="submit">Оформить заказ</button>
      </form>
    </div>
  </div>
</div>

<div class="modal-overlay" id="reviewModal">
  <div class="modal-box">
    <button class="modal-close" data-modal-close aria-label="Закрыть"><svg class="icon"><use href="#i-close"/></svg></button>
    <div class="review-top" id="reviewModalTop" style="margin-bottom:14px"></div>
    <div class="review-stars" id="reviewModalStars" style="margin-bottom:14px"></div>
    <p id="reviewModalText" style="color:var(--ink-soft);line-height:1.6"></p>
  </div>
</div>

<div class="modal-overlay" id="loginModal">
  <div class="modal-box">
    <button class="modal-close" data-modal-close aria-label="Закрыть"><svg class="icon"><use href="#i-close"/></svg></button>
    <h3 style="font-size:1.25rem;margin-bottom:18px">Вход в личный кабинет</h3>
    <div class="modal-body">
      <form data-modal-form id="loginForm">
        <label class="field-label">Ваш логин</label>
        <input class="field-input" type="text" name="login" required>

        <label class="field-label">Ваш пароль</label>
        <input class="field-input" type="password" name="password" required>

        <div style="display:flex;justify-content:flex-end;margin:-8px 0 16px">
          <a href="#" style="font-size:.82rem;color:var(--green-dark)">Забыли пароль?</a>
        </div>

        <button class="btn btn-primary btn-block" type="submit">Войти</button>

        <div class="login-divider"><span>или войти через</span></div>
        <div class="social-login-row">
          <button type="button" class="social-login-btn" data-social-login aria-label="Войти через VK"><svg class="icon icon-fill"><use href="#i-vk"/></svg></button>
          <button type="button" class="social-login-btn" data-social-login aria-label="Войти через mail.ru"><svg class="icon icon-fill"><use href="#i-mailru"/></svg></button>
          <button type="button" class="social-login-btn" data-social-login aria-label="Войти через Яндекс"><svg class="icon icon-fill"><use href="#i-yandex"/></svg></button>
        </div>

        <p style="text-align:center;font-size:.85rem;margin-top:18px;color:var(--ink-soft)">Нет аккаунта? <a href="#" style="color:var(--green-dark);font-weight:700">Зарегистрироваться</a></p>
      </form>
    </div>
  </div>
</div>

<div class="modal-overlay" id="feedbackModal">
  <div class="modal-box">
    <button class="modal-close" data-modal-close aria-label="Закрыть"><svg class="icon"><use href="#i-close"/></svg></button>
    <h3 style="font-size:1.25rem;margin-bottom:18px">Обратная связь</h3>
    <div class="modal-body">
      <form data-modal-form>
        <label class="field-label">Ваше имя</label>
        <input class="field-input" type="text" name="name">

        <label class="field-label">Телефон <span class="req">*</span></label>
        <input class="field-input" type="tel" name="phone" data-phone-mask placeholder="+7 (___) ___-__-__" required>

        <label class="field-label">E-mail <span class="req">*</span></label>
        <input class="field-input" type="email" name="email" required>

        <label class="field-label">Ваше сообщение <span class="req">*</span></label>
        <textarea class="field-input" name="message" rows="4" required style="resize:vertical"></textarea>

        <label class="check-row">
          <input type="checkbox" required>
          <span>Я принимаю <a href="rules.php" class="link"><span class="text">Условия политики конфиденциальности</span></a></span>
        </label>

        <button class="btn btn-primary btn-block" type="submit">Отправить</button>
        <p class="required-note">* — Поля, отмеченные звездочкой, обязательны для заполнения</p>
      </form>
    </div>
  </div>
</div>

<div class="modal-overlay" id="callbackModal">
  <div class="modal-box">
    <button class="modal-close" data-modal-close aria-label="Закрыть"><svg class="icon"><use href="#i-close"/></svg></button>
    <h3 style="font-size:1.25rem;margin-bottom:18px">Перезвоните мне</h3>
    <div class="modal-body">
      <form data-modal-form>
        <label class="field-label">Ваше имя</label>
        <input class="field-input" type="text" name="name">

        <label class="field-label">Телефон <span class="req">*</span></label>
        <input class="field-input" type="tel" name="phone" data-phone-mask placeholder="+7 (___) ___-__-__" required>

        <label class="check-row">
          <input type="checkbox" required>
          <span>Я принимаю <a href="rules.php" class="link"><span class="text">Условия политики конфиденциальности</span></a></span>
        </label>

        <button class="btn btn-primary btn-block" type="submit">Перезвоните мне</button>
      </form>
    </div>
  </div>
</div>

<script src="assets/js/bundle.js"></script>
<?php foreach ($vendorScripts ?? [] as $src): ?>
<script src="<?= $src ?>"></script>
<?php endforeach; ?>
<?php if (!empty($inlineScript)): ?>
<script>
<?= $inlineScript ?>
</script>
<?php endif; ?>
<script src="https://code.jivosite.com/widget/bV73h9K7o3" async></script>
<script type="text/javascript" src="https://w2315490.yclients.com/widgetJS" charset="UTF-8"></script>
</body></html>
