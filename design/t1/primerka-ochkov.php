<?php
$pageTitle = 'Примерка очков онлайн — Lokamed';
$pageCss = 'assets/css/primerka-ochkov.css';
include __DIR__ . '/includes/header.php';
?>
<main>
<section class="section" style="border-top:none;padding-top:8px">
  <div class="container">
    <?php render_breadcrumbs([['label' => 'Примерка очков']]); ?>

    <div class="section-head">
      <h1 style="font-size:clamp(1.6rem,1.3rem + 1.2vw,2.2rem)">Примерка очков онлайн</h1>
      <p>Загрузите своё фото анфас, выберите оправу — мы автоматически определим лицо и подберём размер и положение очков.</p>
    </div>

    <div class="tryon-layout">
      <div class="tryon-canvas-wrap">
        <p class="tryon-placeholder" id="tryonPlaceholder">Здесь появится фото с примеркой</p>
        <canvas id="tryonCanvas"></canvas>
        <p class="tryon-status" id="tryonStatus">Загружаем модель распознавания лица…</p>
        <div class="tryon-actions">
          <label class="btn btn-primary" style="cursor:pointer">
            Загрузить фото
            <input type="file" accept="image/*" id="tryonFileInput" style="display:none">
          </label>
          <button type="button" class="btn btn-outline" id="tryonResetBtn" style="display:none">Сбросить</button>
        </div>
      </div>

      <div class="tryon-side">
        <h3>Выберите оправу</h3>
        <div class="tryon-glasses-list" id="tryonGlassesList"></div>
        <p class="tryon-note">Фото обрабатывается прямо в браузере и никуда не отправляется. Для лучшего результата используйте фото анфас при хорошем освещении, без очков и с открытыми глазами.</p>
      </div>
    </div>
  </div>
</section>
</main>

<?php
$vendorScripts = ['assets/vendor/face-api/face-api.js'];
$inlineScript = <<<'JS'
const GLASSES = [
  { id: 1, name: 'Оправа Lokamed 34133 C6-2', img: 'assets/img/product1.png' },
  { id: 2, name: 'Оправа Lokamed 37059 C9', img: 'assets/img/product2.png' },
  { id: 3, name: 'Оправа Lokamed 34132 C6-1', img: 'assets/img/product3.png' },
  { id: 4, name: 'Оправа Lokamed 34125 C2', img: 'assets/img/product4.png' },
];
Bundle.initTryOn(GLASSES);
JS;
include __DIR__ . '/includes/footer.php';
