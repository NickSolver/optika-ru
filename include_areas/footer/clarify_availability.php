<?
if (\Bitrix\Main\Loader::IncludeModule("yenisite.feedback")) {
	global $rz_b2_options;
	global $clarifySkipComponentCaptcha;
	$APPLICATION->IncludeComponent('yenisite:feedback.add', 'modal_contact', array(
		"IBLOCK_TYPE" => "b2glass_feedback",
		"IBLOCK" => "11",
		"SUCCESS_TEXT" => "Спасибо! Наши менеджеры уточнят наличие товара и свяжутся с вами.",
		"USE_CAPTCHA" => $clarifySkipComponentCaptcha ? "N" : "Y",
		"USE_GOOGLE_CAPTCHA" => "N",
		"SHOW_SECTIONS" => "N",
		"PRINT_FIELDS" => array("EMAIL", "PHONE", "PRODUCT", "USER"),
		"TITLE" => "Уточнить наличие",
		"ACTIVE" => "Y",
		"EVENT" => "ELEMENT_CONTACT",
		"EMAIL" => "EMAIL",
		"PHONE" => "PHONE",
		"FORM" => "form_clarify_availability",
		"EMPTY" => $arParams["EMPTY"],
	), false);
}
