<?
// /opt/php74/bin/php update_price.php

die();
//$_SERVER['DOCUMENT_ROOT'] = __DIR__;

$_SERVER['DOCUMENT_ROOT'] = '/var/www/optika-lokamed.ru/data/www/optika-lokamed.ru';


//phpinfo();
//die();

require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule("iblock");
CModule::IncludeModule("catalog");

$arItems = [];

$el = new CIBlockElement;

$res = CIBlockElement::GetList([], ['IBLOCK_ID' => 30, 'ACTIVE' => 'Y', /*'ID' => 
8195,*/ 'PROPERTY_BRANDS'=> ['Sulz', 'Shanton', 'Aniramela', 'Mario Rossi', 'Enni Marco', 'Zitrone']], false, false, ['IBLOCK_ID', 'ID', 'NAME', 'CATALOG_PRICE_1']);
while ($ob = $res->fetch()) {
    $itemId = $ob['ID'];
    $itemPrice = $ob['CATALOG_PRICE_1'];
    $nacenka = $itemPrice / 100 * 30;
    $newPrice = $itemPrice - $nacenka;

    //$arItems[$ob['ID']] = $itemPrice;
    

    $arFieldsPrice = Array(
        "PRODUCT_ID" => $ob["ID"],
        "CATALOG_GROUP_ID" => 1,
        "PRICE" => $newPrice,
        "CURRENCY" => "RUB"
    );

    $dbPrice = \Bitrix\Catalog\Model\Price::getList([
        "filter" => array(
            "PRODUCT_ID" => $ob["ID"],
            "CATALOG_GROUP_ID" => 1
        )
    ]);

    if ($arPrice = $dbPrice->fetch()) {
        $result = \Bitrix\Catalog\Model\Price::update($arPrice["ID"], $arFieldsPrice);
        $el->Update($ob["ID"], Array('TIMESTAMP_X' => true));
    }

}

//file_put_contents(__DIR__ . '/old_prices.json', json_encode($arItems), LOCK_EX);