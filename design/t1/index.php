<?php
$pageTitle = 'Lokamed — сеть салонов оптики';
$pageDescription = 'Оправы, линзы, солнцезащитные очки и контактные линзы. Бесплатная проверка зрения, оригинальная продукция, доставка по России.';
include __DIR__ . '/includes/header.php';
?>
<main>

<!-- ================= HERO ================= -->
<section class="hero section" style="border-top:none">
  <div class="hero-slider">
    <div class="hero-track" id="heroTrack">
      <div class="hero-slide">
        <div class="container">
          <div class="hero-copy" data-reveal>
            <span class="eyebrow">Оптика с 2005 года</span>
            <h1>Очки и линзы,<br>подобранные под вас</h1>
            <p>Бесплатная проверка зрения, оригинальные оправы и линзы лучших брендов, доставка по всей России.</p>
            <div class="hero-actions">
              <a href="#products" class="btn btn-primary">Подобрать очки</a>
              <a href="#" class="btn btn-outline">Проверить зрение</a>
            </div>
          </div>
          <div class="hero-visual" data-reveal>
            <div class="hero-visual-surface"></div>
            <img src="assets/img/product4.png" alt="Оправа для очков Lokamed 34125 C2" draggable="false">
          </div>
        </div>
      </div>

      <div class="hero-slide">
        <div class="container">
          <div class="hero-copy" data-reveal>
            <span class="eyebrow">Новая коллекция</span>
            <h1>Солнцезащитные очки<br>на любой сезон</h1>
            <p>Оригинальные бренды, поляризационные линзы и стиль на каждый день.</p>
            <div class="hero-actions">
              <a href="#products" class="btn btn-primary">Смотреть коллекцию</a>
              <a href="#" class="btn btn-outline">Все бренды</a>
            </div>
          </div>
          <div class="hero-visual" data-reveal>
            <div class="hero-visual-surface"></div>
            <img src="assets/img/product2.png" alt="Оправа для очков Lokamed 37059 C9" draggable="false">
          </div>
        </div>
      </div>

      <div class="hero-slide">
        <div class="container">
          <div class="hero-copy" data-reveal>
            <span class="eyebrow">Акция месяца</span>
            <h1>Скидка 15%<br>на хиты продаж</h1>
            <p>Успейте выбрать оправу по специальной цене — количество ограничено.</p>
            <div class="hero-actions">
              <a href="#products" class="btn btn-primary">Выбрать со скидкой</a>
              <a href="#" class="btn btn-outline">Все акции</a>
            </div>
          </div>
          <div class="hero-visual" data-reveal>
            <div class="hero-visual-surface"></div>
            <img src="assets/img/product3.png" alt="Оправа для очков Lokamed 34132 C6-1" draggable="false">
          </div>
        </div>
      </div>
    </div>

    <button class="hero-arrow hero-arrow-prev" id="heroPrev" aria-label="Предыдущий слайд"><svg class="icon"><use href="#i-chev-left"/></svg></button>
    <button class="hero-arrow hero-arrow-next" id="heroNext" aria-label="Следующий слайд"><svg class="icon"><use href="#i-chev-right"/></svg></button>
    <div class="review-dots" id="heroDots" style="margin-top:18px"></div>
  </div>
</section>

<!-- ================= TRUST BAR ================= -->
<section class="section" style="padding-block:8px">
  <div class="container">
    <div class="trust-grid">
      <div class="trust-item"><div class="trust-icon"><svg class="icon"><use href="#i-badge"/></svg></div><span>На рынке с 2005 года</span></div>
      <div class="trust-item"><div class="trust-icon"><svg class="icon"><use href="#i-eye"/></svg></div><span>Бесплатная проверка зрения 18+</span></div>
      <div class="trust-item"><div class="trust-icon"><svg class="icon"><use href="#i-shield"/></svg></div><span>6 месяцев гарантии на очки</span></div>
      <div class="trust-item"><div class="trust-icon"><svg class="icon"><use href="#i-badge"/></svg></div><span>Только оригинальная продукция</span></div>
      <div class="trust-item"><div class="trust-icon"><svg class="icon"><use href="#i-users"/></svg></div><span>50 000+ довольных клиентов</span></div>
      <div class="trust-item"><div class="trust-icon"><svg class="icon"><use href="#i-pin"/></svg></div><span>7 салонов в Москве и области</span></div>
      <div class="trust-item"><div class="trust-icon"><svg class="icon"><use href="#i-truck"/></svg></div><span>Доставка бесплатно от 5 000 ₽</span></div>
      <div class="trust-item"><div class="trust-icon"><svg class="icon"><use href="#i-glasses"/></svg></div><span>Бесплатная примерка онлайн</span></div>
    </div>
  </div>
</section>

