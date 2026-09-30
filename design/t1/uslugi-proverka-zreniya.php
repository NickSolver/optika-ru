<?php
$pageTitle = 'Бесплатная проверка зрения — Lokamed';
$extraHeadLinks = ['assets/css/article-page.css', 'assets/css/uslugi-other.css'];
include __DIR__ . '/includes/header.php';
?>
<main>
<section class="section" style="border-top:none;padding-top:8px">
  <div class="container">
    <?php render_breadcrumbs([['label' => 'Услуги', 'href' => 'uslugi.php'], ['label' => 'Бесплатная проверка зрения']]); ?>

    <div class="blog-detail">
      <h1 style="margin-bottom:20px">Бесплатная проверка зрения (18+)</h1>

      <div class="blog-detail-body">
        <h2>Зачем проверять зрение</h2>
        <p>Компьютеры и смартфоны создают повышенную нагрузку на глаза, а близорукость встречается всё чаще — в том числе у взрослых. Ранняя диагностика и правильно подобранные очки помогают затормозить дальнейшее ухудшение зрения.</p>

        <h2>Что даёт проверка</h2>
        <ul>
          <li>Обнаружить патологические процессы, которые пока никак не проявляют себя</li>
          <li>Диагностировать уже имеющиеся проблемы со зрением</li>
          <li>Подобрать подходящую коррекцию — контактные линзы или очки</li>
          <li>Предотвратить дальнейшее ухудшение зрения</li>
        </ul>

        <h2>Как это устроено</h2>
        <p>В салонах оптики Lokamed работают оборудованные кабинеты со стандартными таблицами и аппаратурой для проверки зрения. Оптометристы принимают по удобному графику — без очередей, характерных для поликлиник.</p>
      </div>

      <div class="blog-detail-cta">
        <p>Запишитесь на бесплатную проверку зрения в ближайший салон Lokamed.</p>
        <a href="salony.php" class="btn btn-primary">Найти салон</a>
      </div>
    </div>

    <div class="uslugi-other">
      <a href="uslugi.php">← Все услуги</a>
      <a href="uslugi-podbor.php">Подбор оправ и очковых линз</a>
      <a href="uslugi-remont.php">Ремонт очков</a>
      <a href="uslugi-zamena-linz.php">Замена линз</a>
    </div>
  </div>
</section>
</main>

<?php
include __DIR__ . '/includes/footer.php';
