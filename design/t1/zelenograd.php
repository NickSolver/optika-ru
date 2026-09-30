<?php
$pageTitle = 'Салоны оптики в Зеленограде — Lokamed';
$pageCss = 'assets/css/salon-page.css';
include __DIR__ . '/includes/header.php';

$salon = [
  'breadcrumbLabel' => 'Зеленоград',
  'h1' => 'Салоны оптики в Зеленограде',
  'description' => '4 салона оптики Lokamed в Зеленограде. Ежедневно 10:00–21:00.',
  'mapH2' => 'Салоны в Зеленограде на карте',
  'mapIframeSrc' => 'https://yandex.ru/map-widget/v1/?ll=37.179034%2C55.984399&z=13&pt=37.176742,55.980555,pm2gnl~37.169338,55.980596,pm2gnl~37.162809,55.973924,pm2gnl~37.207248,56.002521,pm2gnl',
  'mapIframeTitle' => 'Карта салонов Lokamed в Зеленограде',
];
include __DIR__ . '/includes/salon-main.php';

$inlineScript = <<<'JS'
const SALONS = [
  { name: 'Зеленоград, к. 834В', img: 'assets/img/salons/salon3.jpg', addr: '124527, Москва, г. Зеленоград, к. 834В (аптека Aloe)', lat: 55.980555, lon: 37.176742 },
  { name: 'Зеленоград, к. 1824', img: 'assets/img/salons/salon1.jpg', addr: '124365, Москва, г. Зеленоград, к. 1824', lat: 55.980596, lon: 37.169338 },
  { name: 'Зеленоград, к. 2008', img: 'assets/img/salons/salon2.jpg', addr: '124365, Москва, г. Зеленоград, к. 2008 (аптека «Столички»)', lat: 55.973924, lon: 37.162809 },
  { name: 'Зеленоград, к. 241', img: 'assets/img/salons/salon3.jpg', addr: '124498, Москва, г. Зеленоград, к. 241 (аптека «Столички»)', lat: 56.002521, lon: 37.207248 },
];
Bundle.renderSalonList(SALONS);
JS;
include __DIR__ . '/includes/footer.php';
