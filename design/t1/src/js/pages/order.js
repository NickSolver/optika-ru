import { CART, renderCart, clearCart } from '../shared.js';

export function initOrder() {
  function renderOrderItems() {
    const wrap = document.getElementById('orderItems');
    if (!CART.length) {
      wrap.innerHTML = '<p class="order-empty">Корзина пуста</p>';
    } else {
      wrap.innerHTML = CART.map(item => `
        <div class="order-basket-item">
          <img src="${item.img}" alt="${item.name}">
          <div class="order-basket-item-info">
            <div class="order-basket-item-name">${item.name}</div>
            <div class="order-basket-item-meta">${item.qty} × ${item.price.toLocaleString('ru-RU')} ₽</div>
          </div>
          <div class="order-basket-item-sum">${(item.price * item.qty).toLocaleString('ru-RU')} ₽</div>
        </div>
      `).join('');
    }
    const total = CART.reduce((sum, item) => sum + item.price * item.qty, 0);
    const count = CART.reduce((sum, item) => sum + item.qty, 0);
    document.getElementById('orderSummaryCount').textContent = count;
    document.getElementById('orderSummarySubtotal').textContent = total.toLocaleString('ru-RU') + ' ₽';
    document.getElementById('orderTotal').textContent = total.toLocaleString('ru-RU') + ' ₽';
    document.getElementById('orderStepConfirmSummary').textContent = `Товаров: ${count} на сумму ${total.toLocaleString('ru-RU')} ₽`;
  }
  renderOrderItems();

  /* ---------- Collapsible steps ---------- */
  document.querySelectorAll('[data-step-toggle]').forEach(link => {
    link.addEventListener('click', () => {
      document.getElementById(link.dataset.stepToggle).classList.add('is-expanded');
    });
  });

  document.querySelectorAll('input[name="delivery"]').forEach(input => {
    input.addEventListener('change', () => {
      document.querySelectorAll('.order-option-card[data-group="delivery"]').forEach(card => {
        card.classList.toggle('is-selected', card.querySelector('input').checked);
      });
      document.getElementById('orderAddressWrap').style.display = document.getElementById('orderDeliveryCourier').checked ? '' : 'none';
      document.getElementById('orderSalonWrap').style.display = document.getElementById('orderDeliveryPickup').checked ? '' : 'none';
      document.getElementById('orderStepDeliverySummary').textContent = document.getElementById('orderDeliveryCourier').checked ? 'Курьером по Москве и области' : 'Самовывоз из салона';
    });
  });
  document.querySelectorAll('input[name="payment"]').forEach(input => {
    input.addEventListener('change', () => {
      document.querySelectorAll('.order-option-card[data-group="payment"]').forEach(card => {
        card.classList.toggle('is-selected', card.querySelector('input').checked);
      });
      document.getElementById('orderStepPaymentSummary').textContent = document.querySelector('input[name="payment"]:checked').value === 'online' ? 'Онлайн картой' : 'Наличными или картой при получении';
    });
  });
  document.getElementById('orderCouponBtn').addEventListener('click', () => {
    const input = document.getElementById('orderCouponInput');
    if (input.value.trim()) input.placeholder = 'Промокод применён';
    input.value = '';
  });

  document.getElementById('orderForm').addEventListener('submit', (e) => {
    e.preventDefault();
    clearCart();
    renderCart();
    document.getElementById('orderLayout').style.display = 'none';
    document.getElementById('orderThanks').style.display = '';
  });
}
