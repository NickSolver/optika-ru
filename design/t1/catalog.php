<?php
$pageTitle = 'Каталог — Lokamed';
$pageCss = 'assets/css/catalog.css';
include __DIR__ . '/includes/header.php';
?>
<main>
<section class="section" style="border-top:none;padding-top:8px">
  <div class="container">
    <?php render_breadcrumbs([['label' => 'Каталог']]); ?>

    <div class="section-head">
      <h1 style="font-size:clamp(1.6rem,1.3rem + 1.2vw,2.2rem)">Каталог</h1>
      <p>Выберите раздел каталога — оправы, солнцезащитные очки, линзы, аксессуары и подарочные сертификаты.</p>
    </div>

    <div class="hub-grid">
      <a href="catalog-section.php" class="hub-card">
        <div class="hub-card-media"><img src="assets/img/catalog/frames.jpg" alt="Оправы для очков"></div>
        <div class="hub-card-body">
          <h3>Оправы для очков</h3>
          <div class="hub-card-count">3 187 товаров</div>
        </div>
      </a>
      <a href="catalog-section.php" class="hub-card">
        <div class="hub-card-media"><img src="assets/img/catalog/sun.jpg" alt="Солнцезащитные очки"></div>
        <div class="hub-card-body">
          <h3>Солнцезащитные очки</h3>
          <div class="hub-card-count">1 462 товара</div>
        </div>
      </a>
      <a href="catalog-section.php" class="hub-card">
        <div class="hub-card-media"><img src="assets/img/catalog/contacts.jpg" alt="Контактные линзы"></div>
        <div class="hub-card-body">
          <h3>Контактные линзы</h3>
          <div class="hub-card-count">648 товаров</div>
        </div>
      </a>
      <a href="catalog-section.php" class="hub-card">
        <div class="hub-card-media"><img src="assets/img/catalog/lenses.jpg" alt="Линзы для очков"></div>
        <div class="hub-card-body">
          <h3>Линзы для очков</h3>
          <div class="hub-card-count">512 товаров</div>
        </div>
      </a>
      <a href="catalog-section.php" class="hub-card">
        <div class="hub-card-media"><img src="assets/img/catalog/access.jpg" alt="Аксессуары"></div>
        <div class="hub-card-body">
          <h3>Аксессуары</h3>
          <div class="hub-card-count">274 товара</div>
        </div>
      </a>
      <a href="catalog-section.php" class="hub-card">
        <div class="hub-card-media" style="background:#eafaec"><img src="assets/img/catalog/gift.svg" alt="Подарочные сертификаты" style="object-fit:contain;padding:10px"></div>
        <div class="hub-card-body">
          <h3>Подарочные сертификаты</h3>
          <div class="hub-card-count">6 номиналов</div>
        </div>
      </a>
    </div>
  </div>
</section>
</main>

<?php
include __DIR__ . '/includes/footer.php';
