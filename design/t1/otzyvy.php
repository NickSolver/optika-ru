<?php
$pageTitle = 'Отзывы — Lokamed';
$pageCss = 'assets/css/otzyvy.css';
include __DIR__ . '/includes/header.php';
?>
<main>
<section class="section" style="border-top:none;padding-top:8px">
  <div class="container">
    <?php render_breadcrumbs([['label' => 'Отзывы']]); ?>

    <div class="section-head">
      <h1 style="font-size:clamp(1.6rem,1.3rem + 1.2vw,2.2rem)">Отзывы</h1>
      <p>Выберите салон, чтобы посмотреть отзывы именно о нём.</p>
    </div>

    <select id="selectorOptik" class="reviews-salon-select">
      <option value="72683660408">Одинцово, Можайское ш., 66 б</option>
      <option value="53206336483">к2008, Зеленоград</option>
      <option value="176051066597">Жилинская ул., 1, Андреевка</option>
      <option value="41989077538">Ангелов пер., 8, Москва</option>
      <option value="201408625975">к1824, Зеленоград</option>
      <option value="206422908278">к834А, Зеленоград</option>
      <option value="8200665506">к241, Зеленоград</option>
    </select>

    <div class="reviews-widget-wrap">
      <iframe id="widget" style="width:100%;height:100%;border:1px solid #e6e6e6;border-radius:8px;box-sizing:border-box" src="https://yandex.ru/maps-reviews-widget/72683660408?comments"></iframe>
    </div>
  </div>
</section>
</main>

<?php
$inlineScript = 'Bundle.initOtzyvy();';
include __DIR__ . '/includes/footer.php';
