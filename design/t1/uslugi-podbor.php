<?php
$pageTitle = 'Подбор оправ и очковых линз — Lokamed';
$extraHeadLinks = ['assets/css/article-page.css', 'assets/css/uslugi-other.css'];
include __DIR__ . '/includes/header.php';
?>
<main>
<section class="section" style="border-top:none;padding-top:8px">
  <div class="container">
    <?php render_breadcrumbs([['label' => 'Услуги', 'href' => 'uslugi.php'], ['label' => 'Подбор оправ и очковых линз']]); ?>

    <div class="blog-detail">
      <h1 style="margin-bottom:20px">Подбор оправ и очковых линз</h1>

      <div class="blog-detail-body">
        <h2>Как проходит подбор</h2>
        <p>Специалисты Lokamed проводят комплексную диагностику зрения и консультируют по вопросам коррекции, помогая подобрать линзы любой сложности — однофокальные, бифокальные, прогрессивные, а также для астигматизма.</p>

        <h2>Почему важно регулярно проверять зрение</h2>
        <ul>
          <li>Раннее выявление близорукости, дальнозоркости, астигматизма и глаукомы на начальной стадии</li>
          <li>Своевременная коррекция зрения подходящими очками или контактными линзами</li>
          <li>Профилактика дальнейшего ухудшения зрения</li>
          <li>Возможность заметить не связанные со зрением проблемы со здоровьем</li>
          <li>Комфорт в повседневных делах — чтении, вождении, работе</li>
        </ul>

        <h2>Ассортимент</h2>
        <p>Оправы — международные бренды Ray-Ban, Polaroid, Vogue, Silhouette разных форм (круглые, прямоугольные, «кошачий глаз») и цветов. Линзы подбираются индивидуально по оптической силе, диаметру, межзрачковому расстоянию и аддидации — прозрачные и тонированные, монофокальные, асферические, бифокальные и другие варианты.</p>
      </div>

      <div class="blog-detail-cta">
        <p>Запишитесь на подбор оправы и линз в ближайший салон Lokamed.</p>
        <a href="salony.php" class="btn btn-primary">Найти салон</a>
      </div>
    </div>

    <div class="uslugi-other">
      <a href="uslugi.php">← Все услуги</a>
      <a href="uslugi-zamena-linz.php">Замена линз</a>
      <a href="uslugi-remont.php">Ремонт очков</a>
      <a href="uslugi-proverka-zreniya.php">Проверка зрения</a>
    </div>
  </div>
</section>
</main>

<?php
include __DIR__ . '/includes/footer.php';
