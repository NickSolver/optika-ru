<?php
$pageTitle = 'Оправа для очков Lokamed (нет в наличии) — Lokamed';
$extraHeadLinks = ['assets/vendor/fancybox/fancybox.css'];
$pageCss = 'assets/css/product.css';
include __DIR__ . '/includes/header.php';
?>
<?php include __DIR__ . '/includes/product-main.php'; ?>
<?php
$vendorScripts = ['assets/vendor/fancybox/fancybox.umd.js'];
$inlineScript = <<<'JS'
Bundle.initProduct({
  color: 'orange',
  availability: 'out_of_stock',
  images: ['assets/img/product1.png'],
});
JS;
include __DIR__ . '/includes/footer.php';
