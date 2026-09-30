<?php
$pageTitle = 'Скидки до 70% на солнцезащитные очки — Lokamed';
$pageCss = 'assets/css/promo.css';
include __DIR__ . '/includes/header.php';
?>
<main>
<section class="section" style="border-top:none;padding-top:8px">
  <div class="container">
    <?php render_breadcrumbs([['label' => 'Акции и скидки', 'href' => 'aktsii.php'], ['label' => 'Скидки до 70% на солнцезащитные очки']]); ?>

    <div class="promo-detail">
      <div class="promo-detail-media"><img src="assets/img/promo/slide1.jpg" alt="Скидки до 70% на солнцезащитные очки"></div>
      <span class="promo-detail-badge">До 31 августа</span>
      <h1>Скидки до 70% на солнцезащитные очки</h1>
      <div class="promo-detail-period">Акция действует с 1 июля по 31 августа 2026 года во всех салонах сети и на сайте</div>

      <p>Успейте обновить солнцезащитные очки по специальной цене — в акцию попали модели прошлых коллекций проверенных брендов: Ray Ban, Carrera, Polaroid и собственная линейка Lokamed. Скидка суммируется с накопительной картой постоянного клиента.</p>

      <div class="promo-code-box">
        <div>
          <div class="label">Промокод на дополнительную скидку 5%</div>
          <div class="code" id="promoCodeText">SUN2026</div>
        </div>
        <button class="btn btn-outline btn-sm" id="promoCopyBtn">Скопировать</button>
      </div>

      <h3>Условия акции</h3>
      <ul>
        <li>Скидка действует на модели солнцезащитных очков со значком «-70%» в каталоге</li>
        <li>Промокод даёт дополнительные 5% при заказе на сайте от 3 000 ₽</li>
        <li>Акция не суммируется с другими скидками, кроме накопительной карты</li>
        <li>Количество товаров по акции ограничено и может отличаться по салонам</li>
        <li>Организатор акции — сеть салонов оптики Lokamed. Подробности уточняйте у консультанта</li>
      </ul>

      <a href="catalog-section.php" class="btn btn-primary" style="margin-top:8px">Выбрать очки со скидкой</a>
    </div>
  </div>
</section>
</main>

<?php
$inlineScript = 'Bundle.initPromo();';
include __DIR__ . '/includes/footer.php';
