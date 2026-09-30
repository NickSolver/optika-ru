<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->RestartBuffer();

switch ($_POST['action']) {
	case 'reviews-form':
		$el = new CIBlockElement;
		$properties = array(
			'NAME' => $_POST['name'],
			'EMAIL' => $_POST['email'],
			'CITY' => $_POST['city'],
			'TEXT' => $_POST['text'],
			'STARS' => $_POST['stars']
		);
		
		$arLoadProductArray = Array(  
			'MODIFIED_BY' => 1,
			'IBLOCK_ID' => 32,
			'PROPERTY_VALUES' => $properties,  
			'NAME' => 'Отзыв от ' . $_POST['name'],  
			'ACTIVE' => 'N',
			'PREVIEW_TEXT' => '',  
			'DETAIL_TEXT' => '',
			"CODE" => ''
		);

		$el->Add($arLoadProductArray);
		
		break;
	
	default:
		# code...
		break;
}