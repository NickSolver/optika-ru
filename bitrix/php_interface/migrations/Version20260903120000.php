<?php

namespace Sprint\Migration;

class Version20260903120000 extends Version
{
    private const TYPE_ID = 'contacts';
    private const IBLOCK_CODE = 'partners_in_contacts';
    private const ACHIEVEMENTS_IBLOCK_CODE = 'achievements_in_contacts';
    private const ASSETS_DIR = __DIR__ . '/images/Version20260903120000';
    private const LEGACY_ASSETS_DIR = __DIR__ . '/images/Version20260828120000';

    protected $description = 'Добавляет партнёров TOPGUN, Аквафор и «Карту москвича»';

    public function up()
    {
        $iblockHelper = $this->getHelperManager()->Iblock();
        $iblockHelper->addIblockTypeIfNotExists([
            'ID' => self::TYPE_ID,
            'SECTIONS' => 'N',
            'IN_RSS' => 'N',
            'SORT' => 500,
            'LANG' => [
                'ru' => [
                    'NAME' => 'Контакты',
                    'SECTION_NAME' => 'Разделы',
                    'ELEMENT_NAME' => 'Элементы',
                ],
            ],
        ]);
        $iblockId = $iblockHelper->addIblockIfNotExists([
            'ACTIVE' => 'Y',
            'NAME' => 'Партнеры в контактах',
            'CODE' => self::IBLOCK_CODE,
            'IBLOCK_TYPE_ID' => self::TYPE_ID,
            'LID' => ['s1'],
            'SORT' => 500,
            'GROUP_ID' => ['2' => 'R'],
            'VERSION' => 2,
            'INDEX_ELEMENT' => 'N',
            'INDEX_SECTION' => 'N',
        ]);

        foreach ([
            ['NAME' => 'Ссылка', 'CODE' => 'LINK', 'SORT' => 100],
            ['NAME' => 'Бейдж скидки', 'CODE' => 'DISCOUNT', 'SORT' => 110],
        ] as $property) {
            $iblockHelper->addPropertyIfNotExists($iblockId, [
                'NAME' => $property['NAME'],
                'CODE' => $property['CODE'],
                'PROPERTY_TYPE' => 'S',
                'MULTIPLE' => 'N',
                'ACTIVE' => 'Y',
                'SORT' => $property['SORT'],
            ]);
        }

        $achievementsIblockId = $iblockHelper->addIblockIfNotExists([
            'ACTIVE' => 'Y',
            'NAME' => 'Достижения в контактах',
            'CODE' => self::ACHIEVEMENTS_IBLOCK_CODE,
            'IBLOCK_TYPE_ID' => self::TYPE_ID,
            'LID' => ['s1'],
            'SORT' => 500,
            'GROUP_ID' => ['2' => 'R'],
            'VERSION' => 2,
            'INDEX_ELEMENT' => 'N',
            'INDEX_SECTION' => 'N',
        ]);
        $iblockHelper->addPropertyIfNotExists($achievementsIblockId, [
            'NAME' => 'Ссылка',
            'CODE' => 'LINK',
            'PROPERTY_TYPE' => 'S',
            'MULTIPLE' => 'N',
            'ACTIVE' => 'Y',
            'SORT' => 100,
        ]);
        $this->addElementWithImage($iblockHelper, $achievementsIblockId, [
            'NAME' => 'Грамота / диплом',
            'CODE' => 'demo-achievement',
            'ACTIVE' => 'Y',
            'SORT' => 100,
        ], 'demo-achievement.png', [], self::LEGACY_ASSETS_DIR);

        $this->addElementWithImage($iblockHelper, $iblockId, [
            'NAME' => 'Корчма Диканька',
            'CODE' => 'korchma-dikanka',
            'ACTIVE' => 'Y',
            'SORT' => 100,
            'PREVIEW_TEXT_TYPE' => 'html',
            'PREVIEW_TEXT' => 'Скидки барышням и сударям в корчме "Диканька". -15% по кодовому слову "Lokamed". Скидка не распространяется на банкеты и не суммируется с другими акциями.',
        ], 'korchma-dikanka.jpg', [
            'LINK' => 'https://korchmadikanka.ru/',
            'DISCOUNT' => 'Скидка -15%',
        ], self::LEGACY_ASSETS_DIR);

        $this->addElementWithImage($iblockHelper, $iblockId, [
            'NAME' => 'TOPGUN',
            'CODE' => 'topgun-zelenograd',
            'ACTIVE' => 'Y',
            'SORT' => 200,
            'PREVIEW_TEXT_TYPE' => 'html',
            'PREVIEW_TEXT' => 'Для всех клиентов Lokamed действует скидка 500 руб. в TOPGUN | Зеленоград при предъявлении купона (выдаётся в Lokamed).<br><br><strong>Адреса салонов TOPGUN:</strong><br>Зеленоград, пл. Юности, 2, стр. 1<br>Зеленоград, ул. Каменка, 1805',
        ], 'topgun.png', [
            'LINK' => 'https://vk.ru/club82054222',
            'DISCOUNT' => 'Скидка -500 ₽',
        ]);

        $this->addElementWithImage($iblockHelper, $iblockId, [
            'NAME' => 'Аквафор',
            'CODE' => 'aquaphor-zelenograd',
            'ACTIVE' => 'Y',
            'SORT' => 300,
            'PREVIEW_TEXT_TYPE' => 'html',
            'PREVIEW_TEXT' => 'Для всех клиентов Lokamed действует скидка 10% на продукцию Аквафор в Зеленограде (ул. Андреевка 31 А, Дом мебели «Андреевский» (остановка к.1602)) при предъявлении купона (выдаётся в Lokamed).',
        ], 'aquaphor.png', [
            'LINK' => 'https://aquaphor.ru/',
            'DISCOUNT' => 'Скидка -10%',
        ]);

        $this->addElementWithImage($iblockHelper, $iblockId, [
            'NAME' => 'Карта москвича',
            'CODE' => 'moscow-card',
            'ACTIVE' => 'Y',
            'SORT' => 400,
            'PREVIEW_TEXT_TYPE' => 'html',
            'PREVIEW_TEXT' => 'Для всех держателей карты москвича в Lokamed действует скидка 10% на весь ассортимент за исключением контактных линз.',
        ], 'moscow-card.png', [
            'LINK' => 'https://www.mos.ru/karta-moskvicha/',
            'DISCOUNT' => 'Скидка -10%',
        ]);
    }

    public function down()
    {
        $iblockHelper = $this->getHelperManager()->Iblock();
        $iblockId = $iblockHelper->getIblockId(self::IBLOCK_CODE, self::TYPE_ID);

        if ($iblockId <= 0) {
            return;
        }

        foreach (['moscow-card', 'aquaphor-zelenograd', 'topgun-zelenograd', 'korchma-dikanka'] as $code) {
            $iblockHelper->deleteElementIfExists($iblockId, $code);
        }
    }

    private function addElementWithImage(
        $iblockHelper,
        int $iblockId,
        array $fields,
        string $image,
        array $properties,
        ?string $assetsDir = null
    ): void
    {
        $imagePath = ($assetsDir ?? self::ASSETS_DIR) . '/' . $image;
        if (is_file($imagePath)) {
            $fields['PREVIEW_PICTURE'] = \CFile::MakeFileArray($imagePath);
        }

        $iblockHelper->addElementIfNotExists($iblockId, $fields, $properties);
    }
}
