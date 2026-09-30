export function initOtzyvy() {
  const selectorOptik = document.getElementById('selectorOptik');
  const widget = document.getElementById('widget');
  selectorOptik.addEventListener('change', () => {
    widget.src = `https://yandex.ru/maps-reviews-widget/${selectorOptik.value}?comments`;
  });
}
