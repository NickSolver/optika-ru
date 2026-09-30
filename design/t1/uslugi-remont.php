<?php
$pageTitle = 'Ремонт очков — Lokamed';
$extraHeadLinks = ['assets/css/article-page.css', 'assets/css/uslugi-other.css', 'assets/css/uslugi-price-table.css'];
include __DIR__ . '/includes/header.php';
?>
<main>
<section class="section" style="border-top:none;padding-top:8px">
  <div class="container">
    <?php render_breadcrumbs([['label' => 'Услуги', 'href' => 'uslugi.php'], ['label' => 'Ремонт очков']]); ?>

    <div class="blog-detail">
      <h1 style="margin-bottom:20px">Ремонт очков любой сложности</h1>

      <div class="blog-detail-body">
        <h2>О услуге</h2>
        <p>Мастера Lokamed восстанавливают оправы любой сложности с помощью специального оборудования и материалов — устраняют даже серьёзные повреждения без потери внешнего вида аксессуара. При необходимости заменяются крепёжные элементы и устанавливаются линзы.</p>

        <h2>Как заказать</h2>
        <p>Оставьте заявку на сайте или позвоните нам. Ремонт начинается с диагностики — по её итогам может потребоваться лазерная пайка или замена крепёжных элементов оправы.</p>

        <h2>Примеры цен</h2>
        <table class="uslugi-price-table">
          <tr><td>Замена винта</td><td>от 200 ₽</td></tr>
          <tr><td>Лазерная пайка</td><td>от 1 000 ₽</td></tr>
          <tr><td>Установка линзы</td><td>700–1 500 ₽</td></tr>
          <tr><td>Зеркальное тонирование</td><td>2 200–2 750 ₽</td></tr>
          <tr><td>Ультразвуковая чистка</td><td>от 400 ₽</td></tr>
        </table>
      </div>

      <div class="blog-detail-cta">
        <p>Запишитесь на ремонт очков в ближайший салон Lokamed.</p>
        <a href="salony.php" class="btn btn-primary">Найти салон</a>
      </div>
    </div>

    <div class="uslugi-other">
      <a href="uslugi.php">← Все услуги</a>
      <a href="uslugi-zamena-linz.php">Замена линз</a>
      <a href="uslugi-podbor.php">Подбор оправ и очковых линз</a>
      <a href="uslugi-proverka-zreniya.php">Проверка зрения</a>
    </div>
  </div>
</section>
</main>

<?php
include __DIR__ . '/includes/footer.php';
