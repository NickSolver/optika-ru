<?php
class BuildSotbitLinkByProps {
    private $filterSefTemplate;
    private $sectionUrl;
    private $siteID;
    function __construct($filterSefTemplate, $sectionUrl)
    {
        $this->filterSefTemplate = $filterSefTemplate;
        $this->sectionUrl = rtrim($sectionUrl,'/');
        $this->siteID = 's1';
    }
    private function getPropertyCode($arProp)
    {
        if ($arProp["CODE"]) {
            $code = rawurlencode(str_replace("/", "-", ToLower($arProp["CODE"])));
        } else {
            $code = $arProp["ID"];
        }
        return $code;
    }
    private function getPropertyValue($arProp)
    {
        if (!empty($arProp['LINK_ELEMENT_VALUE']) && $arProp['LINK_ELEMENT_VALUE'][$arProp["VALUE"]]['CODE']) {
            $value = $arProp['LINK_ELEMENT_VALUE'][$arProp["VALUE"]]['CODE'];
        } else if ($arProp["VALUE_XML_ID"]) {
            $value = $arProp["VALUE_XML_ID"];
        } elseif ($arProp["VALUE"]) {
            $value = strip_tags($arProp["VALUE"]);
        }
        return rawurlencode(ToLower($value));
    }
    private function prepareFilter($arProp)
    {
        return $this->getPropertyCode($arProp).'-is-'.$this->getPropertyValue($arProp);
    }
    public function getRealLink($arProp)
    {
        $filter = $this->prepareFilter($arProp);
        return str_replace(['#SECTION_CODE_PATH#', '#SMART_FILTER_PATH#'], [$this->sectionUrl, $filter], $this->filterSefTemplate);
    }
    public function getSotbitLink($realUrl = false, $arProp = false, $debug = false)
    {
        if (!$realUrl) {
            $realUrl = $this->getRealLink($arProp);
        }
        if (!$realUrl) return;

        if (class_exists('\Sotbit\Seometa\SeometaUrlTable')) {
            $sotbitUrlTableMethod = '\Sotbit\Seometa\SeometaUrlTable';
        } else if (class_exists('\Sotbit\Seometa\Orm\SeometaUrlTable')) {
            $sotbitUrlTableMethod = '\Sotbit\Seometa\Orm\SeometaUrlTable';
        }

        if ($sotbitUrlTableMethod) {
            $rsDataUrl = $sotbitUrlTableMethod::getList([
                'select' => ['REAL_URL', 'NEW_URL', 'SITE_ID'],
                'filter' => [
                    'ACTIVE'    => 'Y',
                    '=REAL_URL'    => $realUrl,
                    'SITE_ID' => $this->siteID
                ],
                'order' => ['ID' => 'ASC']
            ]);

            if ($arResUrl = $rsDataUrl->Fetch()) {
                return $arResUrl['NEW_URL'];
            } else {
                if ($debug) {
                    return $realUrl;
                }
            }
        }
    }
    public function getSotbitLinkByMultiply($arPropRaw, $key)
    {
        $arProp = [
            "VALUE_XML_ID" => $arPropRaw["VALUE_XML_ID"][$key],
            "VALUE" => $arPropRaw["VALUE"][$key],
            "CODE" => $arPropRaw["CODE"],
        ];
        return $this->getSotbitLink(false, $arProp, false);
    }
}