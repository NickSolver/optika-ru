<?
if(Bitrix\Main\Loader::includeModule('yenisite.oneclick')
&& Bitrix\Main\Loader::includeModule('sale'))
{
    global $rz_b2_options;
	$APPLICATION->IncludeComponent(
	"yenisite:oneclick.buy", 
	"bitronic2", 
	array(
		"COMPONENT_TEMPLATE" => "bitronic2",
		"IBLOCK_TYPE" => "catalog",
		"IBLOCK_ID" => "#CATALOG_IBLOCK_ID#",
		"IBLOCK_ELEMENT_ID" => $_REQUEST["id"],
		"PERSON_TYPE_ID" => "1",
		"SHOW_FIELDS" => array(
			//0 => "EMAIL",
			0 => "PHONE",
		),
		"REQ_FIELDS" => array(
			0 => "PHONE",
		),
		"ALLOW_AUTO_REGISTER" => "Y",
        "USE_CAPTCHA" => 'N',
        "USE_CAPTCHA_FORCE" => 'N',
        "USE_GOOGLE_CAPTCHA" => 'N',
		"MESSAGE_OK" => "Ваш заказ принят, его номер - #ID#. Менеджер свяжется с вами в ближайшее время. Спасибо что выбрали нас!",
		"PAY_SYSTEM_ID" => "0",
		"DELIVERY_ID" => "0",
		"AS_EMAIL" => "0",
		"AS_NAME" => "0",
		"FIELD_CLASS" => "textinput",
		"FIELD_PLACEHOLDER" => "Y",
		"FIELD_QUANTITY" => "Y",
		"SEND_REGISTER_EMAIL" => "Y",
		"EMPTY" => $arParams["EMPTY"],
		"USER_REGISTER_EVENT_NAME" => "USER_INFO",
		"OFFER_PROPS" => $arProps,
	),
	false
);
}?>