import { openModal, closeModal } from '../shared.js';

export function initVacancies(VACANCIES) {
  const vacancyGrid = document.getElementById('vacancyGrid');
  vacancyGrid.innerHTML = VACANCIES.map((v, i) => `
    <div class="vacancy-card" data-vacancy-card="${i}">
      <h3>${v.title}</h3>
      <div class="vacancy-salary">${v.salary}</div>
      <div class="vacancy-meta"><svg class="icon"><use href="#i-pin"/></svg>${v.salon}</div>
      <p>${v.desc}</p>
      <button class="btn btn-primary btn-block" data-vacancy="${i}">Откликнуться</button>
    </div>
  `).join('');

  function openApplyModal(v) {
    document.getElementById('vacancyModalTitle').textContent = `Отклик на вакансию: ${v.title}`;
    document.getElementById('vacancyModalSalon').textContent = v.salon;
    openModal(document.getElementById('vacancyModal'));
  }

  let vacancyDetailsCurrent = null;

  vacancyGrid.addEventListener('click', (e) => {
    const btn = e.target.closest('[data-vacancy]');
    if (btn) {
      openApplyModal(VACANCIES[Number(btn.dataset.vacancy)]);
      return;
    }
    const card = e.target.closest('[data-vacancy-card]');
    if (card) {
      const v = VACANCIES[Number(card.dataset.vacancyCard)];
      vacancyDetailsCurrent = v;
      document.getElementById('vacancyDetailsTitle').textContent = v.title;
      document.getElementById('vacancyDetailsSalon').textContent = v.salon;
      openModal(document.getElementById('vacancyDetailsModal'));
    }
  });

  document.getElementById('vacancyDetailsApplyBtn').addEventListener('click', () => {
    closeModal(document.getElementById('vacancyDetailsModal'));
    if (vacancyDetailsCurrent) openApplyModal(vacancyDetailsCurrent);
  });
}
