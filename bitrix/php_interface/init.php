<?php

use \Bitrix\Main\Loader;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require $_SERVER['DOCUMENT_ROOT'] . '/local/lib/vendor/autoload.php';

if (file_exists(__DIR__ . "/include/constants.php")) {
    include_once __DIR__ . "/include/constants.php";
}
if (file_exists(__DIR__ . "/include/debug.php")) {
    include_once __DIR__ . "/include/debug.php";
}
if (file_exists(__DIR__ . "/include/handlers.php")) {
    include_once __DIR__ . "/include/handlers.php";
}
if (file_exists(__DIR__.'/BuildSotbitLinkByProps.php')) {
    include_once(__DIR__.'/BuildSotbitLinkByProps.php');
}
if (file_exists(__DIR__.'/PagenMeta.php')) {
    include_once(__DIR__.'/PagenMeta.php');
}

$GLOBALS["SSM_OPT"] = [
    'setPagenCanonical' => 'Y',
    'title_str' => ' - страница ',
    'descr_str' => '. Страница '
];
(new \SolverWeb\Seo\PagenMeta())->init();


if (file_exists($_SERVER["DOCUMENT_ROOT"] . "/seomod/include.php")) @require($_SERVER["DOCUMENT_ROOT"] . "/seomod/include.php");

AddEventHandler("sale", "OnOrderNewSendEmail", "ModifySaleMails");
AddEventHandler('main', 'OnAdminContextMenuShow', 'AddOrderMailAdminButton');

function AddOrderMailAdminButton(&$items, &$additionalItems)
{
    global $APPLICATION;

    if ($APPLICATION->GetCurPage() !== '/bitrix/admin/sale_order_view.php') {
        return;
    }

    $orderId = (int)($_GET['ID'] ?? 0);
    if ($orderId <= 0) {
        return;
    }

    $mailUrl = '/bitrix/admin/solver_payment_mail.php?' . http_build_query([
        'lang' => LANGUAGE_ID,
        'order_id' => $orderId,
        'sessid' => bitrix_sessid(),
    ]);
    $button = [
        'TEXT' => 'Письмо на заказ',
        'TITLE' => 'Отправить покупателю письмо со ссылкой на заказ',
        'LINK' => 'javascript:void(0)',
        'ONCLICK' => "if(confirm('Отправить покупателю письмо на заказ?')) window.location.href='" . CUtil::JSEscape($mailUrl) . "'",
    ];

    foreach ($items as $index => $item) {
        if (($item['TEXT'] ?? '') === 'Удалить') {
            array_splice($items, $index + 1, 0, [$button]);
            return;
        }
    }

    $items[] = $button;
}

function ModifySaleMails($orderID, &$eventName, &$arFields)
{
    $arOrder = CSaleOrder::GetByID($orderID);

    $order_props = CSaleOrderPropsValue::GetOrderProps($orderID);

    $phone = "";
    $address = "";

    while ($arProps = $order_props->Fetch()) {
        if ($arProps["CODE"] == "PHONE") {
            $phone = htmlspecialchars($arProps["VALUE"]);
        }

        if ($arProps["CODE"] == "ADDRESS") {
            $address = htmlspecialchars($arProps["VALUE"]);
        }
    }

    if (!empty($arOrder["USER_DESCRIPTION"])) {
        $arFields["DESCRIPTION"] = $arOrder["USER_DESCRIPTION"];
    }

    //-- добавляем новые поля в массив результатов
    $arFields["PHONE"] = $phone;
    $arFields["ADDRESS"] = $address;

    if ($_POST["ORDER_DESCRIPTION"]) {
        $arFields["ORDER_DESCRIPTION"] = $_POST["ORDER_DESCRIPTION"];
    }
}

function lastModIfSince($timestamp)
{
    $LastModified_unix = strtotime($timestamp); // время последнего изменения страницы

    $LastModified = gmdate("D, d M Y H:i:s \G\M\T", $LastModified_unix);

    $IfModifiedSince = false;
    if (isset($_ENV['HTTP_IF_MODIFIED_SINCE']))
        $IfModifiedSince = strtotime(substr($_ENV['HTTP_IF_MODIFIED_SINCE'], 5));
    if (isset($_SERVER['HTTP_IF_MODIFIED_SINCE']))
        $IfModifiedSince = strtotime(substr($_SERVER['HTTP_IF_MODIFIED_SINCE'], 5));
    if ($IfModifiedSince && $IfModifiedSince >= $LastModified_unix) {
        header($_SERVER['SERVER_PROTOCOL'] . ' 304 Not Modified');
        exit;
    }

    header('Last-Modified: ' . $LastModified);
}

