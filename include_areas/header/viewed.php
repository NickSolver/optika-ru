<?php
if (Bitrix\Main\Loader::includeModule('catalog')){
    $APPLICATION->IncludeComponent(
        "yenisite:proxy",
        "viewed",
        array(
            "COMPONENT_TEMPLATE" => "viewed",
            "RESIZER_ITEM" => "37",
        ),
        false
    );
}