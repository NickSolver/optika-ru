<?php

namespace Sprint\Migration;

use Bitrix\Main\Application;
use Bitrix\Main\Loader;

class Version20260731120000 extends Version
{
    protected $description = 'Добавляет пропорциональный ресайзер 650 px для разводящих каталога';

    public function up()
    {
        Application::getConnection()->queryExecute("
            INSERT INTO yen_resizer2_sets (id, NAME, w, h, q, wm, priority, conv)
            VALUES (1001, 'Разводящая каталога 650px', 650, 650, 100, 'N', 'FIT_LARGE', '')
            ON DUPLICATE KEY UPDATE
                NAME = VALUES(NAME),
                w = VALUES(w),
                h = VALUES(h),
                q = VALUES(q),
                wm = VALUES(wm),
                priority = VALUES(priority),
                conv = VALUES(conv)
        ");

        if (Loader::includeModule('yenisite.resizer2')) {
            \CResizer2Resize::ClearCacheByID(1001);
        }
    }

    public function down()
    {
        Application::getConnection()->queryExecute("
            DELETE FROM yen_resizer2_sets
            WHERE id = 1001 AND NAME = 'Разводящая каталога 650px'
        ");

        if (Loader::includeModule('yenisite.resizer2')) {
            \CResizer2Resize::ClearCacheByID(1001);
        }
    }
}
