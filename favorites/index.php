<?

use Bitrix\Main\Loader;
use Yenisite\Favorite\Favorite;

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
global $rz_b2_options;
$APPLICATION->SetTitle("Каталог");
?>
<main data-catalog-banner-pos="middle-to-top" class="container catalog-page" id="catalog-page" data-page="catalog-page">
    <div class="row">
        <div class="sort-n-view for-catalog">
            <?php

Loader::includeModule('yenisite.favorite');

$arFavorite = Favorite::getProductsArray();

$arFavoriteIds = array_column($arFavorite, 'PRODUCT_ID');

if (empty($arFavoriteIds)) {
    echo "Список избранного пуст";
} else {
    include $_SERVER["DOCUMENT_ROOT"] . '/bitrix/templates/romza_bitronic2_2.26.1/components/bitrix/catalog/.default/include/service_var.php';

    include $_SERVER["DOCUMENT_ROOT"] . '/bitrix/templates/romza_bitronic2_2.26.1/components/bitrix/catalog/.default/lang/ru/section.php';
    ?>

        <?php if ($rz_b2_options['block_show_sort_block'] != 'N'): ?>
            <?php include $_SERVER["DOCUMENT_ROOT"] . '/bitrix/templates/romza_bitronic2_2.26.1/components/bitrix/catalog/.default/include/sort.php' ?>
        <?php endif ?>
        <?php include $_SERVER["DOCUMENT_ROOT"] . '/bitrix/templates/romza_bitronic2_2.26.1/components/bitrix/catalog/.default/include/view.php' ?>
    </div>

    <?php

    include $_SERVER["DOCUMENT_ROOT"] . '/bitrix/templates/romza_bitronic2_2.26.1/components/bitrix/catalog/.default/include/pagination.php';

    $catalogClass = 'catalog ';
    $catalogClass .= ($view == 'table' ? 'catalog-table' : $view);
    $catalogClass .= ' active';
    $catalogClass .= ($arParams['HIDE_ICON_SLIDER'] === 'Y' ? ' thumbs-disabled' : '');

    global ${$arParams["FILTER_NAME"]};
    if (!empty(${$arParams["FILTER_NAME"]})) {
        $arSkipFilters = array('FACET_OPTIONS');

        $arDiff = array_diff(array_keys(${$arParams["FILTER_NAME"]}), $arSkipFilters);
        $bFilterSet = 0 < count($arDiff);

        $arParams["CACHE_FILTER"] = $bFilterSet ? $arParams['CACHE_FILTER'] : 'Y';

        unset($arSkipFilters, $arDiff);
        if (array_key_exists('rz_all_elements', $_REQUEST) && $_REQUEST['rz_all_elements'] === 'y') {
            unset(${$arParams["FILTER_NAME"]}['FACET_OPTIONS']);
        }
    }

    global $arrFilter;
    $arrFilter["ID"] = $arFavoriteIds;

    $arParams = array(
        'SHOW_ALL_WO_SECTION' => 'Y',
        'FILTER_NAME' => 'arrFilter',
        'PAGE_ELEMENT_COUNT' => 36,
        'IBLOCK_TYPE' => 'catalog',
        'IBLOCK_ID' => '30',
        'ELEMENT_SORT_FIELD' => 'property_NOT_AVAILBLE',
        'ELEMENT_SORT_ORDER' => 'ASC',
        'ELEMENT_SORT_FIELD2' => 'name',
        'ELEMENT_SORT_ORDER2' => 'asc',
        'META_KEYWORDS' => '-',
        'META_DESCRIPTION' => '-',
        'COMPATIBLE_MODE' => 'Y',
        'BROWSER_TITLE' => '-',
        'USE_MAIN_ELEMENT_SECTION' => 'Y',
        'SECTION_URL' => '/product/#SECTION_CODE_PATH#/',
        'DETAIL_URL' => '/product/#SECTION_CODE_PATH#/#ELEMENT_CODE#/',
        'BASKET_URL' => '/personal/cart/',
        'ACTION_VARIABLE' => 'action',
        'PRODUCT_ID_VARIABLE' => 'id',
        'SECTION_ID_VARIABLE' => 'SECTION_ID',
        'PRODUCT_QUANTITY_VARIABLE' => 'quantity2',
        'PRODUCT_PROPS_VARIABLE' => 'prop',
        'INCLUDE_SUBSECTIONS' => 'Y',
        'ADD_SECTIONS_CHAIN' => 'Y',
        'PROPERTY_CODE' =>
            array(
                0 => 'POL',
                1 => 'FORMA',
                2 => 'BRANDS',
                3 => 'COLORS',
                4 => 'FORMA',
                5 => 'KOLVO',
                6 => 'TOLSHINA',
            ),
        'PRICE_CODE' =>
            array(
                0 => 'BASE',
            ),
        'LIST_PRICE_SORT' => 'CATALOG_PRICE_1',
        'USE_PRICE_COUNT' => 'N',
        'USE_PRICE_COUNT_' => NULL,
        'SHOW_PRICE_COUNT' => '1',
        'PRICE_VAT_INCLUDE' => 'Y',
        'PRICE_VAT_SHOW_VALUE' => 'N',
        'USE_PRODUCT_QUANTITY' => 'Y',
        'ADD_PROPERTIES_TO_BASKET' => 'Y',
        'PARTIAL_PRODUCT_PROPERTIES' => 'Y',
        'PRODUCT_PROPERTIES' =>
            array(
                0 => 'GRAD',
                1 => 'DIOP',
                2 => 'KRIV',
                3 => 'CYL',
            ),
        'CACHE_TYPE' => 'A',
        'CACHE_TIME' => '36000000',
        'CACHE_GROUPS' => 'Y',
        'CACHE_FILTER' => 'Y',
        'SET_TITLE' => 'Y',
        'MESSAGE_404' => '',
        'SET_STATUS_404' => 'Y',
        'SHOW_404' => 'N',
        'FILE_404' => '',
        'OFFER_TREE_PROPS' =>
            array(),
        'OFFER_ADD_PICT_PROP' => 'MORE_PHOTO',
        'OFFERS_CART_PROPERTIES' =>
            array(),
        'OFFERS_FIELD_CODE' =>
            array(
                0 => 'ID',
                1 => '',
                2 => 'DETAIL_PAGE_URL',
            ),
        'OFFERS_PROPERTY_CODE' =>
            array(
                0 => '',
                1 => 'COLOR_REF',
                2 => 'RAM_REF',
                3 => '',
            ),
        'OFFERS_SORT_FIELD' => 'sort',
        'OFFERS_SORT_ORDER' => 'asc',
        'OFFERS_SORT_FIELD2' => 'id',
        'OFFERS_SORT_ORDER2' => 'asc',
        'OFFERS_LIMIT' => '0',
        'HIDE_DISABLED_PROPS_OF_OFFERS' => false,
        'PRODUCT_SUBSCRIPTION' => '',
        'SHOW_DISCOUNT_PERCENT' => 'Y',
        'SHOW_OLD_PRICE' => 'Y',
        'MESS_BTN_BUY' => 'Купить',
        'MESS_BTN_ADD_TO_BASKET' => 'В корзину',
        'MESS_BTN_SUBSCRIBE' => '',
        'MESS_BTN_DETAIL' => 'Подробнее',
        'MESS_NOT_AVAILABLE' => 'Нет в наличии',
        'VIEWED_TITLE' => 'Вы смотрели',
        'SECTION_ID' => '0',
        'SECTION_CODE' => '',
        'CONVERT_CURRENCY' => 'Y',
        'CURRENCY_ID' => 'RUB',
        'HIDE_NOT_AVAILABLE' => 'N',
        'SLIDERS_HIDE_NOT_AVAILABLE' => 'N',
        'LABEL_PROP' => '-',
        'ADD_PICT_PROP' => '-',
        'PRODUCT_DISPLAY_MODE_CUSTOM' => 'Y',
        'HIDE_ICON_SLIDER' => 'N',
        'ADD_PARENT_PHOTO' => 'N',
        'PAGER_SHOW_ALWAYS' => 'N',
        'LAZY_LOAD' => 'N',
        'PAGER_DESC_NUMBERING' => 'N',
        'PAGER_DESC_NUMBERING_CACHE_TIME' => '36000',
        'PAGER_SHOW_ALL' => 'Y',
        'PAGER_TEMPLATE' => '.default',
        'DISPLAY_TOP_PAGER' => 'N',
        'DISPLAY_BOTTOM_PAGER' => 'Y',
        'PAGER_TITLE' => 'Товары',
        'USE_STORE' => 'Y',
        'HIDE_STORE_LIST' => 'Y',
        'RESIZER_SECTION' => '14',
        'RESIZER_SECTION_ICON' => '5',
        'RESIZER_SECTION_VIP' => '15',
        'STICKER_NEW' => '14',
        'STICKER_HIT' => NULL,
        'STICKER_BESTSELLER' => NULL,
        'TAB_PROPERTY_NEW' => 'NEW',
        'TAB_PROPERTY_HIT' => 'HIT',
        'TAB_PROPERTY_SALE' => 'SALE',
        'TAB_PROPERTY_BESTSELLER' => 'BESTSELLER',
        'MAIN_SP_ON_AUTO_NEW' => 'Y',
        'SHOW_CATCHBUY' => true,
        'SHOW_BUY_BTN' => true,
        'ARTICUL_PROP' => '-',
        'USE_REVIEW' => 'Y',
        'USE_OWN_REVIEW' => 'Y',
        'REVIEWS_MODE' => 'forum',
        'FEEDBACK_IBLOCK_ID' => '#FEEDBACK_IBLOCK_ID#',
        'IS_MOBILE' => false,
        'STORE_DISPLAY_TYPE' => 'graphic',
        'PRODUCT_AVAILABILITY_VIEW' => false,
        'STORES' =>
            array(
                0 => '',
                1 => '',
            ),
        'HOVER-MODE' => 'detailed-expand',
        'HIDE_BUTTONS' => true,
        'SHOW_STARS' => 'N',
        'DISPLAY_FAVORITE' => true,
        'DISPLAY_ONECLICK' => true,
        'DISPLAY_COMPARE_SOLUTION' => false,
        'SHOW_ARTICLE' => 'Y',
        'SHOW_COMMENT_COUNT' => 'N',
        'SHOW_GALLERY_THUMB' => 'N',
        'HIDE_ITEMS_NOT_AVAILABLE' => false,
        'HIDE_ITEMS_ZER_PRICE' => false,
        'HIDE_ITEMS_WITHOUT_IMG' => false,
        'VIP_ITEM_PROPERTY' => 'RZ_VIP',
        'BIGDATA_SECTION' => true,
        'SHOW_HOVER_PHOTO' => false,
        'DATA_FILTER' => NULL,
        'SHOW_STORE' => 'disabled',
        'FILTER_SET' => false,
        'BANNER_PLACE' => false,
    );


?>
    <div class="<?= $catalogClass ?>" id="catalog_section" data-hover-effect="<?= $arResult['HOVER-MODE'] ?>"
         data-quick-view-enabled="false"><!--
				--><?php $APPLICATION->IncludeComponent(
            "bitrix:catalog.section",
            $view,
            $arParams
        ); ?><!--
    --></div>
<?php } ?>
    </div>
    </div>
</main>
<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>