<?php
$pageTitle = 'Услуги — Lokamed';
$pageCss = 'assets/css/uslugi.css';
include __DIR__ . '/includes/header.php';
?>
<main>
<section class="section" style="border-top:none;padding-top:8px">
  <div class="container">
    <?php render_breadcrumbs([['label' => 'Услуги']]); ?>

    <div class="section-head" style="max-width:none;width:100%">
      <h1 style="font-size:clamp(1.6rem,1.3rem + 1.2vw,2.2rem)">Услуги</h1>
      <p>Что предлагают салоны оптики Lokamed — от бесплатной проверки зрения до ремонта и изготовления очков.</p>
    </div>

    <div class="uslugi-grid">
      <a href="uslugi-proverka-zreniya.php" class="uslugi-card is-link">
        <div class="uslugi-icon"><svg class="icon"><use href="#i-eye"/></svg></div>
        <h3>Бесплатная проверка зрения (18+)</h3>
        <p>Комплексная проверка зрения в салонах Lokamed — без очередей поликлиники.</p>
        <span class="uslugi-more">Подробнее <svg class="icon" style="width:14px;height:14px"><use href="#i-arrow-right"/></svg></span>
      </a>
      <a href="uslugi-remont.php" class="uslugi-card is-link">
        <div class="uslugi-icon"><svg class="icon"><use href="#i-shield"/></svg></div>
        <h3>Ремонт очков любой сложности</h3>
        <p>Восстановление оправ, замена крепёжных элементов и лазерная пайка.</p>
        <span class="uslugi-more">Подробнее <svg class="icon" style="width:14px;height:14px"><use href="#i-arrow-right"/></svg></span>
      </a>
      <div class="uslugi-card is-static">
        <div class="uslugi-icon"><svg class="icon"><use href="#i-bag"/></svg></div>
        <h3>Аксессуары</h3>
        <p>Футляры, салфетки, шнурки и средства по уходу за очками.</p>
      </div>
      <div class="uslugi-card is-static">
        <div class="uslugi-icon"><svg class="icon"><use href="#i-bolt"/></svg></div>
        <h3>Лазерная пайка</h3>
        <p>Восстановление металлических оправ без видимых следов ремонта.</p>
      </div>
      <div class="uslugi-card is-static">
        <div class="uslugi-icon"><svg class="icon"><use href="#i-sun"/></svg></div>
        <h3>Тонирование линз</h3>
        <p>Затемнение или зеркальное покрытие линз по вашему желанию.</p>
      </div>
      <div class="uslugi-card is-static">
        <div class="uslugi-icon"><svg class="icon"><use href="#i-badge"/></svg></div>
        <h3>Изготовление очков на заказ</h3>
        <p>Индивидуальный подбор и изготовление очков по вашему рецепту.</p>
      </div>
      <a href="uslugi-zamena-linz.php" class="uslugi-card is-link">
        <div class="uslugi-icon"><svg class="icon"><use href="#i-lens"/></svg></div>
        <h3>Замена линз в очках</h3>
        <p>Установим новые линзы в вашу оправу быстро и по доступной цене.</p>
        <span class="uslugi-more">Подробнее <svg class="icon" style="width:14px;height:14px"><use href="#i-arrow-right"/></svg></span>
      </a>
      <a href="uslugi-podbor.php" class="uslugi-card is-link">
        <div class="uslugi-icon"><svg class="icon"><use href="#i-glasses"/></svg></div>
        <h3>Подбор оправ и очковых линз</h3>
        <p>Профессиональная консультация и подбор оправы вместе с линзами.</p>
        <span class="uslugi-more">Подробнее <svg class="icon" style="width:14px;height:14px"><use href="#i-arrow-right"/></svg></span>
      </a>
    </div>
  </div>
</section>
</main>

<?php
include __DIR__ . '/includes/footer.php';
