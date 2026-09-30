# Реестр Vue-компонентов по дизайну t1

Источник: 31 PHP-страница макета, `src/js` (~2000 строк), `src/css` (~1700 строк).
31 файл сводится к 18 шаблонам страниц: варианты товара, салонов, акций и услуг — это одни шаблоны с разными данными.

Источник props помечен как гипотеза (`?`) до S01.

## 1. Шаблоны страниц — `src/pages/`

| Vue-страница | Файлы макета | Props (источник) | Интерактив |
|---|---|---|---|
| `Home` | index.php | слайды хиро (инфоблок баннеров?), товары 3 табов: хиты/новинки/суперцена (флаги товаров?), отзывы, блог, «о нас» | слайдеры, табы товаров, в корзину |
| `CatalogRoot` | catalog.php | разделы 1-го уровня: название, картинка, счётчик (разделы каталога) | — |
| `CatalogSection` | catalog-section.php | раздел, SEO-текст (UF-поле?), товары страницы, фасеты, total, sort, perPage | фильтр, сортировка, 36/48/72, «показать ещё», пагинация |
| `Product` | product.php, -pink, -purple, -out-of-stock, -check-availability | товар, галерея, цвета (G-COLOR), цена/старая, наличие (G-AVAIL), характеристики, отзывы, 4 слайдера сопутки | кол-во, в корзину, 1 клик, уточнить наличие, отзыв, fancybox |
| `Checkout` | order.php | салоны самовывоза, способы доставки/оплаты (sale?) | 4 шага, промокод, итог |
| `PromoList` | aktsii.php, aktsii-deystvuyushchie, -postoyannye, -andreevka | акции, текущий таб (инфоблок акций, разделы = табы?) | пагинация сетки |
| `PromoDetail` | promo.php | акция: период, промокод, текст | копировать промокод |
| `BlogList` | blog.php | статьи, пагинация (инфоблок блога?) | пагинация |
| `BlogDetail` | blog-detail.php | статья (HTML), теги, похожие | — |
| `ServiceList` | uslugi.php | услуги (инфоблок услуг?) | — |
| `ServiceDetail` | uslugi-podbor, -proverka-zreniya, -remont, -zamena-linz | услуга (HTML), таблица цен, «другие услуги» | CTA → форма записи |
| `SalonList` | salony.php | салоны: фото, адрес, часы, координаты | карта, модалка салона |
| `SalonDetail` | odincovo, zelenograd, solnechnogorsk | город/салоны, карта | модалка салона |
| `Reviews` | otzyvy.php | салоны для выбора, виджет (G-REVIEWS) | выбор салона |
| `About` | o-kompanii.php | текст, цифры, галерея | лайтбокс |
| `Vacancies` | vakansii.php | вакансии | раскрытие, отклик |
| `TryOn` | primerka-ochkov.php | оправы для примерки (с PNG без фона?) | камера/фото, face-api — `<ClientOnly>` |
| `TextPage` | rules.php, uslovia-pokupki.php | HTML или список спойлеров | спойлеры |

## 2. Layout — `src/components/layout/`

| Компонент | Что внутри | Props / данные |
|---|---|---|
| `AppLayout` | обёртка: шапка + слот + подвал + глобальные модалки | `layout` из LayoutProvider |
| `SiteHeader` | лого, кнопка «Каталог», поиск, телефон, «Перезвоните», иконки вход/избранное/корзина | контакты, счётчики — из `session` после гидрации |
| `MainNav` | 9 пунктов, «Акции» с анимацией | меню (инфоблок/меню Битрикса?) |
| `MegaMenu` | 7 категорий + колонки ссылок | дерево каталога + UF-флаги |
| `MobilePanel`, `MobileCatalog` | бургер, drill-down по категориям | те же данные, что `MegaMenu` |
| `SearchBox`, `MobileSearch` | инпут + выпадашка подсказок | API `search.suggest` |
| `SiteFooter` | колонки, салоны, соцсети, подписка, юр. текст | контакты, салоны, соцсети |
| `CookieBanner` | согласие | только клиент |
| `ToTop` | кнопка «наверх» | только клиент |

## 3. Блоки — `src/components/blocks/`

