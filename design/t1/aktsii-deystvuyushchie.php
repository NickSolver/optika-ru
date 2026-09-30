<?php
$pageTitle = 'Действующие акции — Lokamed';
$pageCss = 'assets/css/aktsii-page.css';
include __DIR__ . '/includes/header.php';
?>
<main>
<section class="section" style="border-top:none;padding-top:8px">
  <div class="container">
    <?php render_breadcrumbs([['label' => 'Акции и скидки', 'href' => 'aktsii.php'], ['label' => 'Действующие акции']]); ?>

    <div class="section-head">
      <h1 style="font-size:clamp(1.6rem,1.3rem + 1.2vw,2.2rem)">Действующие акции</h1>
      <p>Ограниченные по времени акции в сети салонов оптики Lokamed.</p>
    </div>

    <div class="tabs aktsii-tabs">
      <?php render_aktsii_tabs('deystvuyushchie'); ?>
    </div>

    <div class="promo-grid" id="aktsiiGrid"></div>
    <div class="show-more-row">
      <button class="btn btn-outline" id="aktsiiShowMoreBtn">Показать ещё</button>
    </div>
    <div class="pagination" id="aktsiiPagination"></div>

    <p class="promo-disclaimer">Обращаем ваше внимание, что скидки не суммируются.</p>
  </div>
</section>
</main>

<?php
$inlineScript = <<<'JS'
const AKTSII_PROMOS = [
  { href: 'promo.php', img: 'assets/img/promo/aktsii-card1.jpg', tag: 'До 31 августа', title: 'Скидки до 70% на солнцезащитные очки', desc: 'Успейте выбрать солнцезащитные оправы прошлых коллекций по специальной цене — количество ограничено.', cta: 'Подробнее об акции' },
  { href: 'promo.php', img: 'assets/img/promo/slide2.jpg', tag: 'До конца сезона', title: 'Конкурс детского рисунка «Мир глазами ребёнка»', desc: 'Принесите рисунок ребёнка в любой салон сети — призы гарантированы каждому участнику.', cta: 'Подробнее' },
];
Bundle.initAktsiiGrid(AKTSII_PROMOS);
JS;
include __DIR__ . '/includes/footer.php';
