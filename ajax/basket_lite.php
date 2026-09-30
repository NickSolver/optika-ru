<?
use Bitrix\Main\Loader;
include_once "include_stop_statistic.php";
if(isset($_POST["rz_ajax"]) && $_POST["rz_ajax"] === "y")
{
    require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
}else{
    if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
}

include_once "include_module.php";

include_once $_SERVER["DOCUMENT_ROOT"].SITE_TEMPLATE_PATH."/lang/".LANGUAGE_ID."/ajax.php";
include_once $_SERVER["DOCUMENT_ROOT"].SITE_TEMPLATE_PATH."/lang/".LANGUAGE_ID."/header.php";

$addResult = array();

try {
    if($_SERVER['REQUEST_METHOD'] != 'POST' || !$_POST['action'])
        throw new Exception("Post Request is incorrect", 1);

    if(!CModule::IncludeModule($moduleId))
        throw new Exception('Module {$moduleId} not installed!');

    if(!CModule::IncludeModule("yenisite.market"))
        throw new Exception('Module yenisite.market not installed!');

    switch($_POST['action'])
    {
        case 'setQuantity':
            $new_quantity = intval($_POST['quantity']);
            $key = $_REQUEST['key'];

            if($new_quantity > 0)
            {
                //check available quantity
                $arProduct = CMarketCatalogProduct::GetByID($_POST['productId']);
                if($arProduct['QUANTITY_TRACE'] == 'Y' && $arProduct['CAN_BUY_ZERO'] != 'Y' && $arProduct['QUANTITY'] < $new_quantity)
                {
                    if ($arProduct['QUANTITY'] <= 0) {
                        throw new Exception('not available quantity', 1);
                    } else {
                        $new_quantity = $arProduct['QUANTITY'];
                    }
                }

                CMarketBasket::setQuantity($key, $new_quantity);
                $codeAction = 'update on new quatnity '.$new_quantity;
            }
            else{
                CMarketBasket::Delete($key);
                $codeAction = 'delete';
            }

            $addResult = array('STATUS' => 'OK', 'MESSAGE' => $codeAction);
            break;

        case 'deleteAll':
            $_SESSION['YEN_MARKET_BASKET'] = array();
            echo 'deleteAll';
            die();
            break;

        case 'updateBasket':
            include_once "include_options.php";
            include $_SERVER["DOCUMENT_ROOT"].SITE_DIR."include_areas/header/basket.php";
            die();
            break;

        case 'addList':
            if (is_array($_POST['items'])) {
                foreach($_POST['items'] as $id => $arItem)
                {
                    $_GET = array_merge($_GET, $arItem);
                    include $_SERVER['DOCUMENT_ROOT'].SITE_DIR.'ajax/basket_market.php';
                }
                $APPLICATION->RestartBuffer();
            }
            die();
            break;

        case 'addPopup':

            if(intval($_REQUEST['id']) > 0)
            {
                include_once "include_options.php";
                global $rz_b2_options;

                if (Loader::IncludeModule('yenisite.core')) {
                    $arParams = \Yenisite\Core\Ajax::getParams('bitrix:catalog', false, CRZBitronic2CatalogUtils::getCatalogPathForUpdate());
                }
                if(!is_array($arParams) || empty($arParams)) {
                    die(GetMessage('BITRONIC2_BASKET_SUCCESS'));
                }

                include $_SERVER["DOCUMENT_ROOT"].SITE_TEMPLATE_PATH.'/components/bitrix/catalog/.default/include/prepare_params_element.php'; // @var $arPrepareParams
                $arValuesRequest = $request->toArray();
                $arValuesRequest[$arParams['ACTION_VARIABLE']] = null;
                $request->set($arValuesRequest);

                $arPrepareParams['ELEMENT_ID'] = intval($_REQUEST['id']);
                $arPrepareParams['IBLOCK_ID_CATALOG'] = $arPrepareParams['IBLOCK_ID'];
                $arPrepareParams['SLIDER_TYPE'] = $rz_b2_options['basket_popup_slider'];
                $arPrepareParams['SHOW_STARS'] = $rz_b2_options['block_show_stars'];
                $arPrepareParams['SHOW_ARTICLE'] = $rz_b2_options['block_show_article'];
                $arPrepareParams['HOVER-MODE'] = $rz_b2_options['product-hover-effect'];
                $arPrepareParams['CACHE_TIME'] = '0';
                unset($_GET['action'], $_POST['action'], $_REQUEST['action']);

                $APPLICATION->IncludeComponent("bitrix:catalog.element", "add2basket_popup", $arPrepareParams, false);

            }
            die();
            break;
    }
}
catch (Exception $e) {
    $addResult = array('STATUS' => 'ERROR', 'CODE' => $e->getMessage());
}
$APPLICATION->RestartBuffer();
echo CUtil::PhpToJSObject($addResult);
die();