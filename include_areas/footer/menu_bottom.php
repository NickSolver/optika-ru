<?php

$APPLICATION->IncludeComponent(
	"bitrix:menu", 
	"static", 
	array(
		"ROOT_MENU_TYPE" => "bot",
		"MAX_LEVEL" => "2",
		"CHILD_MENU_TYPE" => "top_sub",
		"USE_EXT" => "N",
		"MENU_CACHE_TYPE" => "A",
		"MENU_CACHE_TIME" => "604800",
		"MENU_CACHE_USE_GROUPS" => "Y",
		"MENU_CACHE_GET_VARS" => array(
		),
		"DELAY" => "N",
		"ALLOW_MULTI_SELECT" => "N",
		"CACHE_SELECTED_ITEMS" => false,
	),
	false
);