<?php
/**
 * Shared page shell (opening half): doctype, <head>, SVG icon sprite, site header/nav.
 * Expects (optional) variables set by the including page before this include:
 *   $pageTitle        string  <title> text
 *   $pageDescription  string  <meta name="description"> content
 *   $extraHeadLinks   array   extra <link rel="stylesheet"> hrefs (vendor CSS)
 *   $pageCss          string  page-specific stylesheet href (assets/css/<slug>.css)
 */
require_once __DIR__ . '/helpers.php';
?>
<!DOCTYPE html>
<html lang="ru">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= $pageTitle ?></title>
<?php if (!empty($pageDescription)): ?>
<meta name="description" content="<?= $pageDescription ?>">
<?php endif; ?>
<link rel="stylesheet" href="assets/css/styles.css">
<?php foreach ($extraHeadLinks ?? [] as $link): ?>
<link rel="stylesheet" href="<?= $link ?>">
<?php endforeach; ?>
<?php if (!empty($pageCss)): ?>
<link rel="stylesheet" href="<?= $pageCss ?>">
<?php endif; ?>
</head>
<body>

<svg style="display:none" aria-hidden="true">
  <symbol id="i-arrow-right" viewBox="0 0 24 24"><line x1="4" y1="12" x2="20" y2="12"/><polyline points="14 6 20 12 14 18"/></symbol>
  <symbol id="i-badge" viewBox="0 0 24 24"><circle cx="12" cy="9" r="5.2"/><path d="M8.4 13.6L6.8 21l5.2-3 5.2 3-1.6-7.4"/></symbol>
  <symbol id="i-bag" viewBox="0 0 24 24"><rect x="4" y="7.5" width="16" height="13" rx="3"/><path d="M9 7.5V5.3A3 3 0 0 1 12 2.3a3 3 0 0 1 3 3V7.5"/></symbol>
  <symbol id="i-bolt" viewBox="0 0 24 24"><polygon points="13 2 4 14 11 14 9 22 20 10 13 10 13 2" style="fill:currentColor;stroke:none"/></symbol>
  <symbol id="i-cart" viewBox="0 0 24 24"><path d="M6 8h12l-1 11.4c-.05.6-.55 1.1-1.15 1.1H8.15c-.6 0-1.1-.5-1.15-1.1L6 8z"/><path d="M9 8V6a3 3 0 0 1 6 0v2"/></symbol>
  <symbol id="i-check" viewBox="0 0 24 24"><polyline points="4 12 9 17 20 6"/></symbol>
  <symbol id="i-chev-left" viewBox="0 0 24 24"><polyline points="14 6 8 12 14 18"/></symbol>
  <symbol id="i-chev-right" viewBox="0 0 24 24"><polyline points="10 6 16 12 10 18"/></symbol>
  <symbol id="i-chev-up" viewBox="0 0 24 24"><polyline points="6 15 12 9 18 15"/></symbol>
  <symbol id="i-clock" viewBox="0 0 24 24"><circle cx="12" cy="12" r="8.5"/><polyline points="12 7.5 12 12 15.5 14"/></symbol>
  <symbol id="i-close" viewBox="0 0 24 24"><line x1="6" y1="6" x2="18" y2="18"/><line x1="18" y1="6" x2="6" y2="18"/></symbol>
  <symbol id="i-dzen" viewBox="0 0 24 24"><circle cx="12" cy="7.6" r="4.1" style="fill:currentColor;stroke:none"/><circle cx="12" cy="16.4" r="4.1" style="fill:currentColor;stroke:none"/><circle cx="7.6" cy="12" r="4.1" style="fill:currentColor;stroke:none"/><circle cx="16.4" cy="12" r="4.1" style="fill:currentColor;stroke:none"/></symbol>
  <symbol id="i-eye" viewBox="0 0 24 24"><path d="M2 12s4-6.2 10-6.2S22 12 22 12s-4 6.2-10 6.2S2 12 2 12z"/><circle cx="12" cy="12" r="3"/></symbol>
  <symbol id="i-filter" viewBox="0 0 24 24"><line x1="4" y1="7" x2="20" y2="7"/><circle cx="9" cy="7" r="2" style="fill:currentColor;stroke:none"/><line x1="4" y1="12" x2="20" y2="12"/><circle cx="15" cy="12" r="2" style="fill:currentColor;stroke:none"/><line x1="4" y1="17" x2="20" y2="17"/><circle cx="11" cy="17" r="2" style="fill:currentColor;stroke:none"/></symbol>
  <symbol id="i-gift" viewBox="0 0 24 24"><rect x="4" y="10.5" width="16" height="9.5" rx="1.6"/><rect x="3.2" y="7" width="17.6" height="4" rx="1.2"/><line x1="12" y1="7" x2="12" y2="20"/><path d="M12 7c0-2.2-1.4-3.6-3-3.6S6.5 5 8 6.4C9.2 7.5 12 7 12 7z"/><path d="M12 7c0-2.2 1.4-3.6 3-3.6S17.5 5 16 6.4C14.8 7.5 12 7 12 7z"/></symbol>
  <symbol id="i-glasses" viewBox="0 0 24 24"><circle cx="6.3" cy="13" r="3.3"/><circle cx="17.7" cy="13" r="3.3"/><path d="M9.6 12h4.8"/><path d="M2.2 13c0-1.2.6-2.4 1.8-2.7"/><path d="M21.8 13c0-1.2-.6-2.4-1.8-2.7"/></symbol>
  <symbol id="i-grid" viewBox="0 0 24 24"><rect x="3.5" y="3.5" width="7" height="7" rx="1.5"/><rect x="13.5" y="3.5" width="7" height="7" rx="1.5"/><rect x="3.5" y="13.5" width="7" height="7" rx="1.5"/><rect x="13.5" y="13.5" width="7" height="7" rx="1.5"/></symbol>
  <symbol id="i-heart" viewBox="0 0 24 24"><path d="M12 21s-8.5-5.2-11-10.14C-.7 6.6 1.7 3 5.5 3 8 3 10 4.3 12 7c2-2.7 4-4 6.5-4 3.8 0 6.2 3.6 4.5 7.86C20.5 15.8 12 21 12 21z"/></symbol>
  <symbol id="i-instagram" viewBox="0 0 24 24"><rect x="3.5" y="3.5" width="17" height="17" rx="5"/><circle cx="12" cy="12" r="4.2"/><circle cx="17.3" cy="6.7" r="1" style="fill:currentColor;stroke:none"/></symbol>
  <symbol id="i-lens" viewBox="0 0 24 24"><circle cx="12" cy="12" r="8.2"/><circle cx="12" cy="12" r="3"/><line x1="12" y1="6.2" x2="12" y2="8.5"/><line x1="12" y1="15.5" x2="12" y2="17.8"/><line x1="6.2" y1="12" x2="8.5" y2="12"/><line x1="15.5" y1="12" x2="17.8" y2="12"/></symbol>
  <symbol id="i-mail" viewBox="0 0 24 24"><rect x="3" y="5.5" width="18" height="13" rx="2"/><polyline points="3.5 7 12 13 20.5 7"/></symbol>
  <symbol id="i-mailru" viewBox="0 0 24 24"><text x="12" y="17.5" text-anchor="middle" font-size="17" font-weight="700" font-family="Arial,Helvetica,sans-serif" style="fill:currentColor">@</text></symbol>
  <symbol id="i-max" viewBox="0 0 24 24"><text x="12" y="15.8" text-anchor="middle" font-size="9" font-weight="800" font-family="Arial,Helvetica,sans-serif" style="fill:currentColor">MAX</text></symbol>
  <symbol id="i-menu" viewBox="0 0 24 24"><line x1="4" y1="6" x2="20" y2="6"/><line x1="4" y1="12" x2="20" y2="12"/><line x1="4" y1="18" x2="20" y2="18"/></symbol>
  <symbol id="i-minus" viewBox="0 0 24 24"><line x1="5" y1="12" x2="19" y2="12"/></symbol>
  <symbol id="i-phone" viewBox="0 0 24 24"><path d="M4 5c0-.6.4-1 1-1h2.2c.5 0 .9.3 1 .8l.6 2.8c.1.4 0 .8-.3 1.1L7.2 10c1 2.4 2.9 4.3 5.3 5.3l1.3-1.3c.3-.3.7-.4 1.1-.3l2.8.6c.5.1.8.5.8 1V18c0 .6-.4 1-1 1h-1C9.6 19 4 13.4 4 6V5z"/></symbol>
  <symbol id="i-pin" viewBox="0 0 24 24"><path d="M12 21.5s7-6.3 7-12a7 7 0 1 0-14 0c0 5.7 7 12 7 12z"/><circle cx="12" cy="9.3" r="2.5"/></symbol>
  <symbol id="i-plus" viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></symbol>
  <symbol id="i-search" viewBox="0 0 24 24"><circle cx="11" cy="11" r="6.5"/><line x1="15.8" y1="15.8" x2="20" y2="20"/></symbol>
  <symbol id="i-shield" viewBox="0 0 24 24"><path d="M12 3l7 3v5c0 5-3.5 8.5-7 10-3.5-1.5-7-5-7-10V6l7-3z"/><polyline points="9 12 11 14.2 15.2 9.8"/></symbol>
  <symbol id="i-star" viewBox="0 0 24 24"><path d="M12 3.5l2.6 5.3 5.8.8-4.2 4.1 1 5.8-5.2-2.7-5.2 2.7 1-5.8-4.2-4.1 5.8-.8L12 3.5z"/></symbol>
  <symbol id="i-sun" viewBox="0 0 24 24"><circle cx="12" cy="12" r="4.2"/><line x1="12" y1="2.5" x2="12" y2="5"/><line x1="12" y1="19" x2="12" y2="21.5"/><line x1="2.5" y1="12" x2="5" y2="12"/><line x1="19" y1="12" x2="21.5" y2="12"/><line x1="5" y1="5" x2="6.8" y2="6.8"/><line x1="17.2" y1="17.2" x2="19" y2="19"/><line x1="19" y1="5" x2="17.2" y2="6.8"/><line x1="6.8" y1="17.2" x2="5" y2="19"/></symbol>
  <symbol id="i-telegram" viewBox="0 0 24 24"><path d="M20.7 4.4L3.2 11.2c-.8.3-.8 1 0 1.3l4.6 1.5 1.8 5.8c.2.6.6.7 1 .3l2.5-2.2 4.6 3.4c.6.4 1.1.1 1.3-.6l3-13.4c.2-.8-.3-1.2-1-.9z"/></symbol>
  <symbol id="i-truck" viewBox="0 0 24 24"><rect x="1.5" y="8.5" width="12" height="8" rx="1"/><path d="M13.5 11h4l3.5 3v2.5h-7.5z"/><circle cx="6" cy="18.3" r="2"/><circle cx="16.7" cy="18.3" r="2"/></symbol>
  <symbol id="i-user" viewBox="0 0 24 24"><circle cx="12" cy="8.2" r="3.6"/><path d="M4.5 20c.6-4 3.6-6.4 7.5-6.4s6.9 2.4 7.5 6.4"/></symbol>
  <symbol id="i-users" viewBox="0 0 24 24"><circle cx="8.5" cy="8.8" r="3.2"/><path d="M2.3 19.5c.5-3.3 3-5.7 6.2-5.7s5.7 2.4 6.2 5.7"/><circle cx="17.5" cy="9.5" r="2.4"/><path d="M15.8 13.9c2.3.4 4.1 2.2 4.5 4.7"/></symbol>
  <symbol id="i-vk" viewBox="0 0 24 24"><text x="12" y="16.3" text-anchor="middle" font-size="10.5" font-weight="800" font-family="Arial,Helvetica,sans-serif" style="fill:currentColor">VK</text></symbol>
  <symbol id="i-whatsapp" viewBox="0 0 24 24"><path d="M12 3.5c-4.7 0-8.5 3.6-8.5 8 0 1.7.5 3.3 1.5 4.6L4 20.5l4.6-1.2c1 .5 2.2.8 3.4.8 4.7 0 8.5-3.6 8.5-8s-3.8-8.6-8.5-8.6z"/></symbol>
  <symbol id="i-yandex" viewBox="0 0 24 24"><text x="12" y="17" text-anchor="middle" font-size="14" font-weight="800" font-family="Arial,Helvetica,sans-serif" style="fill:currentColor">Я</text></symbol>
