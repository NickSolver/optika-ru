<?if (CModule::IncludeModule("yenisite.feedback")):?>
	<?global $rz_b2_options;
	$APPLICATION->IncludeComponent(
		"yenisite:feedback.add",
		"modal_feedback",
		array(
			"IBLOCK_TYPE" => "b2glass_feedback",
			"IBLOCK" => "7",
			"NAME_FIELD" => "EMAIL",
			"COLOR_SCHEME" => "green",
			"TITLE" => "Обратная связь",
			"SUCCESS_TEXT" => "Спасибо! Ваше обращение принято. После обработки наш специалист свяжется с Вами.",
            "USE_CAPTCHA" => 'N',
            "USE_GOOGLE_CAPTCHA" => $rz_b2_options['use_google_captcha'] == 'Y' ? $rz_b2_options["captcha-feedback"] : 'N',
			"SHOW_SECTIONS" => "N",
			"PRINT_FIELDS" => array(
				0 => "NAME",
				1 => "PHONE",
				2 => "EMAIL",
				4 => "TEXT",
			),
			"AJAX_MODE" => "Y",
			"CACHE_TYPE" => "A",
			"CACHE_TIME" => "300",
			"ACTIVE" => "Y",
			"EVENT_NAME" => "FEEDBACK",
			"TEXT_REQUIRED" => "N",
			"TEXT_SHOW" => "N",
			"NAME" => "NAME",
			"PHONE" => "PHONE",
			"EMAIL" => "EMAIL",
			"FORM" => "form_feedback",
			"EMPTY" => $arParams["EMPTY"],
			"COMPONENT_TEMPLATE" => "modal",
			"SECTION_CODE" => "",
			"ELEMENT_ID" => "",
			"AJAX_OPTION_JUMP" => "N",
			"AJAX_OPTION_STYLE" => "Y",
			"AJAX_OPTION_HISTORY" => "N"
		),
		false,
		array(
			"HIDE_ICONS" => "N"
		)
	);
?>
<? endif ?>