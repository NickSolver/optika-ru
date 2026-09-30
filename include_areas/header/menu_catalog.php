<? global $rz_b2_options; ?>
<?
if($rz_b2_options['hide_all_hrefs'] == 'Y' && ($APPLICATION->GetCurDir() == SITE_DIR.'personal/order/' || $APPLICATION->GetCurDir() == SITE_DIR.'personal/order/make_/')) return;
$APPLICATION->IncludeComponent(
	"bitrix:menu", 
	"catalog", 
	array(
		"ROOT_MENU_TYPE" => "catalog",
		"MAX_LEVEL" => "2",
		"CHILD_MENU_TYPE" => "",
		"USE_EXT" => "Y",
		"MENU_CACHE_TYPE" => "A",
		"MENU_CACHE_TIME" => "604800",
		"MENU_CACHE_USE_GROUPS" => "Y",
		"MENU_CACHE_GET_VARS" => array(
		),
		"VIEW_HIT" => $rz_b2_options["block_main-menu-elem"],
		"HITS_POSITION" => $rz_b2_options["menu-hits-position"],
		"SHOW_ICONS" => $rz_b2_options["menu-show-icons"],
		"SHOW_FIRST_LVL_IMG" => $rz_b2_options["img-for-first-lvl-menu"],
		"SHOW_SECOND_LVL_IMG" => $rz_b2_options["img-for-second-lvl-menu"],
		"SHOW_THIRD_LVL_IMG" => $rz_b2_options["img-for-third-lvl-menu"],
		"OPEN_MENU" => $rz_b2_options["menu-opened-in-catalog"]=="open",
		"IN_CATALOG" => defined("IN_CATALOG_LIST"),
		"ICON_RESIZER_SET" => "8",
		"RESIZER_SET" => "14",
		"CACHE_SELECTED_ITEMS" => false,
		"PRICE_CODE" => array(
			0 => "BASE",
		),
		"COMPONENT_TEMPLATE" => "catalog",
		"DELAY" => "N",
		"ALLOW_MULTI_SELECT" => "N",
		"HITS_COMPONENT" => "CATALOG",
		"HITS_TYPE" => "SHOW",
		"SLIDERS_HIDE_NOT_AVAILABLE" => "N"
	),
	false
);