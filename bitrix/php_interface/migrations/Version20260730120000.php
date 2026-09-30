<?php

namespace Sprint\Migration;

class Version20260730120000 extends Version
{
    protected $description = 'Добавляет пользователя в заявки на товар и ссылку на заявку в письмо';

    private const MESSAGE_APPEND = "\n\nЗаявка в административной части: <a href=\"#REQUEST_URL_ADMIN#\">#REQUEST_ID#</a>.";

    public function up()
    {
        $this->getHelperManager()->Iblock()->addPropertyIfNotExists(11, [
            'NAME' => 'Пользователь',
            'CODE' => 'USER',
            'PROPERTY_TYPE' => 'S',
            'USER_TYPE' => 'UserID',
            'MULTIPLE' => 'N',
            'ACTIVE' => 'Y',
            'SORT' => 70,
        ]);

        $this->updateMessages(true);
    }

    public function down()
    {
        $this->getHelperManager()->Iblock()->deletePropertyIfExists(11, 'USER');
        $this->updateMessages(false);
    }

    private function updateMessages($add)
    {
        $eventMessage = new \CEventMessage();
        $by = 'id';
        $order = 'asc';
        $messages = \CEventMessage::GetList($by, $order, ['TYPE_ID' => 'ELEMENT_CONTACT']);
        while ($message = $messages->Fetch()) {
            $body = $message['MESSAGE'];
            if ($add && strpos($body, '#REQUEST_URL_ADMIN#') === false) {
                $body .= self::MESSAGE_APPEND;
            } elseif (!$add) {
                $body = str_replace(self::MESSAGE_APPEND, '', $body);
            }
            $eventMessage->Update($message['ID'], ['MESSAGE' => $body]);
        }
    }
}
