# Бэклог этапов

MODE: RO — только чтение, отчёт. IMPL — код, критик обязателен.
Файл этапа `.phase/stages/<ID>.md` пишет оркестратор, когда этап становится READY.
Состав этапов 20+ уточняется после G1.

## Разведка

| ID | Этап | MODE | DEPENDS | Закрывает |
|---|---|---|---|---|
| S00 | Репозиторий, окружение, хостинг, Битрикс | RO | — | G-HOST, G-BX |
| S01 | Модель данных: инфоблоки, свойства, ТП, цены, наличие | RO | S00 | G-DATA, G-AVAIL, G-LENS, G-COLOR, G-PAY, G-REVIEWS |
| S02 | URL, ЧПУ, SEO, карта редиректов | RO | S00 | G-URL |
| G1 | Решения Николая по итогам S00–S02 | — | S00,S01,S02 | — |

## Инфраструктура

| ID | Этап | MODE | DEPENDS |
|---|---|---|---|
| S10 | Локальный Docker: Bitrix + MySQL + Node, дамп, `tests/php/run.sh` | IMPL | G1 |
| S11 | `frontend/`: Vite, entry-client/server, `server.mjs` (/render, /health), CSS макета, спрайт | IMPL | S10 |
| S12 | `lokamed:page` + `Ssr\Renderer` + manifest + запасной режим + кеш HTML | IMPL | S11 |
| S13 | UI-кит (COMPONENTS §4) | IMPL | S11 |
| S14 | Layout: шапка, меню, мега-меню, мобильное меню, подвал + LayoutProvider | IMPL | S12,S13 |

## Каталог

| ID | Этап | MODE | DEPENDS |
|---|---|---|---|
| S20 | Каталог: резолвер пути, read-модель, API `catalog.*`, контракты | IMPL | S10 |
| S21 | `CatalogRoot` + `CatalogSection`: листинг, фильтр, сортировка, пагинация (SSR + API) | IMPL | S14,S20 |
| S22 | `Product`: галерея, покупка, наличие, цвета, вкладки, сопутка | IMPL | S21 |
| S23 | Поиск: подсказки + страница | IMPL | S20,S14 |

## Заказ и формы

| ID | Этап | MODE | DEPENDS |
|---|---|---|---|
| S30 | Сессия, корзина, избранное: API + Pinia + drawer'ы | IMPL | S14,S20 |
| S31 | `Checkout`: 4 шага, промокод, создание заказа | IMPL | S30 |
| S32 | Формы: звонок, обратная связь, 1 клик, уточнить наличие, отзыв, подписка | IMPL | S14 |
| S33 | Вход (G-AUTH) | IMPL | S30 |

## Контент

| ID | Этап | MODE | DEPENDS |
|---|---|---|---|
| S40 | `Home` | IMPL | S21 |
| S41 | Акции: `PromoList`, `PromoDetail` | IMPL | S14 |
| S42 | Блог: `BlogList`, `BlogDetail` | IMPL | S14 |
| S43 | Услуги, текстовые страницы, «О компании», вакансии | IMPL | S14 |
| S44 | Салоны, отзывы | IMPL | S14 |
| S45 | `TryOn` | IMPL | S22 |

## Выпуск

| ID | Этап | MODE | DEPENDS |
|---|---|---|---|
| S50 | SEO: meta, canonical, JSON-LD, sitemap, 301 со старых URL | IMPL | S21–S45 |
| S51 | Инвалидация кеша, производительность (бюджеты Lighthouse) | IMPL | S50 |
| S60 | Приёмка: e2e всех страниц, сверка с макетом, HTML без JS содержит контент | IMPL | S51 |
| S61 | Деплой: Node-процесс, релиз, откат, мониторинг запасного режима | IMPL | S60 |
