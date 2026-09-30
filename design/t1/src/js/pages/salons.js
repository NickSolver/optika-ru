import { openModal } from '../shared.js';

const HOURS = 'Ежедневно 10:00–21:00';

/**
 * Renders the #salonGrid tile list + wires the click-to-open-#salonModal behavior.
 * Shared by odincovo.php, solnechnogorsk.php, zelenograd.php, salony.php - each
 * passes its own SALONS array inline (the only thing that differs between them).
 */
export function renderSalonList(SALONS) {
  const salonGrid = document.getElementById('salonGrid');
  salonGrid.innerHTML = SALONS.map((s, i) => `
    <div class="salon-tile" data-i="${i}">
      <div class="salon-tile-media"><img src="${s.img}" alt="Салон оптики: ${s.name}"></div>
      <div class="salon-tile-body">
        <h3>${s.name}</h3>
        <div class="salon-tile-addr"><svg class="icon"><use href="#i-pin"/></svg>${s.addr}</div>
        <div class="salon-tile-hours"><svg class="icon"><use href="#i-clock"/></svg>${HOURS}</div>
      </div>
    </div>
  `).join('');

  salonGrid.querySelectorAll('.salon-tile').forEach(tile => {
    tile.addEventListener('click', () => {
      const s = SALONS[Number(tile.dataset.i)];
      document.getElementById('salonModalImg').src = s.img;
      document.getElementById('salonModalName').textContent = s.name;
      document.getElementById('salonModalAddr').innerHTML = `<svg class="icon"><use href="#i-pin"/></svg>${s.addr}`;
      document.getElementById('salonModalHours').innerHTML = `<svg class="icon"><use href="#i-clock"/></svg>${HOURS}`;
      document.getElementById('salonModalMap').src = `https://yandex.ru/map-widget/v1/?ll=${s.lon}%2C${s.lat}&z=15&pt=${s.lon},${s.lat},pm2rdl`;
      openModal(document.getElementById('salonModal'));
    });
  });
}
