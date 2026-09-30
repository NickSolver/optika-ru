<?php
$pageTitle = 'Условия покупки — Lokamed';
$pageCss = 'assets/css/spoiler.css';
include __DIR__ . '/includes/header.php';
?>
<main>
<section class="section" style="border-top:none;padding-top:8px">
  <div class="container">
    <?php render_breadcrumbs([['label' => 'Условия покупки']]); ?>

    <div class="section-head">
      <h1 style="font-size:clamp(1.6rem,1.3rem + 1.2vw,2.2rem)">Условия покупки</h1>
      <p>Оплата, доставка, обмен и возврат товаров, гарантии изготовителя.</p>
    </div>

    <div class="spoiler-list" id="spoilerList">
      <div class="spoiler is-open">
        <div class="spoiler-head"><span>Оплата</span><svg class="icon"><use href="#i-chev-up"/></svg></div>
        <div class="spoiler-body">
          <div class="spoiler-body-inner">
            <h4>Наличный расчёт</h4>
            <p>Оплата производится наличными курьеру при доставке или в салоне оптики при самовывозе.</p>
            <h4>Оплата банковской картой</h4>
            <p>Принимаем карты Visa, MasterCard и МИР через защищённый SSL-шлюз Сбербанка — данные карты не передаются и не хранятся на сервере магазина.</p>
            <h4>Оплата курьеру при получении</h4>
            <p>Наличными или банковской картой прямо в руки курьеру в момент доставки заказа.</p>
          </div>
        </div>
      </div>

      <div class="spoiler">
        <div class="spoiler-head"><span>Доставка</span><svg class="icon"><use href="#i-chev-up"/></svg></div>
        <div class="spoiler-body">
          <div class="spoiler-body-inner">
            <h4>Доставка курьером</h4>
            <ul>
              <li>Бесплатно по Зеленограду</li>
              <li>Бесплатно по Москве и Московской области при заказе от 5 000 ₽</li>
              <li>От 200 ₽ при доставке в другие регионы России</li>
            </ul>
            <h4>Самовывоз</h4>
            <p>Ежедневно с 10:00 до 21:00 в любом из 7 салонов сети в Москве и Московской области.</p>
          </div>
        </div>
      </div>

      <div class="spoiler">
        <div class="spoiler-head"><span>Обмен и возврат товаров</span><svg class="icon"><use href="#i-chev-up"/></svg></div>
        <div class="spoiler-body">
          <div class="spoiler-body-inner">
            <p>Контактные линзы, растворы для линз и капли для глаз — медицинские изделия, не подлежащие возврату и обмену согласно перечню непродовольственных товаров надлежащего качества, утверждённому Правительством РФ. Подарочные сертификаты также не подлежат возврату.</p>
            <h4>Товар надлежащего качества</h4>
            <p>Можно вернуть или обменять в течение 14 дней, не считая дня покупки, при сохранении товарного вида, потребительских свойств и документа, подтверждающего покупку.</p>
            <h4>Товар с производственным браком</h4>
            <p>Обменивается или возвращается согласно закону «О защите прав потребителей». Продавец вправе провести проверку качества товара. Возврат денежных средств осуществляется в течение 10 дней с момента получения претензии.</p>
            <p>Для оформления претензии напишите на <a href="mailto:info@optika-lokamed.ru" style="color:var(--green-dark)">info@optika-lokamed.ru</a>, указав номер заказа, ФИО и контактный телефон.</p>
          </div>
        </div>
      </div>

      <div class="spoiler">
        <div class="spoiler-head"><span>Гарантии изготовителя</span><svg class="icon"><use href="#i-chev-up"/></svg></div>
        <div class="spoiler-body">
          <div class="spoiler-body-inner">
            <p>На соединение линз с оправой действует гарантия 6 месяцев с даты покупки при соблюдении правил эксплуатации и ухода за очками.</p>
            <p>Гарантия не распространяется на механические повреждения (сколы, трещины, погнутость оправы) и естественный износ изделия.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
</main>

<?php
include __DIR__ . '/includes/footer.php';