$arLastModStaticPages = [
    '/',
    '/kontaktyi/',
    '/o-kompanii/',
    '/dostavka/',
    '/personal/',
    '/nashi-uslugi/',
    '/nashi-uslugi/izgotovlenie-ochkov-na-zakaz/',
    '/nashi-uslugi/podbor-oprav-i-linz/',
    '/nashi-uslugi/zamena-linzy/',
    '/aktsii/',
    '/tree/',
    '/site-map/',
];
$arLastModStaticPagesStrange = [
    '/personal/rules/personal_data.php'
];

global $APPLICATION;
$pageUrl = $APPLICATION->GetCurPage(false);

if (in_array($pageUrl, $arLastModStaticPages)) {
    $fileStamp = date("Y-m-d H:i:s", filectime($_SERVER['DOCUMENT_ROOT'] . $pageUrl . 'index.php'));
    lastModIfSince($fileStamp);
}

if (in_array($pageUrl, $arLastModStaticPagesStrange)) {
    $fileStamp = date("Y-m-d H:i:s", filectime($_SERVER['DOCUMENT_ROOT']));
    lastModIfSince($fileStamp);
}

if (!function_exists('BITGetDeclNum')) {
    /**
     * Функция возвращает окончание слова, в зависимости от примененного к ней числа
     * Например: 5 товаров, 1 товар, 3 товара
     *
     * @param int $value - число, к которому необходимо применить склонение
     * @param array $status - массив возможных окончаний
     * @return mixed
     */
    function BITGetDeclNum($value = 1, $status = array('', 'а', 'ов'))
    {
        $array = array(2, 0, 1, 1, 1, 2);
        return $status[($value % 100 > 4 && $value % 100 < 20) ? 2 : $array[($value % 10 < 5) ? $value % 10 : 5]];
    }
}

if (!strstr($_SERVER['REQUEST_URI'], '/bitrix/admin/')) {
    AddEventHandler('main', 'OnEpilog', 'CahngeMeta');
    function CahngeMeta()
    {

        $title = $GLOBALS['APPLICATION']->GetPageProperty('title');
        $desk = $GLOBALS['APPLICATION']->GetPageProperty('description');

        if (!$title)
            $title = $GLOBALS['APPLICATION']->GetTitle();

        $GLOBALS['APPLICATION']->SetPageProperty("title", '&#9658; ' . $title);

        if ($desk)
            $GLOBALS['APPLICATION']->SetPageProperty("description", '&#10004; ' . $desk);
    }
}

$em = \Bitrix\Main\EventManager::getInstance();
$em->addEventHandler('main', 'OnPageStart', ['SotbitModifiers', 'sotbitRedirect']);
$em->addEventHandler('main', 'OnEndBufferContent', ['SotbitModifiers', 'sotbitLinkModyfy']);
$em->addEventHandler('main', 'OnEndBufferContent', ['SotbitModifiers', 'subdirHrefModify']);

class SotbitModifiers
{
    public static function checkSotbitCond()
    {
        if (!Loader::includeModule('sotbit.seometa')) return false;

        global $APPLICATION;

        if ($arResUrl = \Sotbit\Seometa\Orm\SeometaUrlTable::getList([
            'select' => [
                'REAL_URL',
                'NEW_URL'
            ],
            'filter' => [
                'ACTIVE' => 'Y',
                '=REAL_URL' => $APPLICATION->GetCurPage()
            ],
            'order' => ['ID' => 'ASC']
        ])->Fetch())
            return $arResUrl;
    }

    public static function sotbitRedirect()
    {
        $uri = explode('?', $_SERVER['REQUEST_URI']);
        $arResUrl = self::checkSotbitCond();
        if ($arResUrl['NEW_URL'])
            LocalRedirect($arResUrl['NEW_URL'] . ($uri[1] ?: ''), false, '301 Moved Permanently');
    }

    public static function sotbitLinkModyfy(&$content)
    {
        if (!Loader::includeModule('sotbit.seometa')) return false;

        global $APPLICATION;

        $rsDataUrl = \Sotbit\Seometa\Orm\SeometaUrlTable::getList(array(
            'select' => [
                'REAL_URL',
                'NEW_URL'
            ],
            'filter' => [
                'ACTIVE' => 'Y',
                '=NEW_URL' => $APPLICATION->GetCurPage(false)
            ],
            'order' => ['ID' => 'ASC']
        ));
        while ($arResUrl = $rsDataUrl->Fetch()) {
            $content = str_replace($arResUrl['REAL_URL'], $arResUrl['NEW_URL'], $content);
        }
    }

    public static function subdirHrefModify(&$content)
    {

        return false;
    }
}
