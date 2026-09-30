<?php
$pageTitle = 'Вакансии — Lokamed';
$pageCss = 'assets/css/vakansii.css';
include __DIR__ . '/includes/header.php';
?>
<main>
<section class="section" style="border-top:none;padding-top:8px">
  <div class="container">
    <?php render_breadcrumbs([['label' => 'Вакансии']]); ?>

    <div class="section-head">
      <h1 style="font-size:clamp(1.6rem,1.3rem + 1.2vw,2.2rem)">Вакансии</h1>
      <p>Открытые позиции в сети салонов оптики Lokamed. Присоединяйтесь к команде!</p>
    </div>

    <div class="vacancy-grid" id="vacancyGrid"></div>
  </div>
</section>
</main>

<div class="modal-overlay" id="vacancyDetailsModal">
  <div class="modal-box">
    <button class="modal-close" data-modal-close aria-label="Закрыть"><svg class="icon"><use href="#i-close"/></svg></button>
    <h3 style="font-size:1.25rem;margin-bottom:6px" id="vacancyDetailsTitle">Вакансия</h3>
    <p style="font-size:.88rem;color:var(--ink-soft);margin-bottom:18px" id="vacancyDetailsSalon"></p>
    <div class="modal-body">
      <div class="vacancy-details">
        <p class="vacancy-details-meta">Требуемый опыт работы: 1–3 года · Полная занятость, полный день</p>

        <h4>Обязанности</h4>
        <ul>
          <li>Изготовление очков любой сложности, выполнение производственных этапов согласно технологических карт</li>
          <li>Контроль выполнения заказов</li>
        </ul>

        <h4>Требования</h4>
        <ul>
          <li>Опыт работы в сфере оптики по специальностям медицинская оптика, мастер-оптик; наличие сертификата специалиста по специальности «Медицинская оптика» будет преимуществом</li>
          <li>Ответственность, внимательность, пунктуальность, умение работать в команде</li>
        </ul>

        <h4>Условия</h4>
        <ul>
          <li>Оформление по ТК</li>
          <li>Заработная плата: оклад + бонусы</li>
          <li>Для кандидатов без опыта предоставляется бесплатное обучение</li>
        </ul>
      </div>
      <button class="btn btn-primary btn-block" id="vacancyDetailsApplyBtn">Откликнуться</button>
    </div>
  </div>
</div>

<div class="modal-overlay" id="vacancyModal">
  <div class="modal-box">
    <button class="modal-close" data-modal-close aria-label="Закрыть"><svg class="icon"><use href="#i-close"/></svg></button>
    <h3 style="font-size:1.25rem;margin-bottom:6px" id="vacancyModalTitle">Отклик на вакансию</h3>
    <p style="font-size:.88rem;color:var(--ink-soft);margin-bottom:18px" id="vacancyModalSalon"></p>
    <div class="modal-body">
      <form data-modal-form>
        <label class="field-label">Ваше имя <span class="req">*</span></label>
        <input class="field-input" type="text" name="name" required>

        <label class="field-label">Телефон <span class="req">*</span></label>
        <input class="field-input" type="tel" name="phone" data-phone-mask placeholder="+7 (___) ___-__-__" required>

        <label class="field-label">Комментарий (опыт работы, вопросы)</label>
        <textarea class="field-input" name="comment" rows="3" style="resize:vertical"></textarea>

        <button class="btn btn-primary btn-block" type="submit">Откликнуться</button>
      </form>
    </div>
  </div>
</div>

<?php
$inlineScript = <<<'JS'
const VACANCIES = [
  { title: 'Продавец-консультант', salary: 'от 55 000 ₽', salon: 'Салон Зеленоград, к. 1824', desc: 'Консультирование покупателей, подбор оправ и линз, работа с кассой. Обучение продукту предоставляется.' },
  { title: 'Оптометрист', salary: 'от 75 000 ₽', salon: 'Салон Одинцово', desc: 'Проверка зрения, подбор коррекции, консультации по контактным линзам. Наличие диплома обязательно.' },
  { title: 'Мастер по ремонту очков', salary: 'от 60 000 ₽', salon: 'Салон Москва, центр', desc: 'Мелкий ремонт оправ, замена линз, подгонка очков по лицу клиента.' },
  { title: 'Администратор салона оптики', salary: 'от 50 000 ₽', salon: 'Салон Андреевка', desc: 'Организация работы салона, ведение графика записи, контроль наличия товара.' },
  { title: 'Продавец-консультант', salary: 'от 55 000 ₽', salon: 'Салон Зеленоград, к. 2008', desc: 'Консультирование покупателей, подбор оправ и линз, работа с кассой. Обучение продукту предоставляется.' },
  { title: 'Менеджер интернет-магазина', salary: 'от 65 000 ₽', salon: 'Удалённо / Москва', desc: 'Обработка заказов с сайта, консультации клиентов по телефону и в чате, работа с CRM.' },
];
Bundle.initVacancies(VACANCIES);
JS;
include __DIR__ . '/includes/footer.php';
