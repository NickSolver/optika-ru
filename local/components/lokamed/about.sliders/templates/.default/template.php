<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

/** @var array $arParams */
/** @var array $arResult */

$variant = (string)($arParams['SLIDER_VARIANT'] ?? '');
$variants = [
    'gallery' => [
        'slider' => 'lokamed-about-gallery-slider',
        'slide' => 'lokamed-about-gallery-slide',
        'label' => 'Галерея салонов',
    ],
    'partners' => [
        'slider' => 'lokamed-partners-slider',
        'slide' => 'lokamed-partner-slide',
        'label' => 'Наши партнёры',
    ],
    'achievements' => [
        'slider' => 'lokamed-achievements-slider',
        'slide' => 'lokamed-achievement-slide',
        'label' => 'Наши достижения',
    ],
];

if (empty($arResult['ITEMS']) || empty($variants[$variant])) {
    return;
}

$config = $variants[$variant];
?>
<div class="<?= htmlspecialcharsbx($config['slider']) ?> slick-slider" aria-label="<?= htmlspecialcharsbx($config['label']) ?>">
    <?php foreach ($arResult['ITEMS'] as $arItem): ?>
        <?php
        $image = $arItem['PREVIEW_PICTURE'] ?? [];
        $imageSrc = (string)($image['SRC'] ?? '');
        if ($imageSrc === '') {
            continue;
        }

        $imageAlt = (string)($image['DESCRIPTION'] ?? $arItem['NAME']);
        $link = (string)($arItem['LINK'] ?? '');
        $discount = (string)($arItem['DISCOUNT'] ?? '');
        ?>
        <div class="<?= htmlspecialcharsbx($config['slide']) ?>">
            <?php if ($variant === 'gallery'): ?>
                <a data-fancybox="lokamed-gallery" class="lokamed-about-gallery__item" href="<?= htmlspecialcharsbx($link ?: $imageSrc) ?>">
                    <img src="<?= htmlspecialcharsbx($imageSrc) ?>" alt="<?= htmlspecialcharsbx($imageAlt) ?>" loading="lazy">
                </a>
            <?php elseif ($variant === 'partners'): ?>
                <div class="lokamed-partner-card">
                    <?php if ($discount !== ''): ?>
                        <span class="lokamed-partner-card__discount"><?= htmlspecialcharsbx($discount) ?></span>
                    <?php endif; ?>
                    <?php if ($link !== ''): ?>
                        <a class="lokamed-partner-card__logo lokamed-partner-card__logo-link" href="<?= htmlspecialcharsbx($link) ?>" target="_blank" rel="noopener noreferrer" aria-label="Открыть сайт партнёра <?= htmlspecialcharsbx($arItem['NAME']) ?>">
                            <img src="<?= htmlspecialcharsbx($imageSrc) ?>" alt="<?= htmlspecialcharsbx($imageAlt) ?>" loading="lazy">
                        </a>
                    <?php else: ?>
                        <div class="lokamed-partner-card__logo">
                            <img src="<?= htmlspecialcharsbx($imageSrc) ?>" alt="<?= htmlspecialcharsbx($imageAlt) ?>" loading="lazy">
                        </div>
                    <?php endif; ?>
                    <div class="lokamed-partner-card__title"><?= htmlspecialcharsbx($arItem['NAME']) ?></div>
                    <?php if ($arItem['PREVIEW_TEXT'] !== '' || $link !== ''): ?>
                        <div class="lokamed-partner-card__details">
                            <?php if ($arItem['PREVIEW_TEXT'] !== ''): ?>
                                <div class="lokamed-partner-card__text"><?= $arItem['PREVIEW_TEXT'] ?></div>
                            <?php endif; ?>
                            <?php if ($link !== ''): ?>
                                <div class="lokamed-partner-card__more">
                                    <a href="<?= htmlspecialcharsbx($link) ?>" target="_blank" rel="noopener noreferrer">Перейти на сайт</a>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </div>
            <?php else: ?>
                <a<?= $link === '' ? ' data-fancybox="lokamed-achievements"' : '' ?> href="<?= htmlspecialcharsbx($link ?: $imageSrc) ?>" class="lokamed-achievement-card">
                    <span class="lokamed-achievement-card__image">
                        <img src="<?= htmlspecialcharsbx($imageSrc) ?>" alt="<?= htmlspecialcharsbx($imageAlt) ?>" loading="lazy">
                    </span>
                    <span class="lokamed-achievement-card__title"><?= htmlspecialcharsbx($arItem['NAME']) ?></span>
                </a>
            <?php endif; ?>
        </div>
    <?php endforeach; ?>
</div>