</svg>


<header class="site">
  <div class="navbar">
    <div class="container">
      <a href="index.php" class="brand"><img src="assets/img/logo.png" alt="Lokamed — сеть салонов оптики"></a>
      <button class="btn btn-primary btn-sm catalog-btn" id="catalogBtn" aria-haspopup="true" aria-expanded="false"><svg class="icon" style="width:17px;height:17px"><use href="#i-grid"/></svg><span class="catalog-btn-label">Каталог</span><svg class="icon catalog-btn-chevron" style="width:13px;height:13px;transform:rotate(180deg)"><use href="#i-chev-up"/></svg></button>

      <div class="search-wrap" id="searchWrap">
        <svg class="icon"><use href="#i-search"/></svg>
        <input type="search" id="searchInput" placeholder="Поиск по каталогу" autocomplete="off">
        <div class="search-dropdown" id="searchDropdown"></div>
      </div>

      <div class="nav-actions">
        <a href="tel:88006005703" class="icon-link">
          <div class="label">
            <b style="display:flex;align-items:center;gap:6px"><svg class="icon phone-link-icon"><use href="#i-phone"/></svg>8-800-600-5703</b>
            <span>Ежедневно 10:00–21:00</span>
          </div>
        </a>
        <button class="btn btn-primary btn-sm callback-btn" id="callbackBtn">Перезвоните мне</button>
        <div class="auth-slot" id="authSlot">
          <button class="btn btn-outline btn-sm" id="loginBtn">Войти</button>
          <a href="#" class="icon-link" id="accountLink" style="display:none">
            <span class="icon-sq"><svg class="icon" style="width:18px;height:18px"><use href="#i-user"/></svg></span>
            <span class="label"><b>Иван П.</b><span>Личный кабинет</span></span>
          </a>
        </div>
        <button class="icon-sq mobile-search-btn" id="mobileSearchBtn" aria-label="Поиск"><svg class="icon"><use href="#i-search"/></svg></button>
        <a href="#" class="icon-link" id="favOpen">
          <span class="icon-sq"><svg class="icon" style="width:18px;height:18px"><use href="#i-heart"/></svg><span class="count" id="favCount">4</span></span>
          <span class="label"><b>Избранное</b></span>
        </a>
        <a href="#" class="icon-link" id="cartOpen">
          <span class="icon-sq"><svg class="icon" style="width:18px;height:18px"><use href="#i-cart"/></svg><span class="count" id="cartCount">2</span></span>
          <span class="label"><b>Корзина</b></span>
        </a>
        <button class="icon-sq hamburger" id="menuOpen" aria-label="Меню" style="background:none"><svg class="icon"><use href="#i-menu"/></svg></button>
      </div>
    </div>
  </div>

  <div class="mobile-search-overlay" id="mobileSearchBar">
    <div class="mobile-search-overlay-bar">
      <svg class="icon"><use href="#i-search"/></svg>
      <input type="search" id="mobileSearchInput" placeholder="Поиск по каталогу" autocomplete="off">
      <button class="icon-sq" id="mobileSearchClose" aria-label="Закрыть поиск"><svg class="icon"><use href="#i-close"/></svg></button>
    </div>
    <div class="search-dropdown" id="mobileSearchDropdown"></div>
  </div>

  <nav class="subnav">
    <div class="container">
      <a href="catalog.php" id="catalogNavLink">Каталог</a>
      <a href="uslugi.php">Услуги</a>
      <a href="aktsii.php" class="alarm-shake">Акции и скидки</a>
      <a href="blog.php">Блог</a>
      <a href="otzyvy.php">Отзывы</a>
      <a href="uslovia-pokupki.php">Условия покупки</a>
      <a href="vakansii.php">Вакансии</a>
      <a href="o-kompanii.php">О компании</a>
      <a href="salony.php" class="nav-highlight">Салоны оптики</a>
    </div>
  </nav>

  <div class="mega" id="megaMenu">
    <div class="container mega-inner">
      <div class="mega-cats">
        <button class="mega-cat is-active" data-cat="frames"><svg class="icon"><use href="#i-glasses"/></svg>Оправы для очков</button>
        <button class="mega-cat" data-cat="lenses"><svg class="icon"><use href="#i-lens"/></svg>Линзы для очков</button>
        <button class="mega-cat" data-cat="sun"><svg class="icon"><use href="#i-sun"/></svg>Солнцезащитные очки</button>
        <button class="mega-cat" data-cat="contacts"><svg class="icon"><use href="#i-eye"/></svg>Контактные линзы</button>
        <button class="mega-cat" data-cat="access"><svg class="icon"><use href="#i-bag"/></svg>Аксессуары</button>
        <button class="mega-cat" data-cat="services"><svg class="icon"><use href="#i-shield"/></svg>Услуги</button>
        <button class="mega-cat" data-cat="gift"><svg class="icon"><use href="#i-gift"/></svg>Подарочные сертификаты</button>
      </div>

      <div class="mega-panels">
        <div class="mega-panel is-active" data-panel="frames">
          <div class="mega-col"><h4>Пол</h4>
            <a href="catalog-section.php">Женские</a><a href="catalog-section.php">Мужские</a><a href="catalog-section.php">Детские</a><a href="catalog-section.php">Унисекс</a>
          </div>
          <div class="mega-col"><h4>Форма</h4>
            <a href="catalog-section.php">Авиаторы</a><a href="catalog-section.php">Бабочки</a><a href="catalog-section.php">Геометрия</a><a href="catalog-section.php">Кошачий глаз</a><a href="catalog-section.php">Овальные</a><a href="catalog-section.php">Прямоугольные</a>
          </div>
          <div class="mega-col"><h4>Цвет</h4>
            <a href="catalog-section.php">Чёрный</a><a href="catalog-section.php">Коричневый</a><a href="catalog-section.php">Золотой</a><a href="catalog-section.php">Серебряный</a><a href="catalog-section.php">Прозрачный</a><a href="catalog-section.php">Красный</a>
          </div>
          <div class="mega-col"><h4>Бренд</h4>
            <a href="catalog-section.php">Lokamed</a><a href="catalog-section.php">Ray Ban</a><a href="catalog-section.php">Carrera</a><a href="catalog-section.php">Tommy Hilfiger</a><a href="catalog-section.php">Vogue</a>
            <a href="catalog-section.php" class="mega-more">Все бренды <svg class="icon" style="width:13px;height:13px"><use href="#i-arrow-right"/></svg></a>
          </div>
        </div>

        <div class="mega-panel" data-panel="lenses">
          <div class="mega-col"><h4>Форма</h4>
            <a href="catalog-section.php">Асферическая</a><a href="catalog-section.php">Сферическая</a><a href="catalog-section.php">Free Form</a>
          </div>
          <div class="mega-col"><h4>Толщина</h4>
            <a href="catalog-section.php">1.50</a><a href="catalog-section.php">1.56</a><a href="catalog-section.php">1.61</a><a href="catalog-section.php">1.67</a><a href="catalog-section.php">1.74</a>
          </div>
          <div class="mega-col"><h4>Покрытие</h4>
            <a href="catalog-section.php">HMC</a><a href="catalog-section.php">Hard Multi Coat</a><a href="catalog-section.php">Crizal Prevencia</a><a href="catalog-section.php">BLUE SHIELD</a><a href="catalog-section.php">Зеркальное Mirror</a>
          </div>
          <div class="mega-col"><h4>Бренд</h4>
            <a href="catalog-section.php">Lokamed</a><a href="catalog-section.php">Carl Zeiss</a><a href="catalog-section.php">Hoya</a><a href="catalog-section.php">Rodenstock</a><a href="catalog-section.php">Seiko</a>
          </div>
        </div>

        <div class="mega-panel" data-panel="sun">
          <div class="mega-col"><h4>Пол</h4>
            <a href="catalog-section.php">Женские</a><a href="catalog-section.php">Мужские</a><a href="catalog-section.php">Детские</a><a href="catalog-section.php">Унисекс</a>
          </div>
          <div class="mega-col"><h4>Форма</h4>
            <a href="catalog-section.php">Авиаторы</a><a href="catalog-section.php">Круглые</a><a href="catalog-section.php">Спортивные</a><a href="catalog-section.php">Кошачий глаз</a><a href="catalog-section.php">Оверсайз</a>
          </div>
          <div class="mega-col"><h4>Цвет</h4>
            <a href="catalog-section.php">Чёрный</a><a href="catalog-section.php">Коричневый</a><a href="catalog-section.php">Золотой</a><a href="catalog-section.php">Зелёный</a><a href="catalog-section.php">Синий</a>
          </div>
          <div class="mega-col"><h4>Бренд</h4>
            <a href="catalog-section.php">Ray Ban</a><a href="catalog-section.php">Carrera</a><a href="catalog-section.php">Polaroid</a><a href="catalog-section.php">Givenchy</a><a href="catalog-section.php">Maxmara</a>
            <a href="catalog-section.php" class="mega-more">Все бренды <svg class="icon" style="width:13px;height:13px"><use href="#i-arrow-right"/></svg></a>
          </div>
        </div>

        <div class="mega-panel" data-panel="contacts">
          <div class="mega-col"><h4>Срок замены</h4>
            <a href="catalog-section.php">На 1 день</a><a href="catalog-section.php">На 1-2 недели</a><a href="catalog-section.php">На 1 месяц</a><a href="catalog-section.php">На 3 месяца</a>
          </div>
          <div class="mega-col"><h4>Бренд</h4>
            <a href="catalog-section.php">Adria</a><a href="catalog-section.php">Acuvue</a><a href="catalog-section.php">Miru</a><a href="catalog-section.php">Optima</a><a href="catalog-section.php">Soflens</a>
          </div>
          <div class="mega-col"><h4>Цвет</h4>
            <a href="catalog-section.php">Цветные линзы</a>
          </div>
        </div>

        <div class="mega-panel" data-panel="access">
          <div class="mega-col"><h4>Уход и хранение</h4>
            <a href="catalog-section.php">Футляры для очков</a><a href="catalog-section.php">Салфетки для очков</a><a href="catalog-section.php">Растворы для линз</a><a href="catalog-section.php">Капли для глаз</a><a href="catalog-section.php">Наборы для линз</a>
          </div>
          <div class="mega-col"><h4>Прочее</h4>
            <a href="catalog-section.php">Шнурки, цепочки, стопперы</a><a href="catalog-section.php">Очки-антифары</a><a href="catalog-section.php">Очки-тренажёры</a><a href="catalog-section.php">Глаукомные очки</a><a href="catalog-section.php">Лупы</a><a href="catalog-section.php">Цветные насадки на очки</a>
          </div>
        </div>

        <div class="mega-panel" data-panel="services">
          <div class="mega-col"><h4>Услуги в салонах</h4>
            <a href="#">Бесплатная проверка зрения</a><a href="#">Подбор оправ и очковых линз</a><a href="#">Замена линз в очках</a><a href="#">Ремонт очков любой сложности</a>
          </div>
        </div>

        <div class="mega-panel" data-panel="gift">
          <div class="mega-col" style="max-width:320px">
            <h4>Подарочные сертификаты</h4>
            <p style="font-size:.88rem;color:var(--ink-soft);margin-bottom:16px">Номинал от 1 000 до 20 000 ₽. Можно потратить на оправы, линзы и солнцезащитные очки в любом салоне сети.</p>
            <div style="text-align:center"><a href="#" class="btn btn-primary btn-sm" style="color:#fff">Выбрать сертификат</a></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</header>

