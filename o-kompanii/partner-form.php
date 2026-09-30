<?php
require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php');

require_once($_SERVER['DOCUMENT_ROOT'] . '/ajax/include_module.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/ajax/include_options.php');

\Yenisite\Core\Tools::encodeAjaxRequest($_REQUEST);
\Yenisite\Core\Tools::encodeAjaxRequest($_POST);

if (\Bitrix\Main\Loader::includeModule('yenisite.feedback')) {
    global $rz_b2_options;

    $APPLICATION->IncludeComponent(
        'yenisite:feedback.add',
        'partner_request',
        [
            'IBLOCK_TYPE' => 'b2glass_feedback',
            'IBLOCK' => '7',
            'NAME_FIELD' => '',
            'COLOR_SCHEME' => 'green',
            'TITLE' => 'Стать партнером',
            'SUCCESS_TEXT' => 'Спасибо! Ваша заявка принята. Мы свяжемся с вами в ближайшее время.',
            'USE_CAPTCHA' => 'N',
            'USE_GOOGLE_CAPTCHA' => $rz_b2_options['use_google_captcha'] === 'Y' ? $rz_b2_options['captcha-feedback'] : 'N',
            'SHOW_SECTIONS' => 'N',
            'PRINT_FIELDS' => ['PHONE', 'EMAIL'],
            'AJAX_MODE' => 'Y',
            'CACHE_TYPE' => 'N',
            'ACTIVE' => 'Y',
            'EVENT_NAME' => 'FEEDBACK',
            'TEXT_SHOW' => 'Y',
            'TEXT_REQUIRED' => 'Y',
            'PHONE' => 'PHONE',
            'EMAIL' => 'EMAIL',
            'FORM' => 'form_partner_request',
            'COMPONENT_TEMPLATE' => 'partner_request',
            'AJAX_OPTION_JUMP' => 'N',
            'AJAX_OPTION_STYLE' => 'N',
            'AJAX_OPTION_HISTORY' => 'N',
        ],
        false,
        ['HIDE_ICONS' => 'Y']
    );
}
?>
