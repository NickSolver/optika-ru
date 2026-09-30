<?php
$pageTitle = 'Салон оптики в Солнечногорске (Андреевка) — Lokamed';
$pageCss = 'assets/css/salon-page.css';
include __DIR__ . '/includes/header.php';

$salon = [
  'breadcrumbLabel' => 'Солнечногорск',
  'h1' => 'Салон оптики в Солнечногорском районе',
  'description' => 'Салон оптики Lokamed в посёлке Андреевка, Солнечногорский район. Ежедневно 10:00–21:00.',
  'mapH2' => 'Салон на карте',
  'mapIframeSrc' => 'https://yandex.ru/map-widget/v1/?ll=37.120382%2C55.980442&z=15&pt=37.120382,55.980442,pm2gnl',
  'mapIframeTitle' => 'Карта салона Lokamed в Андреевке',
];
include __DIR__ . '/includes/salon-main.php';

$inlineScript = <<<'JS'
const SALONS = [
  { name: 'Андреевка', img: 'assets/img/salons/salon1.jpg', addr: '141551, М.О., Солнечногорский р-н, п. Андреевка, ул. Жилинская, д. 1 (ТЦ «Энергия», аптека Aloe)', lat: 55.980442, lon: 37.120382 },
];
Bundle.renderSalonList(SALONS);
JS;
include __DIR__ . '/includes/footer.php';
