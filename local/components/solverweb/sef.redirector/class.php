<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Iblock\ElementTable;
use \Bitrix\Main\Data\Cache;

class SefRedirector extends CBitrixComponent
{
    public $params;

    public function onPrepareComponentParams($params)
    {
        $this->params = $params;
    }

    public function executeComponent()
    {
        $this->params["CODE"] = $this->GetCode();

        if (!$this->params["CODE"]) return false;

        $cache = Cache::createInstance();
        $cache_key = "SR_" . $this->params["CODE"];

        if ($cache->initCache($this->params["CACHE_TIME"], $cache_key)) {
            $data = $cache->getVars();
        } elseif ($cache->startDataCache()) {
            $data = $this->getData();
            $cache->endDataCache($data);
        }

        if ($data["DETAIL_PAGE_URL"] && $data["DETAIL_PAGE_URL"] != $this->params["URI"]) {
           LocalRedirect($data["DETAIL_PAGE_URL"], true, "301 Moved permanently");
        }
    }

    public function getCode()
    {
        $addr = '';

        if ($this->params["OLD_SEF_RULE"] == "product/#ELEMENT_CODE#/") {

            $pattern = '~product/(.*)/~';
            preg_match($pattern, $this->params["URI"], $matches);
            $addr = $matches[1];
        }

        return $addr ?? false;
    }

    public function getData()
    {
        $dbItem = ElementTable::getList([
            'order' => array('SORT' => 'ASC'),
            'select' => array('ID', 'IBLOCK_ID', 'IBLOCK_SECTION_ID', 'CODE', 'DETAIL_PAGE_URL' => 'IBLOCK.DETAIL_PAGE_URL'),
            'filter' => array('IBLOCK_ID' => $this->params["IBLOCK_ID"], "CODE" => $this->params["CODE"]),
            'limit' => 1,
            'cache' => array(
                'ttl' => $this->params["CACHE_TIME"],
                'cache_joins' => true
            ),
        ]);

        if ($arItem = $dbItem->fetch()) {
            $arItem['DETAIL_PAGE_URL'] = \CIBlock::ReplaceDetailUrl($arItem ['DETAIL_PAGE_URL'], $arItem, false, 'E');
        }

        return $arItem;
    }
}