<!-- ================= CATEGORIES ================= -->
<section class="section" id="categories">
  <div class="container">
    <div class="section-head" data-reveal>
      <h2>Каталог по категориям</h2>
      <p>Всё для зрения и стиля: от оправ до подарочных сертификатов.</p>
    </div>

    <div class="bento" data-reveal>
      <a href="#" class="bento-card span-2">
        <div class="bento-icon"><svg class="icon"><use href="#i-glasses"/></svg></div>
        <div><h3>Оправы для очков</h3><span class="bento-link">Подробнее <svg class="icon"><use href="#i-arrow-right"/></svg></span></div>
      </a>
      <a href="#" class="bento-card">
        <div class="bento-icon"><svg class="icon"><use href="#i-lens"/></svg></div>
        <div><h3>Линзы для очков</h3><span class="bento-link">Подробнее <svg class="icon"><use href="#i-arrow-right"/></svg></span></div>
      </a>
      <a href="#" class="bento-card">
        <div class="bento-icon"><svg class="icon"><use href="#i-eye"/></svg></div>
        <div><h3>Контактные линзы</h3><span class="bento-link">Подробнее <svg class="icon"><use href="#i-arrow-right"/></svg></span></div>
      </a>
      <a href="#" class="bento-card">
        <div class="bento-icon"><svg class="icon"><use href="#i-bag"/></svg></div>
        <div><h3>Аксессуары</h3><span class="bento-link">Подробнее <svg class="icon"><use href="#i-arrow-right"/></svg></span></div>
      </a>
      <a href="#" class="bento-card">
        <div class="bento-icon"><svg class="icon"><use href="#i-gift"/></svg></div>
        <div><h3>Подарочные сертификаты</h3><span class="bento-link">Подробнее <svg class="icon"><use href="#i-arrow-right"/></svg></span></div>
      </a>
      <a href="#" class="bento-card span-2">
        <div class="bento-icon"><svg class="icon"><use href="#i-sun"/></svg></div>
        <div><h3>Солнцезащитные очки</h3><span class="bento-link">Подробнее <svg class="icon"><use href="#i-arrow-right"/></svg></span></div>
      </a>
    </div>
  </div>
</section>

<!-- ================= PRODUCTS ================= -->
<section class="section" id="products">
  <div class="container">
    <div class="section-head-row" data-reveal>
      <div class="tabs" role="tablist">
        <button class="tab-btn" role="tab" aria-selected="false" data-tab="new">Новинки</button>
        <button class="tab-btn" role="tab" aria-selected="true" data-tab="hits">Хиты продаж</button>
        <button class="tab-btn" role="tab" aria-selected="false" data-tab="sale">Суперцена</button>
      </div>
      <div class="reviews-controls">
        <button class="slider-btn" id="prodPrev" aria-label="Предыдущие товары"><svg class="icon"><use href="#i-chev-left"/></svg></button>
        <button class="slider-btn" id="prodNext" aria-label="Следующие товары"><svg class="icon"><use href="#i-chev-right"/></svg></button>
      </div>
    </div>

    <div class="slider-row" data-reveal>
      <div class="product-track" id="productTrack"></div>
    </div>
    <div class="review-dots" id="productDots"></div>
  </div>
</section>

<!-- ================= REVIEWS SLIDER ================= -->
<section class="section" id="reviews">
  <div class="container">
    <div class="reviews-head" data-reveal>
      <div class="section-head" style="margin-bottom:0">
        <h2>Отзывы покупателей</h2>
        <p>Что говорят те, кто уже подобрал очки и линзы в Lokamed.</p>
      </div>
      <div class="reviews-controls">
        <button class="slider-btn" id="revPrev" aria-label="Предыдущие отзывы"><svg class="icon"><use href="#i-chev-left"/></svg></button>
        <button class="slider-btn" id="revNext" aria-label="Следующие отзывы"><svg class="icon"><use href="#i-chev-right"/></svg></button>
      </div>
    </div>

    <div class="review-track" id="reviewTrack" data-reveal></div>
    <div class="review-dots" id="reviewDots"></div>
  </div>
</section>

<!-- ================= ABOUT ================= -->
<section class="section" id="about">
  <div class="container">
    <div class="about-box" data-reveal>
      <div>
        <h2>21 год подбираем зрение вместе с вами</h2>
        <p>Сеть салонов оптики Lokamed представляет в Москве и области продукцию лучших брендов. Мы осуществляем подбор и продажу оправ для очков, солнцезащитных очков, контактных линз и аксессуаров к ним по приятным ценам, обеспечивая быструю и аккуратную доставку заказов по всей России.</p>
        <a href="o-kompanii.php" class="btn btn-primary" style="margin-top:22px">О компании</a>
      </div>
      <div class="about-figures">
        <div class="about-figure"><strong>50 000+</strong><span>довольных клиентов</span></div>
        <div class="about-figure"><strong>7</strong><span>салонов оптики</span></div>
        <div class="about-figure"><strong>21 год</strong><span>на рынке оптики</span></div>
        <div class="about-figure"><strong>6 мес.</strong><span>гарантии на очки</span></div>
      </div>
    </div>
  </div>
</section>

<!-- ================= BLOG ================= -->
<section class="section" id="blog">
  <div class="container">
    <div class="reviews-head" data-reveal>
      <div class="section-head" style="margin-bottom:0">
        <h2>Блог</h2>
        <p>Разбираемся в линзах, покрытиях и здоровье глаз простым языком.</p>
      </div>
      <div class="reviews-controls">
        <button class="slider-btn" id="blogPrev" aria-label="Предыдущие статьи"><svg class="icon"><use href="#i-chev-left"/></svg></button>
        <button class="slider-btn" id="blogNext" aria-label="Следующие статьи"><svg class="icon"><use href="#i-chev-right"/></svg></button>
      </div>
    </div>

    <div class="blog-track" id="blogTrack" data-reveal></div>
    <div class="review-dots" id="blogDots"></div>
  </div>
</section>

</main>


<?php
$inlineScript = 'Bundle.initHomepage();';
include __DIR__ . '/includes/footer.php';
