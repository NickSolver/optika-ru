<?
// тегирование кастомное поле Фильтр
AddEventHandler("iblock", "OnIBlockPropertyBuildList", array("CIBlockNewProperty", "OnIBlockPropertyBuildCustomFilterHandler"));

class CIBlockNewProperty
{
	static function OnIBlockPropertyBuildCustomFilterHandler(){				
		
		return array(
			'PROPERTY_TYPE'      => 'S',
			'USER_TYPE'         => 'SAsproCustomFilter',
			'DESCRIPTION'      => 'Фильтр',
			'GetPropertyFieldHtml'   => array('CIBlockNewProperty', 'GetPropertyFieldHtmlCustomFilterHandler'),
			'GetSettingsHTML'   => array('CIBlockNewProperty', 'GetSettingsHTMLCustomFilterHandler'),
			'PrepareSettings'   => array('CIBlockNewProperty', 'PrepareSettingsCustomFilterHandler'),
		);
	}
	
	static function GetPropertyFieldHtmlCustomFilterHandler($arProperty, $value, $strHTMLControlName){		

		static $cache, $jsFile;

		if(!isset($cache)){
			$cache = array();
			$GLOBALS['APPLICATION']->AddHeadScript('/bitrix/components/bitrix/catalog.section/settings/filter_conditions/script.js');
			if(!file_exists($_SERVER['DOCUMENT_ROOT'].($jsFile = '/bitrix/components/bitrix/catalog.section/settings/filter_conditions/script.js'))){
				unset($jsFile);
			}
		}

		if($jsFile){
			if(\Bitrix\Main\Loader::includeModule('fileman')){
				$val = strlen($value['VALUE']) ? $value['VALUE'] : '[]';

				$iblockId = isset($arProperty['USER_TYPE_SETTINGS']) && isset($arProperty['USER_TYPE_SETTINGS']['IBLOCK_ID']) ? $arProperty['USER_TYPE_SETTINGS']['IBLOCK_ID'] : 0;

				if(!isset($cache[$iblockId])){
					if(\Bitrix\Main\Loader::includeModule('catalog')){
						$arInfo = \CCatalogSKU::GetInfoByProductIBlock($iblockId);
						$offersIblockId = $cache[$iblockId] = $arInfo ? $arInfo['IBLOCK_ID'] : false;
					}
				}
				else{
					$offersIblockId = $cache[$iblockId];
				}

				$html = '<input type="hidden" id="'.$strHTMLControlName['VALUE'].'" name="'.$strHTMLControlName['VALUE'].'" value="'.htmlspecialcharsbx(is_array($val) ? reset($val) : $val).'" data-bx-property-id="'.$arProperty['CODE'].'" data-bx-comp-prop="true" />';
				$html .= "\n".'<script>'.
					'var tv = BX(\'tr_PROPERTY_'.$arProperty['ID'].'\');'.
					'if(tv){'.
						'var iv = BX(\''.$strHTMLControlName['VALUE'].'\');'.
						'if(iv){'.
							'var td = BX.findParent(iv, {tag: \'td\'});'.
							'if(td){'.
								'var tdd = BX.findChildren(td, {tag: \'div\'}, true);'.
								'if(tdd){'.
									'for(var i in tdd){'.
										'BX.cleanNode(tdd[i]);'.
									'}'.
								'}'.
								'initFilterConditionsControl({'.
									'data: \'{"iblockId":'.$iblockId.($offersIblockId ? ',"offersIblockId":'.$offersIblockId : '').'}\','.
									'oCont: td,'.
									'oInput: iv,'.
									'propertyID: \''.$arProperty['CODE'].'\','.
									'propertyParams: {'.
										'DEFAULT: \'\','.
										'ID: \''.$arProperty['CODE'].'\','.
										'JS_DATA: \'{"iblockId":'.$iblockId.($offersIblockId ? ',"offersIblockId":'.$offersIblockId : '').'}\','.
										'JS_EVENT: \'initFilterConditionsControl\','.
										'JS_FILE: \'/bitrix/components/bitrix/catalog.section/settings/filter_conditions/script.js\','.
										'NAME: \'FilterName\','.
										'JS_MESSAGES: \'{"invalid_": "CUSTOM_FILTER_PROP_INVALID"}\','.
										'MULTIPLE: \'N\','.
										'PARENT: \'DATA_SOURCE\','.
										'ROWS: 0,'.
										'TOOLTIP: \'\','.
										'TYPE: \'CUSTOM\','.
										'_propId: \''.$strHTMLControlName['VALUE'].'\''.
									'}'.
								'});'.
							'}'.
						'}'.
					'}'.
					'</script>';
			}
		}
		else{
			$html = '<input type="text" id="'.$strHTMLControlName['VALUE'].'" name="'.$strHTMLControlName['VALUE'].'" value="'.htmlspecialcharsbx(is_array($val) ? reset($val) : $val).'" data-bx-property-id="'.$arProperty['CODE'].'" data-bx-comp-prop="true" />';
		}

		return $html;
	}
	
	function PrepareSettingsCustomFilterHandler($arFields){
		
		$arFields['USER_TYPE_SETTINGS']['IBLOCK_ID'] = isset($arFields['USER_TYPE_SETTINGS']) && isset($arFields['USER_TYPE_SETTINGS']['IBLOCK_ID']) ? intval($arFields['USER_TYPE_SETTINGS']['IBLOCK_ID']) : false;

		$arFields['USER_TYPE_SETTINGS']['IBLOCK_TYPE_ID'] = isset($arFields['USER_TYPE_SETTINGS']) && isset($arFields['USER_TYPE_SETTINGS']['IBLOCK_TYPE_ID']) ? trim($arFields['USER_TYPE_SETTINGS']['IBLOCK_TYPE_ID']) : false;

		$arFields['FILTRABLE'] = $arFields['SMART_FILTER'] = $arFields['SEARCHABLE'] = $arFields['MULTIPLE'] = 'N';

        return $arFields;
	}

	function GetSettingsHTMLCustomFilterHandler($arProperty, $strHTMLControlName, &$arPropertyFields){

		$arPropertyFields = array(
            'HIDE' => array(
            	'FILTRABLE',
            	'DEFAULT_VALUE',
            	'SEARCHABLE',
            	'MULTIPLE_CNT',
            	'COL_COUNT',
            	'MULTIPLE',
            	'WITH_DESCRIPTION',
            	'FILTER_HINT',
            ),
            'SET' => array(
            	'FILTRABLE' => 'N',
            	'SEARCHABLE' => 'N',
            	'MULTIPLE_CNT' => '1',
            	'MULTIPLE' => 'N',
            	'WITH_DESCRIPTION' => 'N',
            ),
        );

		$iblockId = $arProperty['USER_TYPE_SETTINGS']['IBLOCK_ID'];
		$b_f = ($arProperty['PROPERTY_TYPE'] == 'G' || ($arProperty['PROPERTY_TYPE'] == 'E' && $arProperty['USER_TYPE'] == BT_UT_SKU_CODE) ? array('!ID' => $iblockId) : array());
		$html = '<td width="40%">'.GetMessage('BT_ADM_IEP_PROP_LINK_IBLOCK').'</td>'.
			'<td>'.GetIBlockDropDownList($iblockId, $strHTMLControlName['NAME'].'[IBLOCK_TYPE_ID]', $strHTMLControlName['NAME'].'[IBLOCK_ID]', $b_f, 'class="adm-detail-iblock-types"', 'class="adm-detail-iblock-list"').'</td>';

		return $html;
	}
}