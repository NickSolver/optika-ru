<?php
/**
 * Shared salon-location page content. Expects $salon set before include:
 *   breadcrumbLabel, h1, description, mapH2, mapIframeSrc, mapIframeTitle
 */
?>
<main>
<section class="section" style="border-top:none;padding-top:8px">
  <div class="container">
    <?php render_breadcrumbs([['label' => 'Салоны оптики', 'href' => 'salony.php'], ['label' => $salon['breadcrumbLabel']]]); ?>

    <div class="section-head">
      <h1 style="font-size:clamp(1.6rem,1.3rem + 1.2vw,2.2rem)"><?= $salon['h1'] ?></h1>
      <p><?= $salon['description'] ?></p>
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
      <h2 style="font-size:clamp(1.3rem,1.1rem + .8vw,1.7rem)"><?= $salon['mapH2'] ?></h2>
    </div>
    <div class="salon-map-full">
      <iframe src="<?= $salon['mapIframeSrc'] ?>" width="100%" height="440" frameborder="0" title="<?= $salon['mapIframeTitle'] ?>"></iframe>
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
