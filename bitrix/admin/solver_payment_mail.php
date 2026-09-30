<?php

$localHandler = $_SERVER['DOCUMENT_ROOT'] . '/local/admin/solver_payment_mail.php';

if (is_file($localHandler)) {
    require $localHandler;
    return;
}

require $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_admin_before.php';
LocalRedirect('/bitrix/admin/');