<div class="mobile-panel" id="mobilePanel">
  <div class="container">
    <div class="mobile-panel-head">
      <img src="assets/img/logo.png" alt="Lokamed" style="height:32px">
      <button class="icon-sq" id="menuClose" aria-label="Закрыть меню"><svg class="icon"><use href="#i-close"/></svg></button>
    </div>
    <nav>
      <a href="catalog-section.php" id="mobileNavCatalog" style="display:flex;align-items:center;justify-content:space-between">Каталог<svg class="icon" style="width:16px;height:16px;color:var(--ink-faint)"><use href="#i-chev-right"/></svg></a>
      <a href="uslugi.php">Услуги</a>
      <a href="aktsii.php" class="alarm-shake">Акции и скидки</a>
      <a href="blog.php">Блог</a>
      <a href="otzyvy.php">Отзывы</a>
      <a href="uslovia-pokupki.php">Условия покупки</a>
      <a href="vakansii.php">Вакансии</a>
      <a href="o-kompanii.php">О компании</a>
      <a href="salony.php" class="nav-highlight">Салоны оптики</a>
    </nav>
    <a href="tel:88006005703" class="btn btn-primary btn-block">8-800-600-5703</a>
    <button class="btn btn-outline btn-block" id="mobileCallbackBtn" style="margin-top:10px">Перезвоните мне</button>
  </div>
