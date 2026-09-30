<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
use Bitrix\Main\Loader;
// Подключение необходимых модулей
Loader::includeModule("sale");

$basketCount = 0;

$basket = \Bitrix\Sale\Basket::loadItemsForFUser(
    \Bitrix\Sale\Fuser::getId(),
    \Bitrix\Main\Context::getCurrent()->getSite()
);

$itemCount = $basket->count();
if ($itemCount > 0) {
    /** @var \Bitrix\Sale\BasketItem $basketItem */
    foreach ($basket as $basketItem) {
        $basketCount += $basketItem->getQuantity();
        $basketIds[] = $basketItem->getProductId();
    }
}

if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
    if ($_REQUEST["GET_IDS"] == "Y" && !empty($basketIds)) {
        echo json_encode($basketIds);
    } else {
        echo $basketCount;
    }
}