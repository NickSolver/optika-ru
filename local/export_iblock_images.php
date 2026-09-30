<?php

declare(strict_types=1);

use Bitrix\Main\Loader;

define('NO_KEEP_STATISTIC', true);
define('BX_NO_ACCELERATOR_RESET', true);

$documentRoot = rtrim((string) ($_SERVER['DOCUMENT_ROOT'] ?? ''), '/\\');
$prolog = $documentRoot . '/bitrix/modules/main/include/prolog_before.php';

if ($documentRoot === '' || !is_file($prolog)) {
    http_response_code(500);
    exit('Не найдено ядро 1С-Битрикс. Поместите файл в DOCUMENT_ROOT сайта.');
}

require $prolog;

global $APPLICATION, $USER;

if (!is_object($USER) || !$USER->IsAuthorized() || !$USER->IsAdmin()) {
    http_response_code(403);
    exit('Доступ разрешён только авторизованному администратору сайта.');
}

if (!Loader::includeModule('iblock')) {
    http_response_code(500);
    exit('Не удалось подключить модуль iblock.');
}

$iblockId = 30;
$fileName = 'iblock_' . $iblockId . '_images.csv';

$APPLICATION->RestartBuffer();
header('Content-Type: text/csv; charset=UTF-8');
header('Content-Disposition: attachment; filename="' . $fileName . '"');
header('X-Content-Type-Options: nosniff');
header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');

$handle = fopen('php://output', 'wb');
if ($handle === false) {
    http_response_code(500);
    exit('Не удалось сформировать CSV.');
}

// BOM нужен, чтобы Excel в Windows корректно распознавал UTF-8.
fwrite($handle, "\xEF\xBB\xBF");
// Последнее пустое поле сохраняет требуемый завершающий символ «;».
fputcsv($handle, ['id', 'PREVIEW_PICTURE', 'DETAIL_PICTURE', 'MORE_PHOTO', ''], ';', '"', '\\');

$count = 0;
$elements = CIBlockElement::GetList(
    ['ID' => 'ASC'],
    ['IBLOCK_ID' => $iblockId],
    false,
    false,
    ['ID', 'PREVIEW_PICTURE', 'DETAIL_PICTURE']
);

while ($element = $elements->Fetch()) {
    $previewPath = !empty($element['PREVIEW_PICTURE'])
        ? (string) CFile::GetPath((int) $element['PREVIEW_PICTURE'])
        : '';
    $detailPath = !empty($element['DETAIL_PICTURE'])
        ? (string) CFile::GetPath((int) $element['DETAIL_PICTURE'])
        : '';

    $morePhotoPaths = [];
    $morePhotoValues = CIBlockElement::GetProperty(
        $iblockId,
        (int) $element['ID'],
        ['SORT' => 'ASC', 'ID' => 'ASC'],
        ['CODE' => 'MORE_PHOTO']
    );

    while ($property = $morePhotoValues->Fetch()) {
        $fileId = (int) ($property['VALUE'] ?? 0);
        if ($fileId <= 0) {
            continue;
        }

        $path = CFile::GetPath($fileId);
        if (is_string($path) && $path !== '') {
            $morePhotoPaths[] = $path;
        }
    }

    fputcsv(
        $handle,
        [
            (string) $element['ID'],
            $previewPath,
            $detailPath,
            implode(',', array_values(array_unique($morePhotoPaths))),
            '',
        ],
        ';',
        '"',
        '\\'
    );
    $count++;
}

fclose($handle);
exit;
