<?
include_once "include_stop_statistic.php";
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

include_once "include_module.php";
include_once "include_options.php";

if (!\Bitrix\Main\Loader::includeModule('yenisite.feedback')) {
	throw new \RuntimeException('Module yenisite.feedback is not installed');
}

\Yenisite\Core\Tools::encodeAjaxRequest($_REQUEST);
\Yenisite\Core\Tools::encodeAjaxRequest($_POST);

include_once($_SERVER["DOCUMENT_ROOT"] . SITE_TEMPLATE_PATH . "/lang/" . LANGUAGE_ID . "/header.php");

$clarifyRegistrationRequired = false;
$clarifyRegistrationError = '';
$clarifyCaptchaError = '';
$clarifySkipComponentCaptcha = false;
$clarifyUserId = 0;
$clarifyCreatedRequestId = 0;
$clarifyFormData = array();

\Bitrix\Main\EventManager::getInstance()->addEventHandler('iblock', 'OnAfterIBlockElementAdd', function (&$fields) use (&$clarifyCreatedRequestId) {
	if ((int)$fields['IBLOCK_ID'] === 11 && (int)$fields['ID'] > 0) {
		$clarifyCreatedRequestId = (int)$fields['ID'];
	}
});

if (!empty($_POST['romza_feedback'])) {
	$clarifyFormData = $_POST['romza_feedback'];
	$email = trim($clarifyFormData['EMAIL']);
	$existingUser = false;

	if (check_email($email, true)) {
		$existingUser = \Bitrix\Main\UserTable::getList(array(
			'select' => array('ID'),
			'filter' => array('=EMAIL' => $email),
			'limit' => 1,
		))->fetch();
	}
	if ($USER->IsAuthorized()) {
		$clarifyUserId = (int)$USER->GetID();
	} elseif ($existingUser) {
		$clarifyUserId = (int)$existingUser['ID'];
	}

	if (!$existingUser && check_email($email, true)) {
		if ($_POST['register_user'] !== 'Y') {
			$clarifyRegistrationRequired = true;
			unset($_POST['romza_feedback'], $_REQUEST['romza_feedback']);
		} elseif ($_POST['privacy_policy'] === 'Y') {
			if (!CYSFeedBack::checkCAPTCHA($_POST['captcha_word'], $_POST['captcha_code'])) {
				$clarifyCaptchaError = 'Неверно указан код с картинки.';
				unset($_POST['romza_feedback'], $_REQUEST['romza_feedback']);
			} else {
			$password = randString(12);
			$user = new CUser();
			$userId = $user->Add(array(
				'ACTIVE' => 'Y',
				'LOGIN' => $email,
				'EMAIL' => $email,
				'PASSWORD' => $password,
				'CONFIRM_PASSWORD' => $password,
				'PERSONAL_PHONE' => trim($clarifyFormData['PHONE']),
				'GROUP_ID' => array(2),
			));

			if ($userId) {
				$clarifyUserId = (int)$userId;
				$clarifySkipComponentCaptcha = true;
				CUser::SendUserInfo($userId, SITE_ID, 'Ваш временный пароль: ' . $password, true, 'USER_INFO');
			} else {
				$clarifyRegistrationRequired = true;
				$clarifyRegistrationError = $user->LAST_ERROR;
				unset($_POST['romza_feedback'], $_REQUEST['romza_feedback']);
			}
			}
		}
	}

	if ($clarifyUserId > 0 && !empty($_POST['romza_feedback'])) {
		$_POST['romza_feedback']['USER'] = $clarifyUserId;
		$_REQUEST['romza_feedback']['USER'] = $clarifyUserId;
	}
}

include $_SERVER["DOCUMENT_ROOT"] . SITE_DIR . "include_areas/footer/clarify_availability.php";
?>
<script>
$(function() {
	$('#modal_clarify_availability input[name="romza_feedback[PHONE]"]').inputmask('+7 (999) 999-9999');
});
</script>
