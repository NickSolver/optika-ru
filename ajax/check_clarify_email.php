<?
define('PUBLIC_AJAX_MODE', true);
define('NO_KEEP_STATISTIC', true);
define('NO_AGENT_STATISTIC', true);
define('DisableEventsCheck', true);

require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php');

header('Content-Type: application/json; charset=UTF-8');
$email = trim($_GET['email']);
$exists = false;

if (check_email($email, true)) {
	$exists = (bool)\Bitrix\Main\UserTable::getList(array(
		'select' => array('ID'),
		'filter' => array('=EMAIL' => $email),
		'limit' => 1,
	))->fetch();
}

echo \Bitrix\Main\Web\Json::encode(array('exists' => $exists));
