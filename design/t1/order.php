<?php
$pageTitle = 'Оформление заказа — Lokamed';
$pageCss = 'assets/css/order.css';
include __DIR__ . '/includes/header.php';
?>
<main>
<section class="section" style="border-top:none;padding-top:8px">
  <div class="container">
    <?php render_breadcrumbs([['label' => 'Оформление заказа']]); ?>

    <div class="section-head">
      <h1 style="font-size:clamp(1.6rem,1.3rem + 1.2vw,2.2rem)">Оформление заказа</h1>
    </div>

    <div class="order-layout" id="orderLayout">
      <form id="orderForm">

        <div class="order-step">
          <div class="order-step-head">
            <h2>1. Регион доставки</h2>
            <a href="javascript:void(0)" class="order-step-edit">изменить</a>
          </div>
          <div class="order-step-body"><strong>Ваш город:</strong> Москва, Центр, Россия</div>
        </div>

        <div class="order-step is-collapsible" id="orderStepDelivery">
          <div class="order-step-head">
            <h2>2. Доставка</h2>
            <a href="javascript:void(0)" class="order-step-edit" data-step-toggle="orderStepDelivery">изменить</a>
          </div>
          <div class="order-step-summary" id="orderStepDeliverySummary">Курьером по Москве и области</div>
          <div class="order-step-body">
            <div class="order-option-grid">
              <label class="order-option-card is-selected" data-group="delivery">
                <input type="radio" name="delivery" value="courier" id="orderDeliveryCourier" checked>
                <svg class="icon order-option-icon"><use href="#i-truck"/></svg>
                <div class="order-option-title">Курьером</div>
                <div class="order-option-cost">по Москве и области</div>
              </label>
              <label class="order-option-card" data-group="delivery">
                <input type="radio" name="delivery" value="pickup" id="orderDeliveryPickup">
                <svg class="icon order-option-icon"><use href="#i-pin"/></svg>
                <div class="order-option-title">Самовывоз</div>
                <div class="order-option-cost">из салона, бесплатно</div>
              </label>
            </div>
            <div id="orderAddressWrap">
              <label class="field-label">Адрес доставки <span class="req">*</span></label>
              <input class="field-input" type="text" name="address">
            </div>
            <div id="orderSalonWrap" style="display:none">
              <label class="field-label">Салон для самовывоза</label>
              <select class="field-input" name="salon">
                <option>Одинцово, Можайское ш., 66 б</option>
                <option>Зеленоград, к. 2008</option>
                <option>Жилинская ул., 1, Андреевка</option>
                <option>Ангелов пер., 8, Москва</option>
                <option>Зеленоград, к. 1824</option>
                <option>Зеленоград, к. 834А</option>
                <option>Зеленоград, к. 241</option>
              </select>
            </div>
          </div>
        </div>

        <div class="order-step is-collapsible" id="orderStepPayment">
          <div class="order-step-head">
            <h2>3. Оплата</h2>
            <a href="javascript:void(0)" class="order-step-edit" data-step-toggle="orderStepPayment">изменить</a>
          </div>
          <div class="order-step-summary" id="orderStepPaymentSummary">Онлайн картой</div>
          <div class="order-step-body">
            <div class="order-option-grid">
              <label class="order-option-card is-selected" data-group="payment">
                <input type="radio" name="payment" value="online" checked>
                <div class="order-option-title">Онлайн картой</div>
                <div class="order-option-cost">Visa, Mastercard, МИР</div>
              </label>
              <label class="order-option-card" data-group="payment">
                <input type="radio" name="payment" value="cash">
                <div class="order-option-title">Наличными или картой</div>
                <div class="order-option-cost">при получении</div>
              </label>
            </div>
          </div>
        </div>

        <div class="order-step is-collapsible" id="orderStepBuyer">
          <div class="order-step-head">
            <h2>4. Покупатель</h2>
            <a href="javascript:void(0)" class="order-step-edit" data-step-toggle="orderStepBuyer">изменить</a>
          </div>
          <div class="order-step-summary" id="orderStepBuyerSummary">Укажите контактные данные</div>
          <div class="order-step-body">
            <label class="field-label">Ваше имя <span class="req">*</span></label>
            <input class="field-input" type="text" name="name" required>

            <label class="field-label">Телефон <span class="req">*</span></label>
            <input class="field-input" type="tel" name="phone" data-phone-mask placeholder="+7 (___) ___-__-__" required>

            <label class="field-label">E-mail</label>
            <input class="field-input" type="email" name="email">

            <label class="field-label">Комментарий к заказу</label>
            <textarea class="field-input" name="comment" rows="3" style="resize:vertical"></textarea>
          </div>
        </div>

        <div class="order-step is-collapsible" id="orderStepConfirm">
          <div class="order-step-head">
            <h2>5. Подтвердите Ваш заказ</h2>
            <a href="javascript:void(0)" class="order-step-edit" data-step-toggle="orderStepConfirm">изменить</a>
          </div>
          <div class="order-step-summary" id="orderStepConfirmSummary">Товаров: 0</div>
          <div class="order-step-body">
            <div id="orderItems"></div>
            <div class="order-coupon">
              <input class="field-input" type="text" id="orderCouponInput" placeholder="Промокод">
              <button class="btn btn-outline" type="button" id="orderCouponBtn">Применить</button>
            </div>
          </div>
        </div>

        <button class="btn btn-primary btn-block" type="submit">Оформить заказ</button>
      </form>

      <div class="order-summary">
        <h3>Ваш заказ</h3>
        <div class="order-summary-line"><span>Товаров (<span id="orderSummaryCount">0</span>)</span><span id="orderSummarySubtotal">0 ₽</span></div>
        <div class="order-summary-line"><span>Доставка</span><span id="orderSummaryDelivery">бесплатно</span></div>
        <div class="order-summary-total"><span>Итого</span><strong id="orderTotal">0 ₽</strong></div>
        <button class="btn btn-primary btn-block" type="submit" form="orderForm" style="margin-top:14px">Оформить заказ</button>
      </div>
    </div>

    <div class="modal-thanks" id="orderThanks" style="display:none;padding:40px 0">
      <div class="icon-wrap"><svg class="icon" style="width:26px;height:26px"><use href="#i-check"/></svg></div>
      <h4>Заказ оформлен!</h4>
      <p>Мы свяжемся с вами в ближайшее время для подтверждения заказа.</p>
      <a href="index.php" class="btn btn-primary" style="margin-top:14px">На главную</a>
    </div>
  </div>
</section>
</main>

<?php
$inlineScript = 'Bundle.initOrder();';
include __DIR__ . '/includes/footer.php';
