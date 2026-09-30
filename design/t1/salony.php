<?php
$pageTitle = 'Салоны оптики — Lokamed';
$pageCss = 'assets/css/salon-page.css';
include __DIR__ . '/includes/header.php';
?>
<main>
<section class="section" style="border-top:none;padding-top:8px">
  <div class="container">
    <?php render_breadcrumbs([['label' => 'Салоны оптики']]); ?>

    <div class="section-head">
      <h1 style="font-size:clamp(1.6rem,1.3rem + 1.2vw,2.2rem)">Салоны оптики</h1>
      <p>7 салонов в Москве и Московской области. Ежедневно 10:00–21:00.</p>
    </div>

    <div class="footer-social" style="margin-bottom:32px">
      <a href="https://vk.com/club181764741" target="_blank" rel="nofollow noopener" aria-label="Мы во VK" style="--brand:#0077FF"><svg class="icon icon-fill"><use href="#i-vk"/></svg></a>
      <a href="https://max.ru/u/f9LHodD0cOKTe6ro9r64IzoKZelAw6oXIH-M5TfJ4Dxk-Jd-wX-toadDjWE" target="_blank" rel="nofollow noopener" aria-label="Мы в MAX" style="--brand:#6E49F5"><svg class="icon icon-fill"><use href="#i-max"/></svg></a>
      <a href="https://api.whatsapp.com/send?phone=79262772808" target="_blank" rel="nofollow noopener" aria-label="Мы в WhatsApp" style="--brand:#25D366"><svg class="icon"><use href="#i-whatsapp"/></svg></a>
      <a href="https://t.me/+79262772808" target="_blank" rel="nofollow noopener" aria-label="Мы в Telegram" style="--brand:#26A5E4"><svg class="icon"><use href="#i-telegram"/></svg></a>
      <a href="mailto:info@optika-lokamed.ru" target="_blank" rel="nofollow noopener" aria-label="Мы в Mail.ru" style="--brand:#168de2"><svg class="icon icon-fill"><use href="#i-mailru"/></svg></a>
      <a href="https://dzen.ru/lokamed" target="_blank" rel="nofollow noopener" aria-label="Мы в Dzen" style="--brand:#000000"><svg class="icon icon-fill"><use href="#i-dzen"/></svg></a>
    </div>

    <div class="salon-grid" id="salonGrid"></div>

    <div class="section-head" style="margin-top:48px">
      <h2 style="font-size:clamp(1.3rem,1.1rem + .8vw,1.7rem)">Все салоны на карте</h2>
    </div>
    <div class="salon-map-full">
      <iframe src="https://yandex.ru/map-widget/v1/?ll=37.2%2C55.93&z=9&pt=37.120382,55.980442,pm2rdl~37.169338,55.980596,pm2gnl~37.207248,56.002521,pm2gnl~37.291035,55.681189,pm2gnl~37.345371,55.85303,pm2gnl~37.162809,55.973924,pm2gnl~37.176742,55.980555,pm2gnl" width="100%" height="440" frameborder="0" title="Карта всех салонов Lokamed"></iframe>
    </div>
  </div>
</section>
</main>

<div class="modal-overlay" id="salonModal">
  <div class="modal-box" style="max-width:520px">
    <button class="modal-close" data-modal-close aria-label="Закрыть"><svg class="icon"><use href="#i-close"/></svg></button>
    <div class="salon-modal-media"><img id="salonModalImg" alt=""></div>
    <h3 id="salonModalName" style="margin-bottom:12px"></h3>
    <div class="salon-tile-addr" id="salonModalAddr" style="margin-bottom:10px"></div>
    <div class="salon-tile-hours" id="salonModalHours" style="margin-bottom:16px"></div>
    <div class="salon-modal-map"><iframe id="salonModalMap" src="" width="100%" height="220" frameborder="0" title="Карта салона"></iframe></div>
  </div>
</div>

<?php
$inlineScript = <<<'JS'
const SALONS = [
  { name: 'Андреевка', img: 'assets/img/salons/salon1.jpg', addr: '141551, М.О., Солнечногорский р-н, п. Андреевка, ул. Жилинская, д. 1 (ТЦ «Энергия», аптека Aloe)', lat: 55.980442, lon: 37.120382 },
  { name: 'Москва, центр', img: 'assets/img/salons/salon2.jpg', addr: '125310, Москва, Ангелов переулок, д. 8 (аптека Unifarm)', lat: 55.85303, lon: 37.345371 },
  { name: 'Зеленоград, к. 834В', img: 'assets/img/salons/salon3.jpg', addr: '124527, Москва, г. Зеленоград, к. 834В (аптека Aloe)', lat: 55.980555, lon: 37.176742 },
  { name: 'Зеленоград, к. 1824', img: 'assets/img/salons/salon1.jpg', addr: '124365, Москва, г. Зеленоград, к. 1824', lat: 55.980596, lon: 37.169338 },
  { name: 'Зеленоград, к. 2008', img: 'assets/img/salons/salon2.jpg', addr: '124365, Москва, г. Зеленоград, к. 2008 (аптека «Столички»)', lat: 55.973924, lon: 37.162809 },
  { name: 'Зеленоград, к. 241', img: 'assets/img/salons/salon3.jpg', addr: '124498, Москва, г. Зеленоград, к. 241 (аптека «Столички»)', lat: 56.002521, lon: 37.207248 },
  { name: 'Одинцово', img: 'assets/img/salons/salon1.jpg', addr: '143005, М.О., г. Одинцово, Можайское шоссе, д. 66Б (аптека «Ваша №1»)', lat: 55.681189, lon: 37.291035 },
];
Bundle.renderSalonList(SALONS);
JS;
include __DIR__ . '/includes/footer.php';
