<?php

namespace Sprint\Migration;

class Version20260828120000 extends Version
{
    private const TYPE_ID = 'contacts';
    private const ASSETS_DIR = __DIR__ . '/images/Version20260828120000';

    private const IBLOCKS = [
        'gallery_salons' => 'Галерея салонов',
        'partners_in_contacts' => 'Партнеры в контактах',
        'achievements_in_contacts' => 'Достижения в контактах',
    ];

    private const GALLERY_ITEMS = [
        ['CODE' => 'salon-gallery-1', 'NAME' => 'Торговый зал салона оптики Lokamed', 'IMAGE' => 'gallery-1.jpg'],
        ['CODE' => 'salon-gallery-2', 'NAME' => 'Витрины с оправами в салоне Lokamed', 'IMAGE' => 'gallery-2.jpg'],
        ['CODE' => 'salon-gallery-3', 'NAME' => 'Зона подбора очков в салоне Lokamed', 'IMAGE' => 'gallery-3.jpg'],
        ['CODE' => 'salon-gallery-4', 'NAME' => 'Интерьер салона оптики Lokamed', 'IMAGE' => 'gallery-4.jpg'],
        ['CODE' => 'salon-gallery-5', 'NAME' => 'Коллекция оправ в салоне Lokamed', 'IMAGE' => 'gallery-5.jpg'],
        ['CODE' => 'salon-gallery-6', 'NAME' => 'Рабочая зона специалистов Lokamed', 'IMAGE' => 'gallery-6.jpg'],
        ['CODE' => 'salon-gallery-7', 'NAME' => 'Специалист помогает подобрать оправу', 'IMAGE' => 'gallery-7.jpg'],
    ];

    protected $description = 'Создает инфоблоки для слайдеров страницы «О компании»';

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

        foreach (self::IBLOCKS as $code => $name) {
            $iblockId = $iblockHelper->addIblockIfNotExists([
                'ACTIVE' => 'Y',
                'NAME' => $name,
                'CODE' => $code,
                'IBLOCK_TYPE_ID' => self::TYPE_ID,
                'LID' => ['s1'],
                'SORT' => 500,
                'GROUP_ID' => ['2' => 'R'],
                'VERSION' => 2,
                'INDEX_ELEMENT' => 'N',
                'INDEX_SECTION' => 'N',
            ]);

            $iblockHelper->addPropertyIfNotExists($iblockId, [
                'NAME' => 'Ссылка',
                'CODE' => 'LINK',
                'PROPERTY_TYPE' => 'S',
                'MULTIPLE' => 'N',
                'ACTIVE' => 'Y',
                'SORT' => 100,
            ]);
        }

        $galleryIblockId = $iblockHelper->getIblockIdIfExists('gallery_salons', self::TYPE_ID);
        foreach (self::GALLERY_ITEMS as $sort => $item) {
            $this->addElementWithImage($iblockHelper, $galleryIblockId, [
                'NAME' => $item['NAME'],
                'CODE' => $item['CODE'],
                'ACTIVE' => 'Y',
                'SORT' => ($sort + 1) * 100,
            ], $item['IMAGE']);
        }

        $partnersIblockId = $iblockHelper->getIblockIdIfExists('partners_in_contacts', self::TYPE_ID);
        $iblockHelper->addPropertyIfNotExists($partnersIblockId, [
            'NAME' => 'Бейдж скидки',
            'CODE' => 'DISCOUNT',
            'PROPERTY_TYPE' => 'S',
            'MULTIPLE' => 'N',
            'ACTIVE' => 'Y',
            'SORT' => 110,
        ]);
        $this->addElementWithImage($iblockHelper, $partnersIblockId, [
            'NAME' => 'Корчма Диканька',
            'CODE' => 'korchma-dikanka',
            'ACTIVE' => 'Y',
            'SORT' => 100,
            'PREVIEW_TEXT' => 'Скидки барышням и сударям в корчме "Диканька". -15% по кодовому слову "Lokamed". Скидка не распространяется на банкеты и не суммируется с другими акциями.',
        ], 'korchma-dikanka.jpg', [
            'LINK' => 'https://eda.yandex.ru/r/korchma_dikanka?placeSlug=korchma_dikanki',
            'DISCOUNT' => 'Скидка 15%',
        ]);

        $achievementsIblockId = $iblockHelper->getIblockIdIfExists(
            'achievements_in_contacts',
            self::TYPE_ID
        );
        $this->addElementWithImage($iblockHelper, $achievementsIblockId, [
            'NAME' => 'Грамота / диплом',
            'CODE' => 'demo-achievement',
            'ACTIVE' => 'Y',
            'SORT' => 100,
        ], 'demo-achievement.png');
    }

    public function down()
    {
        $iblockHelper = $this->getHelperManager()->Iblock();
        $achievementsIblockId = $iblockHelper->getIblockId(
            'achievements_in_contacts',
            self::TYPE_ID
        );

        if ($achievementsIblockId > 0) {
            $iblockHelper->deleteElementIfExists($achievementsIblockId, 'demo-achievement');
        }

        foreach (array_reverse(array_keys(self::IBLOCKS)) as $code) {
            $iblockHelper->deleteIblockIfExists($code, self::TYPE_ID);
        }

        $iblockHelper->deleteIblockTypeIfExists(self::TYPE_ID);
    }

    private function addElementWithImage($iblockHelper, int $iblockId, array $fields, string $image, array $properties = []): void
    {
        $imagePath = self::ASSETS_DIR . '/' . $image;
        if (is_file($imagePath)) {
            $fields['PREVIEW_PICTURE'] = \CFile::MakeFileArray($imagePath);
        }

        $iblockHelper->addElementIfNotExists($iblockId, $fields, $properties);
    }
}
