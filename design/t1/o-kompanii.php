<?php
$pageTitle = 'О компании — Lokamed';
$extraHeadLinks = ['assets/vendor/fancybox/fancybox.css'];
$pageCss = 'assets/css/o-kompanii.css';
include __DIR__ . '/includes/header.php';
?>
<main>
<section class="section" style="border-top:none;padding-top:8px">
  <div class="container">
    <?php render_breadcrumbs([['label' => 'О компании']]); ?>

    <div class="section-head">
      <h1 style="font-size:clamp(1.6rem,1.3rem + 1.2vw,2.2rem)">О компании</h1>
    </div>

    <div class="about-text">
      <p>Наш салон оптики Lokamed уже 21 год (c 2005 года) работает на рынке города Москвы и области!</p>
      <p>Наша задача — помочь вам лучше видеть и лучше выглядеть. Мы являемся официальными дистрибьюторами многих известных брендов в России и поставляем только 100% оригинальные брендовые оправы, солнцезащитные очки и контактные линзы.</p>
      <p>У нас работают профессионалы высочайшего класса, которые смогут воплотить практически любую вашу задумку в жизнь, а также помогут подобрать очки, в которые вы точно влюбитесь.</p>
      <p>В наших салонах оптики мы проводим достаточно большой спектр услуг от подбора правильной оправы и линз до ремонта уже ваших изделий. Услуга бесплатной проверки зрения для подбора очков предоставляется покупателям 18+.</p>
      <p>Наши цены весьма гибкие и лояльные, мы предлагаем различные сезонные акции, во время которых вы можете получить скидку.</p>
      <p>Будем рады приветствовать вас в наших салонах оптики в Москве и области. Звоните, и наши специалисты ответят на все ваши вопросы. Еженедельное обновление ассортимента.</p>
    </div>

    <div class="about-figures" style="max-width:600px;margin-top:8px">
      <div class="about-figure"><strong>21 год</strong><span>на рынке оптики</span></div>
      <div class="about-figure"><strong>7</strong><span>салонов в Москве и области</span></div>
      <div class="about-figure"><strong>50 000+</strong><span>довольных клиентов</span></div>
      <div class="about-figure"><strong>100%</strong><span>оригинальная продукция</span></div>
    </div>

    <div class="section-head" style="margin-top:48px">
      <h2 style="font-size:clamp(1.3rem,1.1rem + .8vw,1.7rem)">Наши салоны</h2>
      <p>Нажмите на фото, чтобы посмотреть в полном размере</p>
    </div>
    <div class="about-gallery" id="aboutGallery">
      <a href="assets/img/about/photo1.jpg" data-fancybox="about-gallery" class="about-gallery-item"><img src="assets/img/about/photo1.jpg" alt="Салон оптики Lokamed — фото 1"></a>
      <a href="assets/img/about/photo2.jpg" data-fancybox="about-gallery" class="about-gallery-item"><img src="assets/img/about/photo2.jpg" alt="Салон оптики Lokamed — фото 2"></a>
      <a href="assets/img/about/photo3.jpg" data-fancybox="about-gallery" class="about-gallery-item"><img src="assets/img/about/photo3.jpg" alt="Салон оптики Lokamed — фото 3"></a>
      <a href="assets/img/about/photo4.jpg" data-fancybox="about-gallery" class="about-gallery-item"><img src="assets/img/about/photo4.jpg" alt="Салон оптики Lokamed — фото 4"></a>
      <a href="assets/img/about/photo5.jpg" data-fancybox="about-gallery" class="about-gallery-item"><img src="assets/img/about/photo5.jpg" alt="Салон оптики Lokamed — фото 5"></a>
      <a href="assets/img/about/photo6.jpg" data-fancybox="about-gallery" class="about-gallery-item"><img src="assets/img/about/photo6.jpg" alt="Салон оптики Lokamed — фото 6"></a>
      <a href="assets/img/about/photo7.jpg" data-fancybox="about-gallery" class="about-gallery-item"><img src="assets/img/about/photo7.jpg" alt="Салон оптики Lokamed — фото 7"></a>
    </div>

    <div style="margin-top:44px;padding-top:32px;border-top:1px solid var(--border-soft);max-width:600px">
      <h3 style="margin-bottom:16px">Реквизиты</h3>
      <p style="font-size:.88rem;color:var(--ink-soft);line-height:2">
        ИП Исаева Елена Николаевна<br>
        ИНН 460700049508<br>
        ОГРНИП 324508100653686<br>
        Адрес: Московская область, Красногорский р-н, дер. Путилково<br>
        Телефон: <a href="tel:+79262772808" style="color:var(--green-dark)">+7 (926) 277-28-08</a><br>
        E-mail: <a href="mailto:info@optika-lokamed.ru" style="color:var(--green-dark)">info@optika-lokamed.ru</a>
      </p>
    </div>
  </div>
</section>
</main>

<?php
$vendorScripts = ['assets/vendor/fancybox/fancybox.umd.js'];
$inlineScript = 'Bundle.initAboutGallery();';
include __DIR__ . '/includes/footer.php';
