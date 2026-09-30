<?php
$pageTitle = 'Салон оптики в Одинцово — Lokamed';
$pageCss = 'assets/css/salon-page.css';
include __DIR__ . '/includes/header.php';

$salon = [
  'breadcrumbLabel' => 'Одинцово',
  'h1' => 'Салон оптики в Одинцово',
  'description' => 'Салон оптики Lokamed в Одинцово, Можайское шоссе. Ежедневно 10:00–21:00.',
  'mapH2' => 'Салон на карте',
  'mapIframeSrc' => 'https://yandex.ru/map-widget/v1/?ll=37.291035%2C55.681189&z=15&pt=37.291035,55.681189,pm2gnl',
  'mapIframeTitle' => 'Карта салона Lokamed в Одинцово',
];
include __DIR__ . '/includes/salon-main.php';

$inlineScript = <<<'JS'
const SALONS = [
  { name: 'Одинцово', img: 'assets/img/salons/salon1.jpg', addr: '143005, М.О., г. Одинцово, Можайское шоссе, д. 66Б (аптека «Ваша №1»)', lat: 55.681189, lon: 37.291035 },
];
Bundle.renderSalonList(SALONS);
JS;
include __DIR__ . '/includes/footer.php';
