<?php

use Bitrix\Main\Config\Option;
use Bitrix\Main\Loader;
use Bitrix\Sale\Order;

require_once $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_admin_before.php';

global $APPLICATION;

if (!Loader::includeModule('sale') || $APPLICATION->GetGroupRight('sale') === 'D') {
    $APPLICATION->AuthForm(GetMessage('ACCESS_DENIED'));
}

if (!check_bitrix_sessid()) {
    require $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_admin_after.php';
    CAdminMessage::ShowMessage('Сессия истекла. Обновите страницу заказа и повторите отправку.');
    require $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/epilog_admin.php';
    return;
}

$orderId = (int)($_GET['order_id'] ?? 0);
$order = $orderId > 0 ? Order::load($orderId) : null;

if (!$order) {
    require $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_admin_after.php';
    CAdminMessage::ShowMessage('Заказ не найден.');
    require $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/epilog_admin.php';
    return;
}

$email = '';
$customerName = '';
foreach ($order->getPropertyCollection() as $property) {
    $code = (string)$property->getField('CODE');
    if ($code === 'EMAIL') {
        $email = trim((string)$property->getValue());
    } elseif (in_array($code, ['FIO', 'NAME'], true) && $customerName === '') {
        $customerName = trim((string)$property->getValue());
    }
}

if (!check_email($email)) {
    $user = CUser::GetByID((int)$order->getUserId())->Fetch();
    $email = trim((string)($user['EMAIL'] ?? ''));
    $customerName = $customerName ?: trim((string)($user['NAME'] ?? ''));
}

if (!check_email($email)) {
    require $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_admin_after.php';
    CAdminMessage::ShowMessage('У покупателя не указан корректный email.');
    require $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/epilog_admin.php';
    return;
}

$siteId = (string)$order->getSiteId();
$site = CSite::GetByID($siteId)->Fetch();
$serverName = (string)($site['SERVER_NAME'] ?: Option::get('main', 'server_name'));
$scheme = Option::get('main', 'mail_link_protocol', 'https') ?: 'https';
$orderUrl = $scheme . '://' . $serverName . '/personal/order/detail/' . $order->getId() . '/';
$eventName = 'SALE_ORDER_LINK';
$eventMessageId = ensureOrderMailEvent($eventName, $siteId);
$eventId = $eventMessageId > 0
    ? CEvent::Send($eventName, $siteId, [
        'EMAIL_TO' => $email,
        'CUSTOMER_NAME' => htmlspecialcharsbx($customerName ?: 'Покупатель'),
        'ORDER_NUMBER' => htmlspecialcharsbx((string)$order->getField('ACCOUNT_NUMBER')),
        'ORDER_URL' => htmlspecialcharsbx($orderUrl),
    ], 'Y', $eventMessageId)
    : false;

require $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_admin_after.php';
if ($eventId) {
    CAdminMessage::ShowNote('Письмо на заказ поставлено в очередь для ' . htmlspecialcharsbx($email) . '.');
} else {
    CAdminMessage::ShowMessage('Не удалось создать почтовое событие. Проверьте настройки почты.');
}
?>
<p><a class="adm-btn" href="<?=htmlspecialcharsbx('/bitrix/admin/sale_order_view.php?ID=' . $orderId . '&lang=' . LANGUAGE_ID)?>">Вернуться к заказу</a></p>
<?php
require $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/epilog_admin.php';

function ensureOrderMailEvent($eventName, $siteId)
{
    $eventType = CEventType::GetList(['EVENT_NAME' => $eventName, 'LID' => LANGUAGE_ID])->Fetch();
    if (!$eventType) {
        (new CEventType())->Add([
            'LID' => LANGUAGE_ID,
            'EVENT_NAME' => $eventName,
            'NAME' => 'Ссылка на заказ',
            'DESCRIPTION' => "#EMAIL_TO# - email покупателя\n#CUSTOMER_NAME# - имя покупателя\n#ORDER_NUMBER# - номер заказа\n#ORDER_URL# - ссылка на заказ",
        ]);
    }

    $by = 'id';
    $order = 'asc';
    $messages = CEventMessage::GetList($by, $order, [
        'TYPE_ID' => $eventName,
        'SITE_ID' => $siteId,
        'ACTIVE' => 'Y',
    ]);
    if ($message = $messages->Fetch()) {
        return (int)$message['ID'];
    }

    return (int)(new CEventMessage())->Add([
        'ACTIVE' => 'Y',
        'EVENT_NAME' => $eventName,
        'LID' => [$siteId],
        'EMAIL_FROM' => '#DEFAULT_EMAIL_FROM#',
        'EMAIL_TO' => '#EMAIL_TO#',
        'SUBJECT' => 'Информация о заказе №#ORDER_NUMBER#',
        'MESSAGE' => '<p>Здравствуйте, #CUSTOMER_NAME#!</p>'
            . '<p>Для просмотра заказа №#ORDER_NUMBER# перейдите по ссылке:</p>'
            . '<p><a href="#ORDER_URL#">Перейти к заказу</a></p>',
        'BODY_TYPE' => 'html',
    ]);
}
