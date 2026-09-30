<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Заказы");
preg_match('~/personal/order/detail/(\d+)/?~', $APPLICATION->GetCurPage(false), $matches);
$orderId = $matches[1] ?? null;
define('closeMain', true);
echo '<main class="container">';
?>
<?$APPLICATION->IncludeComponent(
    "bitrix:sale.personal.order.detail",
    "",
    Array(
        "ACTIVE_DATE_FORMAT" => "d.m.Y",
        "CACHE_GROUPS" => "Y",
        "CACHE_TIME" => "3600",
        "CACHE_TYPE" => "A",
        "CUSTOM_SELECT_PROPS" => array(""),
        "DISALLOW_CANCEL" => "N",
        "ID" => $orderId,
        "PATH_TO_CANCEL" => "",
        "PATH_TO_COPY" => "",
        "PATH_TO_LIST" => "/personal/orders/",
        "PATH_TO_PAYMENT" => "payment.php",
        "PICTURE_HEIGHT" => "110",
        "PICTURE_RESAMPLE_TYPE" => "1",
        "PICTURE_WIDTH" => "110",
        "PROP_1" => array(""),
        "PROP_2" => array(""),
        "REFRESH_PRICES" => "N",
        "RESTRICT_CHANGE_PAYSYSTEM" => array("0"),
        "SET_TITLE" => "Y"
    )
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
