<?php ini_set("memory_limit", "1024M");

require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

function translitIt($str){
	$tr = array(
		"А"=>"a","Б"=>"b","В"=>"v","Г"=>"g","Д"=>"d",
		"Е"=>"e","Ё"=>"yo","Ж"=>"j","З"=>"z","И"=>"i",
		"Й"=>"y","К"=>"k","Л"=>"l","М"=>"m","Н"=>"n",
		"О"=>"o","П"=>"p","Р"=>"r","С"=>"s","Т"=>"t",
		"У"=>"u","Ф"=>"f","Х"=>"h","Ц"=>"c","Ч"=>"ch",
		"Ш"=>"sh","Щ"=>"sch","Ъ"=>"","Ы"=>"yi","Ь"=>"",
		"Э"=>"e","Ю"=>"yu","Я"=>"ya","а"=>"a","б"=>"b",
		"в"=>"v","г"=>"g","д"=>"d","е"=>"e","ё"=>"yo","ж"=>"j",
		"з"=>"z","и"=>"i","й"=>"y","к"=>"k","л"=>"l",
		"м"=>"m","н"=>"n","о"=>"o","п"=>"p","р"=>"r",
		"с"=>"s","т"=>"t","у"=>"u","ф"=>"f","х"=>"h",
		"ц"=>"c","ч"=>"ch","ш"=>"sh","щ"=>"sch","ъ"=>"y",
		"ы"=>"y","ь"=>"","э"=>"e","ю"=>"yu","я"=>"ya",
		" "=> "-", "."=> "", "/"=> "_"
	);
	return strtr($str, $tr);
}

$destination = $_SERVER['DOCUMENT_ROOT'].'/import/feed.xml';

$xml = simplexml_load_file($destination);

$shop = $xml->shop[0];
$categories = $shop->categories[0];

CModule::IncludeModule("iblock");
CModule::IncludeModule("catalog");
$el = new CIBlockElement;
$bs = new CIBlockSection;

global $CATS;
$CATS = Array();
$ID = 0;

for ($i = 1; $i <= 10; $i++) {
	foreach($categories as $category) {
		if ($CATS[strval($category["id"])] == ''){

			$rsSections = CIBlockSection::GetList(Array("ID", "NAME"), array('IBLOCK_ID' => 30, '=CODE' => mb_strtolower(translitIt($category))));
			if ($arSection = $rsSections->Fetch()){
				$CATS[strval($category["id"])] = $arSection["ID"];
				$arFieldsUpdate = Array(
					"ACTIVE" => "Y",
					"NAME" => $category,
					"CODE" => mb_strtolower(translitIt($category)),
				);
				//$bs->Update($arSection["ID"], $arFieldsUpdate);
			}

			if ($CATS[strval($category["id"])] == ''){
				$parent = 0;
				if ($CATS[strval($category["parentId"])] <> '') {
					$parent = $CATS[strval($category["parentId"])];
				}
				if ($category["parentId"] == ''){
					$parent = 64; //ID раздела tor
				}
				if ($parent > 0){
					$arFields = Array(
						"ACTIVE" => "Y",
						"IBLOCK_SECTION_ID" => $parent,
						"IBLOCK_ID" => 30,
						"NAME" => $category,
						"CODE" => mb_strtolower(translitIt($category)),
						"SORT" => 500
					);
					//$ID = $bs->Add($arFields);
					//echo "<pre>"; print_r($arFields); echo "</pre>";
					if ($ID > 0) $CATS[strval($category["id"])] = $ID;
				}
			}
		}
	}
}


$offers = $shop->offers[0];

$count = 0;

