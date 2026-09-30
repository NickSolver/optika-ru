<?php
$pageTitle = 'Замена линз в очках — Lokamed';
$extraHeadLinks = ['assets/css/article-page.css', 'assets/css/uslugi-other.css', 'assets/css/uslugi-price-table.css'];
include __DIR__ . '/includes/header.php';
?>
<main>
<section class="section" style="border-top:none;padding-top:8px">
  <div class="container">
    <?php render_breadcrumbs([['label' => 'Услуги', 'href' => 'uslugi.php'], ['label' => 'Замена линз в очках']]); ?>

    <div class="blog-detail">
      <h1 style="margin-bottom:20px">Замена линз в очках</h1>

      <div class="blog-detail-body">
        <h2>О услуге</h2>
        <p>Подходит, если оправа вас полностью устраивает, а поменять нужно только линзы. Салоны Lokamed принимают заказы на замену линз по всей Москве и Московской области.</p>

        <h2>Преимущества</h2>
        <ul>
          <li><strong>Доступная цена</strong> — мы предлагаем качественную услугу по низкой стоимости, итоговая цена зависит от сложности работы и используемых материалов</li>
          <li><strong>Быстрый срок</strong> — мы ценим время каждого клиента и стараемся выполнить замену как можно быстрее, подстраиваясь под ваш график</li>
          <li><strong>Работа со сложными оправами</strong> — специалисты справляются с ободковыми, полуободковыми и безободковыми оправами; при необходимости оправу сначала отремонтируют</li>
        </ul>

        <h2>Цены</h2>
        <table class="uslugi-price-table">
          <tr><td>Установка линзы</td><td>700–1 500 ₽</td></tr>
          <tr><td>Зеркальное покрытие</td><td>2 200–2 750 ₽</td></tr>
          <tr><td>Ультразвуковая чистка</td><td>от 400 ₽</td></tr>
        </table>
      </div>

      <div class="blog-detail-cta">
        <p>Запишитесь на замену линз в ближайший салон Lokamed.</p>
        <a href="salony.php" class="btn btn-primary">Найти салон</a>
      </div>
    </div>

    <div class="uslugi-other">
      <a href="uslugi.php">← Все услуги</a>
      <a href="uslugi-remont.php">Ремонт очков</a>
      <a href="uslugi-podbor.php">Подбор оправ и очковых линз</a>
      <a href="uslugi-proverka-zreniya.php">Проверка зрения</a>
    </div>
  </div>
</section>
</main>

<?php
include __DIR__ . '/includes/footer.php';
