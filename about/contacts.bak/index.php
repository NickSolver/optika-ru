<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Контакты");
?>
    <main class="container about-page">
        <div class="row">
            <div class="col-xs-12">
                <h1><?$APPLICATION->ShowTitle()?></h1>
				<div>
					<p>Салоны оптики в Москве и Московской области</p>
					<div><b>Телефон</b></div>

					<div><p>Ежедневно с 10 до 21</p></div>
					<div><p>8(800) 600 57 03 Бесплатные звонки по РФ</p></div>
					<div><p>8(926) 277 28 08</p></div>
					<div><b>Наши адреса:</b></div>
				</div>

                <div>
                    <?$APPLICATION->IncludeComponent(
                        "bitrix:map.google.view",
                        "",
                        Array(
                            "OPTIONS" => array(
                                // 0 => "ENABLE_SCROLL_ZOOM",
                                1 => "ENABLE_DBLCLICK_ZOOM",
                                // 2 => "ENABLE_DRAGGING",
                            ),
                            "MAP_WIDTH" => 'AUTO',
                        )
                    );?>
                </div>
                <div>
                    <?$APPLICATION->IncludeComponent(
                        "bitrix:map.yandex.view",
                        "",
                        Array(
                            "OPTIONS" => array(
                                // 0 => "ENABLE_SCROLL_ZOOM",
                                1 => "ENABLE_DBLCLICK_ZOOM",
                                // 2 => "ENABLE_DRAGGING",
                            ),
                            "MAP_WIDTH" => 'AUTO',
                        ),
                        false
                    );?>
                </div>
                <?if (CModule::IncludeModule('simai.maps2gis')): ?>
                    <div>
                        <?$APPLICATION->IncludeComponent(
                            "simai:maps.2gis.simple",
                            "",
                            Array(
                                "MAP_WIDTH" => 'AUTO',
                            )
                        );?>
                    </div>
                <?endif?>
            </div>
        </div>
    </main>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php")?>