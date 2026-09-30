<?php

namespace Sprint\Migration;

class Version20260729140000 extends Version
{
    protected $description = 'Добавляет свойство «Уточнить наличие» для каталога';

    public function up()
    {
        $this->getHelperManager()->Iblock()->addPropertyIfNotExists(30, [
            'NAME' => 'Уточнить наличие',
            'CODE' => 'CLARIFY_AVAILABILITY',
            'PROPERTY_TYPE' => 'L',
            'LIST_TYPE' => 'C',
            'MULTIPLE' => 'N',
            'ACTIVE' => 'Y',
            'SORT' => 10,
            'VALUES' => [[
                'VALUE' => 'Да',
                'XML_ID' => 'Y',
                'SORT' => 10,
                'DEF' => 'N',
            ]],
        ]);
    }

    public function down()
    {
        $this->getHelperManager()->Iblock()->deletePropertyIfExists(30, 'CLARIFY_AVAILABILITY');
    }
}
