<?php
$pageTitle = 'Оправы для очков — Каталог — Lokamed';
$pageCss = 'assets/css/catalog-section.css';
include __DIR__ . '/includes/header.php';
?>
<main>
<section class="section" style="border-top:none;padding-top:8px">
<div class="container">
  <?php render_breadcrumbs([['label' => 'Каталог', 'href' => 'catalog.php'], ['label' => 'Оправы для очков']]); ?>

  <div class="catalog-head">
    <div>
      <h1 style="font-size:clamp(1.6rem,1.3rem + 1.2vw,2.2rem)">Оправы для очков</h1>
      <div class="catalog-count" id="catalogCount">Найдено 36 товаров</div>
    </div>
  </div>

  <div class="tag-pills" id="tagPills"></div>

  <div class="sort-bar">
    <div class="sort-buttons">
      <button class="sort-btn" data-sort="name" id="sortByName"><svg class="icon"><use href="#i-arrow-right"/></svg>По названию</button>
      <button class="sort-btn" data-sort="price" id="sortByPrice"><svg class="icon"><use href="#i-arrow-right"/></svg>По цене</button>
    </div>
    <div class="per-page-row">
      Показывать по:
      <button data-per="36" class="is-active">36</button>
      <button data-per="48">48</button>
      <button data-per="72">72</button>
    </div>
  </div>

  <div class="catalog-grid" id="catalogGrid"></div>

  <div class="show-more-row">
    <button class="btn btn-outline" id="showMoreBtn">Показать ещё</button>
  </div>
  <div class="pagination" id="pagination"></div>

  <div class="catalog-seo-text">
    <p>Салон оптики Lokamed предлагает большой выбор очков для зрения по доступным ценам. В нашем каталоге вы можете купить оправу любого размера как для взрослого, так и для ребенка. Мы поставляем продукцию проверенных брендов, среди которых Givenchy, Hugo, Orange Boss и другие марки, которым доверяют во всем мире.</p>
    <p>Основное преимущество нашего ассортимента – разнообразие моделей, которое позволит вам найти и купить оправу для очков в вашем вкусе, каким бы оригинальным он ни был. Продажа брендовых оправ для очков для зрения возможна как оптом, так и в розницу. Мы рады сотрудничеству с торговыми организациями из регионов России и частным покупателям, которые решили сделать свое видение мира еще более ярким и четким!</p>
    <h2>Купить очки для зрения в интернет магазине – легко!</h2>
    <p>Оптика Lokamed представлена большим числом специализированных салонов, расположенных в Москве и Московской области. Стремясь удовлетворить запросы наших покупателей, мы расширили зону обслуживания за счет интернет-магазина optika-lokamed.ru, который существенно облегчает выбор подходящих оправ для очков в каталоге.</p>
    <p>Используйте фильтр, чтобы задать требуемые параметры оправы для очков: цены, формы и материала, бренда и т. д. Понравившийся товар добавьте в Корзину и заполните предлагаемую форму заявки. Если у вас есть вопросы по доставке или вы хотели бы записаться на бесплатную проверку зрения, то оставьте на сайте свои контакты, чтобы наши специалисты могли вам позвонить.</p>
    <h2>Ассортимент оправ для очков и цены</h2>
    <p>У наших покупателей есть возможность купить оправу для очков для зрения через интернет-магазин в Москве или оставить заявку на изготовление изделия на заказ, по рецепту. Стоимость готовых моделей будет несколько ниже, поскольку их производство носит массовый характер. В ассортименте представлены мужские, женские и детские оправы для очков, которые подходят для ношения с корректирующими или <a href="/product/solncezaschitnye-ochki/">солнцезащитными</a> линзами. Цена очков для зрения зависит от материалов, производителя, особенностей дизайна изделия и бренда. Эксклюзивные модные аксессуары будут стоить существенно дороже.</p>
    <p>Если у вас сложные нарушения зрения или вы имеете высокие требования к оправе своих очков, то вам подойдет обслуживание на заказ. Наши мастера проведут точную подгонку оптической линзы под выбранную вами оправу, на все работы дается гарантия.</p>
    <h2>Женские очки для зрения</h2>
    <p>В сети оптик Lokamed представлена большая коллекция женских очков для зрения. Если вы не знаете, очки с какими диоптриями вам необходимы, то всегда можете воспользоваться услугой бесплатной проверки зрения в любой из наших оптик.</p>
    <p>Если у вас уже есть очки и требуется сменить только линзы для оправы, вы также можете проверить зрение у нас или прийти с готовым рецептом на очки.</p>
  </div>
</div>
</section>
</main>

<button class="filter-fab" id="filterFab"><svg class="icon" style="width:18px;height:18px"><use href="#i-filter"/></svg>Фильтр</button>
<div class="filter-scrim" id="filterScrim"></div>
<aside class="filter-panel" id="filterPanel">
  <div class="filter-panel-head">
    <h3>Фильтр</h3>
    <button class="icon-sq" id="filterClose" aria-label="Закрыть фильтр"><svg class="icon"><use href="#i-close"/></svg></button>
  </div>
  <div class="filter-panel-body">
    <div class="filter-group">
      <h4>Цена, ₽</h4>
      <div class="price-range">
        <div class="price-range-track"><div class="price-range-fill" id="priceFill"></div></div>
        <input type="range" id="priceMinRange" min="1000" max="25000" step="100" value="1000">
        <input type="range" id="priceMaxRange" min="1000" max="25000" step="100" value="25000">
      </div>
      <div class="price-range-values"><span id="priceMinLabel">1 000 ₽</span><span id="priceMaxLabel">25 000 ₽</span></div>
      <div class="price-input-row">
        <input type="number" id="priceMinInput" class="filter-search" placeholder="От" min="1000" max="25000" step="100">
        <span>—</span>
        <input type="number" id="priceMaxInput" class="filter-search" placeholder="До" min="1000" max="25000" step="100">
      </div>
    </div>

    <div class="filter-group" data-group="gender">
      <h4>Пол</h4>
      <input type="text" class="filter-search" placeholder="Поиск...">
      <div class="filter-options"></div>
    </div>

    <div class="filter-group" data-group="color">
      <h4>Цвет оправы</h4>
      <input type="text" class="filter-search" placeholder="Поиск...">
      <div class="filter-options"></div>
    </div>

    <div class="filter-group" data-group="shape">
      <h4>Форма</h4>
      <input type="text" class="filter-search" placeholder="Поиск...">
      <div class="filter-options"></div>
    </div>

    <div class="filter-group" data-group="material">
      <h4>Материал</h4>
      <input type="text" class="filter-search" placeholder="Поиск...">
      <div class="filter-options"></div>
    </div>

    <div class="filter-group" data-group="brand">
      <h4>Бренд</h4>
      <input type="text" class="filter-search" placeholder="Поиск...">
      <div class="filter-options"></div>
    </div>

    <div class="filter-group">
      <h4>Наличие</h4>
      <label class="filter-check"><input type="checkbox" id="onlyInStock">Только в наличии</label>
    </div>
  </div>
  <div class="filter-panel-footer">
    <button class="btn btn-primary btn-block" id="filterApply">Показать</button>
    <button class="btn btn-outline btn-block" id="filterReset">Сбросить</button>
  </div>
</aside>

<?php
$inlineScript = 'Bundle.initCatalogSection();';
include __DIR__ . '/includes/footer.php';