foreach($offers as $offer) {
	$count++;
	if ($count < 7999 or $count > 10000) continue;
	$url = explode("/product/", $offer->url);

	$UpdateID = '';
	$code = mb_substr($url[1], 0, -1);
	$rsElements = CIBlockElement::GetList(Array("ID", "NAME", "CODE"), array('IBLOCK_ID' => 30, '=CODE' => $code));
	if ($arElement = $rsElements->Fetch()){
		$UpdateID = $arElement["ID"];
	}


	$PROP = array();
	$params = $offer->param;

	foreach($params as $param) {
		switch($param["name"]){
			case "Пол": 
				$val = 137;
				if ($param == 'Мужские' or $param == 'MAN') {
					$val = 134;
				} else if ($param == 'Женские' or $param == 'WOMAN'){
					$val = 135;
				} else if ($param == 'Детские'){
					$val = 136;
				} else if ($param == 'UNISEX' or $param == 'Унисекс'){
					$val = 137;
				}

				$PROP[182] = Array($val);
				break;
			case "Форма":
				if ($param == 'Aсферическая') {
					$val = 138;
				} else if ($param == 'Сферическая'){
					$val = 139;
				} else if ($param == 'Авиатор'){
					$val = 140;
				} else if ($param == 'Wayfarer'){
					$val = 141;
				} else if ($param == 'Oversize'){
					$val = 142;
				} else if ($param == 'Круглые оправы для очков'){
					$val = 143;
				} else if ($param == 'Спортивные'){
					$val = 144;
				} else if ($param == 'Квадратные'){
					$val = 145;
				} else if ($param == 'Кошачий глаз'){
					$val = 146;
				} else if ($param == 'Овальные'){
					$val = 147;
				} else if ($param == 'Серый'){
					$val = 148;
				} else if ($param == 'Прямоугольная'){
					$val = 149;
				} else if ($param == 'Круглая'){
					$val = 150;
				} else if ($param == 'Сине-красная'){
					$val = 151;
				} else if ($param == 'Классическая'){
					$val = 152;
				} else if ($param == 'Бабочка'){
					$val = 153;
				}
				$PROP[183] = Array($val);
				break;
			case "Материал":
				if ($param == 'Пластик') {
					$val = 154;
				} else if ($param == 'Металл'){
					$val = 155;
				} else if ($param == 'Титан'){
					$val = 156;
				} else if ($param == 'Силикон'){
					$val = 157;
				}
				$PROP[184] = Array($val);
				break;
			case "Тип":
				if ($param == 'Ободковая') {
					$val = 158;
				} else if ($param == 'Безободковая'){
					$val = 159;
				} else if ($param == 'На леске'){
					$val = 160;
				} else if ($param == 'Полуободковая'){
					$val = 161;
				} else if ($param == 'Oднофокальные'){
					$val = 162;
				}
				$PROP[185] = Array($val);
				break;
			case "Диоптрии":
				$PROP[186] = $param;
				break;
			case "Цвет оправы":
				$PROP[187] = $param;
				/**if ($param == 'Любые') {
					$val = 79;
				} else if ($param == 'Прозрачные'){
					$val = 80;
				} else if ($param == 'Коричневый'){
					$val = 81;
				} else if ($param == 'Серый'){
					$val = 82;
				} else if ($param == 'Зеленый'){
					$val = 83;
				} else if ($param == 'Фиолетовый'){
					$val = 84;
				} else if ($param == 'Черный'){
					$val = 85;
				} else if ($param == 'Голубой'){
					$val = 86;
				} else if ($param == 'Золотой'){
					$val = 87;
				} else if ($param == 'Серый'){
					$val = 88;
				} else if ($param == 'Бронзовый'){
					$val = 89;
				} else if ($param == 'Розовый'){
					$val = 90;
				} else if ($param == 'Красный'){
					$val = 91;
				} else if ($param == 'Синий'){
					$val = 92;
				} else if ($param == 'Зеркальный'){
					$val = 93;
				} else if ($param == 'Серо-зеленый'){
					$val = 94;
				} else if ($param == 'Серо-синий'){
					$val = 95;
				} else if ($param == 'Красно-коричневый'){
					$val = 96;
				} else if ($param == 'Голубо-розовый'){
					$val = 97;
				} else if ($param == 'Темно-серый'){
					$val = 98;
				} else if ($param == 'Розово-серый'){
					$val = 99;
				} else if ($param == 'Бежево-серый'){
					$val = 100;
				} else if ($param == 'Прозрачно-голубой'){
					$val = 101;
				} else if ($param == 'Желтый'){
					$val = 102;
				} else if ($param == 'Серо-фиолетовый'){
					$val = 103;
				} else if ($param == 'Серо-желтый'){
					$val = 104;
				} else if ($param == 'Коричнево-золотой'){
					$val = 105;
				} else if ($param == 'Розово-фиолетовый'){
					$val = 106;
				} else if ($param == 'Коричнево-розовый'){
					$val = 107;
				} else if ($param == 'Серо-золотой'){
					$val = 108;
				} else if ($param == 'Зелено-голубой'){
					$val = 109;
				} else if ($param == 'Коричнево-серый'){
					$val = 110;
				} else if ($param == 'Коричнево-серебрянный'){
					$val = 111;
				} else if ($param == 'Темно-синий'){
					$val = 112;
				} else if ($param == 'Бордовый'){
					$val = 113;
				} else if ($param == 'Сине-голубой'){
					$val = 114;
				} else if ($param == 'Коричнево-голубой'){
					$val = 115;
				} else if ($param == 'Коричнево-зеленый'){
					$val = 116;
				} else if ($param == 'Розово-оранжевый'){
					$val = 117;
				} else if ($param == 'Темно-зеленый'){
					$val = 118;
				} else if ($param == 'Серо-бронзовый'){
					$val = 119;
				} else if ($param == 'Коричнево-фиолетовый'){
					$val = 120;
				} else if ($param == 'Оранжевый'){
					$val = 121;
				} else if ($param == 'Зелено-желтый'){
					$val = 122;
				} else if ($param == 'Серебряный'){
					$val = 123;
				} else if ($param == 'Красно-оранжевый'){
					$val = 124;
				} else if ($param == 'Белый'){
					$val = 125;
				} else if ($param == 'Зелено-розовый'){
					$val = 126;
				} else if ($param == 'Сине-фиолетовый'){
					$val = 127;
				} else if ($param == 'Серо-серебряный'){
					$val = 128;
				} else if ($param == 'Серо-красный'){
					$val = 129;
				} else if ($param == 'Декор'){
					$val = 130;
				} else if ($param == 'Сине-розовый'){
					$val = 131;
				}
				$PROP[124] = Array($val);**/
				break;
			case "Бренд":
				$PROP[188] = $param;
				break;
		}
	}

	if ($UpdateID <> ''){
		$arFieldsUpdate = Array(
			"ACTIVE"			=> "Y",
			"IBLOCK_ID"			=> 30,
			"NAME"				=> $offer->name,
			"CODE"				=> $code,
			"PREVIEW_TEXT"		=> $offer->description,
			"DETAIL_TEXT"		=> $offer->description,
			"DETAIL_PICTURE"	=> CFile::MakeFileArray($offer->picture[0]),
			//"PREVIEW_PICTURE"	=> CFile::MakeFileArray($offer->picture[0]),
			"IBLOCK_SECTION_ID"	=> $CATS[strval($offer->categoryId)],
			"PROPERTY_VALUES"	=> $PROP
		);
		$el->Update($UpdateID, $arFieldsUpdate);
		$ID = $UpdateID;
	} else {
		$arFields = Array(
			"ACTIVE"			=> "Y",
			"IBLOCK_ID"			=> 30,
			"NAME"				=> $offer->name,
			"CODE"				=> $code,
			"PREVIEW_TEXT"		=> $offer->description,
			"DETAIL_TEXT"		=> $offer->description,
			"DETAIL_PICTURE"	=> CFile::MakeFileArray($offer->picture[0]),
			"PREVIEW_PICTURE"	=> CFile::MakeFileArray($offer->picture[0]),
			"IBLOCK_SECTION_ID"	=> $CATS[strval($offer->categoryId)],
			"PROPERTY_VALUES"	=> $PROP
		);
		$ID = $el->Add($arFields);
	}

	$PRODUCT_ID = $ID;
	$PRICE_TYPE_ID = 1;

	$arFieldsPrice = Array(
		"PRODUCT_ID" => $PRODUCT_ID,
		"CATALOG_GROUP_ID" => $PRICE_TYPE_ID,
		"PRICE" => (string) $offer->price,
		"CURRENCY" => "RUB"
	);

	$res = CPrice::GetList(
			array(),
			array(
				"PRODUCT_ID" => $PRODUCT_ID,
				"CATALOG_GROUP_ID" => $PRICE_TYPE_ID
			)
		);
	
	if ($arrP = $res->Fetch())
	{
		CPrice::Update($arrP["ID"], $arFieldsPrice);
	}
	else
	{
		CPrice::Add($arFieldsPrice);
	}

	$arFieldsCat = array(
		"ID" => $PRODUCT_ID, 
		"VAT_ID" => 1,
		"VAT_INCLUDED" => "Y",
		"QUANTITY" => 100,
		"TYPE" => 1
	);
	CCatalogProduct::Add($arFieldsCat);

}


echo "<pre>"; print_r($categories); echo "</pre>";

?>