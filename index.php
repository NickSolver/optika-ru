<?

use Yenisite\Core\Tools;

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "✔ В сети салонов оптики Lokamed в Зеленограде и области можно осуществить бесплатную проверку зрения, а также выбрать и купить очки популярных брендов по доступным ценам. ☎️ 8-800-600-5703, 8-926-277-2808.");

$APPLICATION->SetPageProperty("NOT_SHOW_NAV_CHAIN", "Y");
$APPLICATION->SetTitle("Стильная оптика и модные очки в сети салонов Lokamed");

$APPLICATION->SetPageProperty("title", "Сеть салонов оптики Lokamed в Зеленограде: проверка зрения – цены на очки и оправы в наличии и на заказ любой сложности");

global $rz_b2_options;
?>
    <main class="home-page" data-page="home-page">
        <h1 class="home-page-h1"><? $APPLICATION->ShowTitle(false) ?></h1>
        <?php
        $rz_b2_options['block_home-main-slider'] = 'Y';
        if ($rz_b2_options['block_home-main-slider'] == 'Y' || $rz_b2_options["menu-catalog"] == "side") {
            $APPLICATION->IncludeComponent("bitrix:main.include", "wrap_big_slider", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR . "include_areas/index/big-slider.php", "EDIT_TEMPLATE" => "include_areas_template.php"), false, array("HIDE_ICONS" => "Y"));
        }
        ?>
        <div class="main_utp">
            <div class="container">
                <div class="slider-wrapper">
                    <div class="main_utp_list slick-slider">
                        <div class="main_utp_list_item">
                            <div class="main_utp_list_item_img">
                                <img src="/images/main_1.png" alt=""/>
                            </div>
                            <div class="main_utp_list_item_desk">
                                На рынке с 2005 года – оптика, проверенная временем
                            </div>
                        </div>
                        <div class="main_utp_list_item">
                            <a href="/nashi-uslugi/podbor-oprav-i-linz/">
                            <div class="main_utp_list_item_img">
                                <img src="/images/main_2.png" alt=""/>
                            </div>
                            <div class="main_utp_list_item_desk">
                                Бесплатная проверка зрения для покупателей (18+)
                            </div>
                            </a>
                        </div>
                        <div class="main_utp_list_item">
                            <div class="main_utp_list_item_img">
                                <img src="/images/main_3.png" alt=""/>
                            </div>
                            <div class="main_utp_list_item_desk">
                                6 месяцев гарантии на корригирующие очки
                            </div>
                        </div>
                        <div class="main_utp_list_item">
                            <div class="main_utp_list_item_img">
                                <img src="/images/main_4.png" alt=""/>
                            </div>
                            <div class="main_utp_list_item_desk">
                                Только оригинальная продукция, наличие всех сертификатов
                            </div>
                        </div>
                        <div class="main_utp_list_item">
                            <div class="main_utp_list_item_img">
                                <img src="/images/main_5.png" alt=""/>
                            </div>
                            <div class="main_utp_list_item_desk">
                                50 000+ довольных клиентов
                            </div>
                        </div>
                        <div class="main_utp_list_item">
                            <div class="main_utp_list_item_img">
                                <img src="/images/main_6.png" alt=""/>
                            </div>
                            <div class="main_utp_list_item_desk">
                                7 удобно расположенных оптик в Москве и области
                            </div>
                        </div>
                        <div class="main_utp_list_item">
                            <div class="main_utp_list_item_img">
                                <img src="/images/main_7.png" alt=""/>
                            </div>
                            <div class="main_utp_list_item_desk">
                                Бесплатная доставка при заказе от 5000 рублей
                            </div>
                        </div>
                        <div class="main_utp_list_item">
                            <div class="main_utp_list_item_img">
                                <img src="/images/main_8.png" alt=""/>
                            </div>
                            <div class="main_utp_list_item_desk">
                                Бесплатная примерка очков при заказе онлайн
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container mobile-banner">
            <a href="https://zprozrenie.ru/" target="_blank">
                <picture>
                    <source media="(max-width: 600px)" srcset="/upload/моб.jpg">
                    <img
                            src="/upload/прозрение.jpg"
                            alt="LOKAMED рекомендует клинику Прозрение"
                    >
                </picture>
            </a>
        </div>
        <?
        if ($rz_b2_options['block_home-catchbuy'] == 'Y') {
            //$APPLICATION->IncludeComponent("bitrix:main.include", "", Array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR . "include_areas/index/catchbuy.php", "EDIT_TEMPLATE" => "include_areas_template.php"), false, array("HIDE_ICONS" => "Y"));
        }
        Tools::IncludeArea('index', 'banner_first', false, true, $rz_b2_options['block_show_ad_banners']);
        if ($rz_b2_options['block_home-cool-slider'] == 'Y') {
            $APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR . "include_areas/index/cool-slider.php", "EDIT_TEMPLATE" => "include_areas_template.php"), false, array("HIDE_ICONS" => "Y"));
        }
        Tools::IncludeArea('index', 'banner_second', false, true, $rz_b2_options['block_show_ad_banners']);

        $APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR . "include_areas/index/categories.php", "EDIT_TEMPLATE" => "include_areas_template.php"), false, array("HIDE_ICONS" => "Y"));

        if ($rz_b2_options['block_home-specials'] == 'Y') {
            $APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR . "include_areas/index/main_spec.php", "EDIT_TEMPLATE" => "include_areas_template.php"), false, array("HIDE_ICONS" => "Y"));
        }
        ?>

        <? if ($rz_b2_options['block_home-our-adv'] == 'Y' and false): ?>
            <div class="advantage container hidden-xs drag-section sAdvantage"
                 data-order="<?= $rz_b2_options['order-sAdvantage'] ?>">
                <? $APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR . "include_areas/index/benefits.php", "EDIT_TEMPLATE" => "include_areas_template.php"), false, array("HIDE_ICONS" => "N")); ?>
            </div>
        <? endif ?>


        <div class="feedback wow fadeIn hidden-xs drag-section sFeedback" data-order="7">
            <div class="container carousel slide" id="comments-carousel">
                <div class="quote-start"></div>
                <div class="quote-end"></div>
                <header>Отзывы покупателей</header>



                <a class="btn-main" style="padding: 10px; display: inline-block;margin-bottom: 30px;" href="/review/" >Посмотреть все отзывы</a>
            </div>
            <!-- /.container -->


        </div>


        <div class="promo-banners container wow fadeIn drag-section sPromoBanners"
             data-order="<?= $rz_b2_options['order-sPromoBanners'] ?>">
            <? $APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR . "include_areas/index/banner1.php", "EDIT_TEMPLATE" => "include_areas_template.php"), false, array("HIDE_ICONS" => "Y", "ACTIVE_COMPONENT" => $rz_b2_options['block_show_ad_banners'])); ?>
            <? $APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR . "include_areas/index/banner2.php", "EDIT_TEMPLATE" => "include_areas_template.php"), false, array("HIDE_ICONS" => "Y", "ACTIVE_COMPONENT" => $rz_b2_options['block_show_ad_banners'])); ?>
        </div>

        <div class="text-content container wow fadeIn  drag-section sContentNews"
             data-order="<?= $rz_b2_options['order-sContentNews'] ?>">
            <div class="text-content-flex">
                <? if ($rz_b2_options['block_home-actions'] == 'Y'): ?>
                    <? //Tools::IncludeArea('index', 'actions', array('TEMPLATE' => 'filter_news_on_main')); ?>
                <? endif ?>
                <? if ($rz_b2_options['block_home-news'] == 'Y'): ?>
                    <? //$APPLICATION->IncludeComponent("bitrix:main.include", "filter_news_on_main", Array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR . "include_areas/index/news.php", "EDIT_TEMPLATE" => "include_areas_template.php"), false, array("HIDE_ICONS" => "Y")); ?>
                <? endif ?>


            </div>
        </div>
        <div class="text-content container wow fadeIn drag-section sContentAbout"
             data-order="<?= $rz_b2_options['order-sContentAbout'] ?>">
            <div class="text-content-flex">
                <div class="about">
                    <? $APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR . "include_areas/index/about_title.php", "EDIT_TEMPLATE" => "include_areas_template.php"), false, array("HIDE_ICONS" => "N")); ?>
                    <? $APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR . "include_areas/index/about_text.php", "EDIT_TEMPLATE" => "include_areas_template.php"), false, array("HIDE_ICONS" => "N")); ?>
                </div>
                <? if ($rz_b2_options['block_home-voting'] == 'Y' and false): ?>
                    <div class="hidden-sm hidden-xs questionnaire-wrap">
                        <? $APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR . "include_areas/index/voting.php", "EDIT_TEMPLATE" => "include_areas_template.php"), false, array("HIDE_ICONS" => "Y")); ?>
                    </div>
                <? endif ?>
            </div>
        </div>
        <? /*
        <div class="text-content container wow fadeIn drag-section sContentBrands"
             data-order="<?= $rz_b2_options['order-sContentBrands'] ?>">
            <? if ($rz_b2_options['block_home-brands'] == 'Y' and false): ?>
                <div class="row brands-wrap wow fadeIn"
                     data-brands-view-type="<?= ($rz_b2_options['brands_cloud'] == 'Y') ? 'tags' : 'carousel' ?>">
                    <div class="col-sm-12">
                        <? $APPLICATION->IncludeComponent("bitrix:main.include", "", Array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR . "include_areas/index/brands.php", "EDIT_TEMPLATE" => "include_areas_template.php"), false, array("HIDE_ICONS" => "Y")); ?>
                    </div><!-- /.col-sm-12 -->
                </div><!-- /.row.brands-wrap -->
            <? endif ?>
        </div>
*/ ?>
        <? if ($rz_b2_options['block_home-vk'] != 'N' || $rz_b2_options['block_home-ok'] != 'N' || $rz_b2_options['block_home-fb'] != 'N' || $rz_b2_options['block_home-tw'] != 'N' || $rz_b2_options['block_home-flmp'] != 'N' || $rz_b2_options['block_home-inst'] != 'N'): ?>
            <div class="text-content container wow fadeIn drag-section sContentNetwork"
                 data-order="<?= $rz_b2_options['order-sContentNetwork'] ?>">
                <div class="social-boxes">
                    <?
                    switch ('Y') {
                    case $rz_b2_options['block_home-vk']:
                    case $rz_b2_options['block_home-ok']:
                    case $rz_b2_options['block_home-fb']:
                    case $rz_b2_options['block_home-tw']:
                    case $rz_b2_options['block_home-inst']:
                    $bHasFooter = true;
                    Tools::IncludeArea('index/social', 'header', false, false); ?>
                    <div class="arrows-wrap">
                        <button type="button" class="arrow prev primary-light disabled" disabled="">
                                    <span class="icon">
                                         <svg>
                                            <use xlink:href="#chevron"></use>
                                        </svg>
                                    </span>
                        </button>
                        <button type="button" class="arrow next primary-light">
                                    <span class="icon">
                                        <use xlink:href="#chevron"></use>
                                    </span>
                        </button>
                    </div>
                    <div id="slider-framessss">
                        <div class="slidee">
                            <?
                            default:
                                break;
                            } ?>
                            <? Tools::IncludeArea('index/social', 'inst', false, true, $rz_b2_options['block_home-inst']) ?>
                            <? Tools::IncludeArea('index/social', 'vk', false, true, $rz_b2_options['block_home-vk']) ?>
                            <? Tools::IncludeArea('index/social', 'ok', false, true, $rz_b2_options['block_home-ok']) ?>
                            <? Tools::IncludeArea('index/social', 'fb', false, true, $rz_b2_options['block_home-fb']) ?>
                            <? Tools::IncludeArea('index/social', 'tw', false, true, $rz_b2_options['block_home-tw']) ?>
                            <? Tools::IncludeArea('index/social', 'flmp', false, true, $rz_b2_options['block_home-flmp']) ?>
                            <? if ($bHasFooter): ?>
                        </div>
                    </div>
                <? endif ?>
                </div>
            </div><!-- /.text-content.container -->
        <? endif ?>
        <div class="blog-slider" data-order="12">
            <div class="container">
                <? $APPLICATION->IncludeComponent(
                    "bitrix:news.list",
                    "blog_slider",
                    array(
                        "COMPONENT_TEMPLATE" => "blog_slider",
                        "IBLOCK_TYPE" => "content",
                        "IBLOCK_ID" => "36",
                        "NEWS_COUNT" => "20",
                        "SORT_BY1" => "ACTIVE_FROM",
                        "SORT_ORDER1" => "DESC",
                        "SORT_BY2" => "SORT",
                        "SORT_ORDER2" => "ASC",
                        "FILTER_NAME" => "",
                        "FIELD_CODE" => array(
                            0 => "NAME",
                            1 => "",
                        ),
                        "PROPERTY_CODE" => array(
                            0 => "",
                            1 => "",
                        ),
                        "CHECK_DATES" => "Y",
                        "DETAIL_URL" => "",
                        "AJAX_MODE" => "N",
                        "AJAX_OPTION_JUMP" => "N",
                        "AJAX_OPTION_STYLE" => "Y",
                        "AJAX_OPTION_HISTORY" => "N",
                        "AJAX_OPTION_ADDITIONAL" => "",
                        "CACHE_TYPE" => "A",
                        "CACHE_TIME" => "36000000",
                        "CACHE_FILTER" => "N",
                        "CACHE_GROUPS" => "Y",
                        "PREVIEW_TRUNCATE_LEN" => "",
                        "ACTIVE_DATE_FORMAT" => "d.m.Y",
                        "SET_TITLE" => "N",
                        "SET_BROWSER_TITLE" => "N",
                        "SET_META_KEYWORDS" => "N",
                        "SET_META_DESCRIPTION" => "N",
                        "SET_LAST_MODIFIED" => "N",
                        "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                        "ADD_SECTIONS_CHAIN" => "N",
                        "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                        "PARENT_SECTION" => "",
                        "PARENT_SECTION_CODE" => "",
                        "INCLUDE_SUBSECTIONS" => "N",
                        "STRICT_SECTION_CHECK" => "N",
                        "DISPLAY_DATE" => "N",
                        "DISPLAY_NAME" => "N",
                        "DISPLAY_PICTURE" => "N",
                        "DISPLAY_PREVIEW_TEXT" => "N",
                        "PAGER_TEMPLATE" => ".default",
                        "DISPLAY_TOP_PAGER" => "N",
                        "DISPLAY_BOTTOM_PAGER" => "N",
                        "PAGER_TITLE" => "Новости",
                        "PAGER_SHOW_ALWAYS" => "N",
                        "PAGER_DESC_NUMBERING" => "N",
                        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                        "PAGER_SHOW_ALL" => "N",
                        "PAGER_BASE_LINK_ENABLE" => "N",
                        "SET_STATUS_404" => "N",
                        "SHOW_404" => "N",
                        "MESSAGE_404" => ""
                    ),
                    false
                ); ?>
            </div>
        </div>
    </main><!-- /.home-page -->
<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>