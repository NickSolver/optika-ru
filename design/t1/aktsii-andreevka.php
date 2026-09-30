<?php
$pageTitle = 'Особые акции в Андреевке — Lokamed';
$pageCss = 'assets/css/aktsii-page.css';
include __DIR__ . '/includes/header.php';
?>
<main>
<section class="section" style="border-top:none;padding-top:8px">
  <div class="container">
    <?php render_breadcrumbs([['label' => 'Акции и скидки', 'href' => 'aktsii.php'], ['label' => 'Особые акции в Андреевке']]); ?>

    <div class="section-head">
      <h1 style="font-size:clamp(1.6rem,1.3rem + 1.2vw,2.2rem)">Особые акции в Андреевке</h1>
      <p>Специальные условия для клиентов салона оптики Lokamed в Андреевке.</p>
    </div>

    <div class="tabs aktsii-tabs">
      <?php render_aktsii_tabs('andreevka'); ?>
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
  { href: 'promo.php', img: 'assets/img/promo/slide3.jpg', tag: 'Бессрочно', title: 'Андреевы дни — скидка за имя!', desc: 'У кого в ФИО есть «Андрей» в любом виде — скидка 15% на весь ассортимент и +3% на продукцию Lokamed. Салон Андреевка, ул. Жилинская, 1.', cta: 'Салон в Андреевке' },
  { href: 'promo.php', img: 'assets/img/promo/slide4.jpg', tag: 'Бессрочно', title: 'Спецусловия Lokamed в Андреевке', desc: '20% скидка на весь ассортимент + ещё 5% по вторникам и субботам. Салон Андреевка, ул. Жилинская, 1.', cta: 'Салон в Андреевке' },
];
Bundle.initAktsiiGrid(AKTSII_PROMOS);
JS;
include __DIR__ . '/includes/footer.php';
