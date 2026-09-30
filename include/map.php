<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$iblock_id = 42;
$mapData = CIBlockElement::GetList(
    Array("ID" => "ASC"),
    Array("IBLOCK_ID" => $iblock_id, "ACTIVE" => "Y"),
    false,
    false,
    Array(
        'ID',
        'NAME',
        'PROPERTY_MAP'
    )
);
while ($ar_fields = $mapData->GetNext()) {
    $onMap = explode(",",$ar_fields['PROPERTY_MAP_VALUE']);
    $mapLAT = $onMap[0];
    $mapLON = $onMap[1];
    $arPlacemarks[] = array(
        "LAT" => $mapLAT,
        "LON" => $mapLON,
        "TEXT" => $ar_fields["NAME"],
    );
}

$APPLICATION->IncludeComponent(
	"bitrix:map.yandex.view",
	"",
	Array(
		"DEV_MODE" => "Y",
		"API_KEY" => "",
		"CONTROLS" => array("ZOOM", "MINIMAP", "TYPECONTROL", "SCALELINE"),
		"INIT_MAP_TYPE" => "MAP",
        "MAP_DATA" => serialize(array('yandex_scale' => 10, 'yandex_lat' => '55.8224223067512', 'yandex_lon' => '37.41033053808573', 'PLACEMARKS' => $arPlacemarks)),
		"MAP_HEIGHT" => "500",
		"MAP_ID" => "",
		"MAP_WIDTH" => "600",
		"OPTIONS" => array("ENABLE_SCROLL_ZOOM", "ENABLE_DBLCLICK_ZOOM", "ENABLE_DRAGGING")
	)
);