</div>

<div class="mobile-panel" id="mobileCatalogPanel">
  <div class="container">
    <div class="mobile-panel-head">
      <div style="display:flex;align-items:center;gap:10px">
        <button class="icon-sq" id="mobileCatalogBack" aria-label="Назад" style="display:none"><svg class="icon"><use href="#i-chev-left"/></svg></button>
        <span style="font-weight:800;font-size:1.1rem" id="mobileCatalogTitle">Каталог</span>
      </div>
      <button class="icon-sq" id="mobileCatalogClose" aria-label="Закрыть каталог"><svg class="icon"><use href="#i-close"/></svg></button>
    </div>
    <div class="mobile-catalog-list" id="mobileCatalogList">
      <a href="#" class="mobile-catalog-item" data-cat="frames" data-label="Оправы для очков"><span class="icon-wrap"><svg class="icon"><use href="#i-glasses"/></svg></span><span class="mobile-catalog-item-label">Оправы для очков</span><svg class="icon chev"><use href="#i-chev-right"/></svg></a>
      <a href="#" class="mobile-catalog-item" data-cat="lenses" data-label="Линзы для очков"><span class="icon-wrap"><svg class="icon"><use href="#i-lens"/></svg></span><span class="mobile-catalog-item-label">Линзы для очков</span><svg class="icon chev"><use href="#i-chev-right"/></svg></a>
      <a href="#" class="mobile-catalog-item" data-cat="sun" data-label="Солнцезащитные очки"><span class="icon-wrap"><svg class="icon"><use href="#i-sun"/></svg></span><span class="mobile-catalog-item-label">Солнцезащитные очки</span><svg class="icon chev"><use href="#i-chev-right"/></svg></a>
      <a href="#" class="mobile-catalog-item" data-cat="contacts" data-label="Контактные линзы"><span class="icon-wrap"><svg class="icon"><use href="#i-eye"/></svg></span><span class="mobile-catalog-item-label">Контактные линзы</span><svg class="icon chev"><use href="#i-chev-right"/></svg></a>
      <a href="#" class="mobile-catalog-item" data-cat="access" data-label="Аксессуары"><span class="icon-wrap"><svg class="icon"><use href="#i-bag"/></svg></span><span class="mobile-catalog-item-label">Аксессуары</span><svg class="icon chev"><use href="#i-chev-right"/></svg></a>
      <a href="#" class="mobile-catalog-item" data-cat="services" data-label="Услуги"><span class="icon-wrap"><svg class="icon"><use href="#i-shield"/></svg></span><span class="mobile-catalog-item-label">Услуги</span><svg class="icon chev"><use href="#i-chev-right"/></svg></a>
      <a href="#" class="mobile-catalog-item" data-cat="gift" data-label="Подарочные сертификаты"><span class="icon-wrap"><svg class="icon"><use href="#i-gift"/></svg></span><span class="mobile-catalog-item-label">Подарочные сертификаты</span><svg class="icon chev"><use href="#i-chev-right"/></svg></a>
    </div>
    <div id="mobileCatalogDetail" style="display:none"></div>
  </div>
</div>