| Компонент | Где используется |
|---|---|
| `HeroSlider` | Home |
| `TrustBar` | Home |
| `CategoryGrid` (+ `HubCard`) | Home, CatalogRoot |
| `ProductCard` | Home, CatalogSection, Product (сопутка), избранное |
| `ProductSlider` (заголовок + стрелки + лента + точки) | Home, Product ×5 (`render_slider_block` в макете) |
| `ProductTabsSlider` | Home: хиты/новинки/суперцена |
| `ReviewCard`, `ReviewSlider` | Home, Product |
| `BlogCard`, `BlogSlider`, `BlogGrid` | Home, BlogList, BlogDetail |
| `PromoCard`, `PromoGrid`, `PromoTabs` | PromoList, Product |
| `AboutBox` | Home, About |
| `CatalogFilter` (+ `PriceRange`, `FacetGroup`) | CatalogSection |
| `SortBar`, `PerPage`, `ShowMore`, `Pagination` | CatalogSection, BlogList, PromoList |
| `TagPills` | CatalogSection |
| `SeoText` | CatalogSection |
| `ProductGallery` | Product |
| `ProductBuyBox` (цена, наличие, кол-во, кнопки) | Product |
| `ColorSwatches` | Product |
| `SpecsTable`, `InfoTabs` | Product |
| `SalonCard`, `SalonGrid`, `SalonMap`, `SalonModal` | SalonList, SalonDetail, Reviews |
| `ServiceCard`, `PriceTable`, `OtherServices` | ServiceList, ServiceDetail |
| `ArticleBody` (HTML-поле) | BlogDetail, ServiceDetail, TextPage |
| `SocialLinks` | Footer, SalonDetail |
| `CheckoutStep`, `OptionCards`, `OrderSummary`, `PromoCodeField` | Checkout |
| `VacancyItem` | Vacancies |
| `TryOnStage` | TryOn |

## 4. UI-кит — `src/components/ui/`

`BaseButton` (primary/outline/orange, sm, block) · `BaseInput` · `PhoneInput` (маска +7) · `BaseCheckbox` · `BaseTextarea` · `StarRating` / `StarPicker` · `SvgIcon` + спрайт · `Breadcrumbs` · `BaseModal` · `Drawer` · `Tabs` · `Spoiler` · `Slider` (из `makeSlider` + `makeDraggable`) · `Badge` · `AvailabilityDot` · `Price` (цена/старая/по запросу) · `ClientOnly` · `LazyIframe` (карты)

## 5. Модалки и панели — `src/components/overlays/`

| Компонент | Макет | Действие |
|---|---|---|
| `MiniCartDrawer` | drawer корзины | API `cart.*` |
| `FavoritesDrawer` | drawer избранного | API `favorites.*` |
| `AddedToCartModal` | `addToCartModal` | — |
| `FormModal` с конфигами | `callbackModal`, `feedbackModal`, `buyNowModal`, `checkAvailModal`, `writeReviewModal`, `reviewModal`, подписка в подвале | API `form.submit` |
| `LoginModal` | `loginModal` | G-AUTH |

Один `FormModal` вместо 6 модалок: в макете у них одна разметка, различаются поля и эндпоинт.

## 6. Хранилища и composables

- Pinia: `session` (auth, счётчики), `cart`, `favorites`. Заполняются после гидрации, в SSR пустые.
- `useApi` — fetch + `sessid` + единый формат ошибок.
- `useCatalogQuery` — состояние фильтра ⇄ query-строка ⇄ API.
- `useSlider`, `usePhoneMask`, `useModal`.

## 7. Что в макете выбрасывается

- Демо-данные в JS: 204 товара, фасеты, `SEARCH_DEMO`, демо-авторизация.
- `window.Bundle` и `init*`-функции — их заменяют Vue-страницы.
- Инлайн-стили `style="..."` в разметке → классы.
- Вывод без экранирования в `helpers.php`.

## 8. Открыто по дизайну

- Выбора параметров линз (сила, радиус, диаметр, для каждого глаза) в макете нет (G-LENS).
- Нет макета страницы поиска, личного кабинета, 404, «спасибо за заказ».
- Нет состояния «цена по запросу».
