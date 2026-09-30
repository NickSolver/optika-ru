<?php
/**
 * Reusable render helpers shared across pages. Included once from includes/header.php.
 */

/**
 * Breadcrumb trail. Always starts with "Главная" -> index.php.
 * $items: list of ['label' => string, 'href' => string|null]. The last item
 * is always rendered as the current page (no link), regardless of 'href'.
 */
function render_breadcrumbs(array $items): void {
    echo '<nav class="breadcrumbs"><a href="index.php">Главная</a>';
    $last = count($items) - 1;
    foreach ($items as $i => $item) {
        echo '<span class="sep">/</span>';
        if ($i < $last && !empty($item['href'])) {
            echo '<a href="' . $item['href'] . '">' . $item['label'] . '</a>';
        } else {
            echo '<span class="current">' . $item['label'] . '</span>';
        }
    }
    echo '</nav>';
}

/**
 * Slider "shell": header (title + prev/next arrows) + track row + dots container.
 * Matches the reviews-head/slider-row/review-dots pattern repeated across product
 * and homepage sliders. $prefix drives every element id ({prefix}Track, {prefix}Dots,
 * {prefix}ArrowPrev/Next) to match the JS in shared.js's makeSlider().
 */
function render_slider_block(string $title, string $prefix, string $trackClass, string $wrapperClass = 'pdp-section pdp-full', ?string $wrapperId = null): void {
    $idAttr = $wrapperId ? ' id="' . $wrapperId . '"' : '';
    echo '<div class="' . $wrapperClass . '"' . $idAttr . '>' . "\n";
    echo '  <div class="reviews-head">' . "\n";
    echo '    <h2>' . $title . '</h2>' . "\n";
    echo '    <div class="reviews-controls">' . "\n";
    echo '      <button class="slider-btn" id="' . $prefix . 'ArrowPrev" aria-label="Назад"><svg class="icon"><use href="#i-chev-left"/></svg></button>' . "\n";
    echo '      <button class="slider-btn" id="' . $prefix . 'ArrowNext" aria-label="Вперёд"><svg class="icon"><use href="#i-chev-right"/></svg></button>' . "\n";
    echo '    </div>' . "\n";
    echo '  </div>' . "\n";
    echo '  <div class="slider-row">' . "\n";
    echo '    <div class="' . $trackClass . '" id="' . $prefix . 'Track"></div>' . "\n";
    echo '  </div>' . "\n";
    echo '  <div class="review-dots" id="' . $prefix . 'Dots"></div>' . "\n";
    echo '</div>' . "\n";
}

/**
 * Aktsii tab bar shared by aktsii.php + the aktsii-*.php pages. $active is one of:
 * 'vse' | 'deystvuyushchie' | 'postoyannye' | 'andreevka'.
 */
function render_aktsii_tabs(string $active): void {
    $tabs = [
        'vse' => ['aktsii.php', 'Все акции'],
        'deystvuyushchie' => ['aktsii-deystvuyushchie.php', 'Действующие акции'],
        'postoyannye' => ['aktsii-postoyannye.php', 'Постоянные предложения'],
        'andreevka' => ['aktsii-andreevka.php', 'Особые акции в Андреевке'],
    ];
    foreach ($tabs as $key => [$href, $label]) {
        $class = 'tab-btn' . ($key === $active ? ' is-active' : '');
        echo '      <a href="' . $href . '" class="' . $class . '">' . $label . '</a>' . "\n";
    }
}
