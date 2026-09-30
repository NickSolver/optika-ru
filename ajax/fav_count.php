<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
use Bitrix\Main\Loader;
use Yenisite\Favorite\Favorite;

Loader::includeModule('yenisite.favorite');

$arFavorite = Favorite::getProductsArray();

$favCount = is_countable($arFavorite) ? count($arFavorite) : 0;

if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
    echo $favCount;
}