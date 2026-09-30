<?php
$pageTitle = 'Постоянные предложения — Lokamed';
$pageCss = 'assets/css/aktsii-page.css';
include __DIR__ . '/includes/header.php';
?>
<main>
<section class="section" style="border-top:none;padding-top:8px">
  <div class="container">
    <?php render_breadcrumbs([['label' => 'Акции и скидки', 'href' => 'aktsii.php'], ['label' => 'Постоянные предложения']]); ?>

    <div class="section-head">
      <h1 style="font-size:clamp(1.6rem,1.3rem + 1.2vw,2.2rem)">Постоянные предложения</h1>
      <p>Бессрочные скидки и специальные условия в сети салонов оптики Lokamed.</p>
    </div>

    <div class="tabs aktsii-tabs">
      <?php render_aktsii_tabs('postoyannye'); ?>
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
  { href: 'promo.php', img: 'assets/img/promo/slide5.jpg', tag: 'Бессрочно', title: 'Первые очки со скидкой 20%', desc: 'Оформите первый заказ по промокоду FIRST20 и получите скидку на оправу и линзы.', cta: 'Выбрать очки' },
  { href: 'promo.php', img: 'assets/img/promo/slide6.jpg', tag: 'Бессрочно', title: 'Оправа в подарок при покупке линз', desc: 'При заказе очковых линз в салоне — оправа из базовой коллекции Lokamed в подарок.', cta: 'Подобрать линзы' },
  { href: 'promo.php', img: 'assets/img/promo/slide7.jpg', tag: 'Бессрочно, 18+', title: 'Бесплатный подбор средств коррекции зрения', desc: 'Профессиональный подбор очков и линз в салонах Lokamed Зеленоград и Одинцово — консультация оптометриста бесплатно.', cta: 'Подробнее' },
  { href: 'promo.php', img: 'assets/img/promo/slide8.jpg', tag: 'Бессрочно', title: 'Изготовление и ремонт очков за 1 час', desc: 'Срочное изготовление и мелкий ремонт оправ в салоне Lokamed Зеленоград — без предварительной записи.', cta: 'Подробнее' },
  { href: 'promo.php', img: 'assets/img/promo/social_photo.jpg', tag: 'Ежемесячно', title: 'Фотоконкурс в соцсетях — приз 3 000 ₽', desc: 'Опубликуйте фото в очках Lokamed с хэштегом бренда — победитель месяца получает 3 000 ₽ на счёт.', cta: 'Подробнее' },
  { href: 'promo.php', img: 'assets/img/promo/loyalty_card.jpg', tag: 'Бессрочно', title: 'Накопительная скидка 5–15%', desc: 'Чем больше покупок в сети — тем выше персональная скидка на будущие заказы, до 15%.', cta: 'Подробнее' },
];
Bundle.initAktsiiGrid(AKTSII_PROMOS);
JS;
include __DIR__ . '/includes/footer.php';
