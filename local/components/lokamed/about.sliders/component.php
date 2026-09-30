<?php

use Bitrix\Main\Loader;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

$iblockId = (int)($arParams['IBLOCK_ID'] ?? 0);
if ($iblockId <= 0 || !Loader::includeModule('iblock')) {
    return;
}

if ($this->StartResultCache(false, [$iblockId])) {
    global $CACHE_MANAGER;

    if (defined('BX_COMP_MANAGED_CACHE')) {
        $CACHE_MANAGER->RegisterTag('iblock_id_' . $iblockId);
    }

    $this->arResult['ITEMS'] = [];
    $dbItems = CIBlockElement::GetList(
        ['SORT' => 'ASC', 'ID' => 'ASC'],
        [
            'IBLOCK_ID' => $iblockId,
            'ACTIVE' => 'Y',
            'ACTIVE_DATE' => 'Y',
        ],
        false,
        false,
        ['ID', 'NAME', 'PREVIEW_TEXT', 'PREVIEW_PICTURE', 'PROPERTY_LINK', 'PROPERTY_DISCOUNT']
    );

    while ($item = $dbItems->GetNext()) {
        $item['PREVIEW_PICTURE'] = $item['PREVIEW_PICTURE']
            ? CFile::GetFileArray((int)$item['PREVIEW_PICTURE'])
            : [];
        $item['LINK'] = (string)($item['PROPERTY_LINK_VALUE'] ?? '');
        $item['DISCOUNT'] = (string)($item['PROPERTY_DISCOUNT_VALUE'] ?? '');
        $this->arResult['ITEMS'][] = $item;
    }

    $this->IncludeComponentTemplate();
}
