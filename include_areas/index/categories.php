<?global $rz_b2_options;
global $mainSectionsFilter;
$mainSectionsFilter = ["!UF_SHOW_MAIN" => false];
$APPLICATION->IncludeComponent(
    "bitrix:catalog.section.list",
    "main_new",
    array(
        "FILTER_NAME" => "mainSectionsFilter",
        "IBLOCK_TYPE" => "catalog",
        "IBLOCK_ID" => "30",
        "COUNT_ELEMENTS" => "N",
        "TOP_DEPTH" => "2",
        "SECTION_URL" => "",
        "CACHE_TYPE" => "A",
        "CACHE_TIME" => "604800",
        "CACHE_GROUPS" => "N",
        "ADD_SECTIONS_CHAIN" => "N",
        "VIEW_MODE" => "TEXT",
        "SHOW_PARENT_NAME" => "N",
        "COMPONENT_TEMPLATE" => "main",

        "SECTION_CODE" => "",
        "SECTION_FIELDS" => array(
            0 => "",
            1 => "",
        ),
        "SECTION_USER_FIELDS" => array(
            0 => "UF_IMG_BLOCK_FOTO",
            1 => "",
        ),
        "CATEGORIES_ORDER" => $rz_b2_options['order-sCategories']
    ),
    false
);
