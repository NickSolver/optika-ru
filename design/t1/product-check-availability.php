<?php
$pageTitle = 'Оправа для очков Lokamed (уточните наличие) — Lokamed';
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
  availability: 'check',
  images: ['assets/img/product1.png', 'assets/img/product2.png', 'assets/img/product3.png', 'assets/img/product4.png'],
});
JS;
include __DIR__ . '/includes/footer.php';
