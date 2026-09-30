<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");

$APPLICATION->SetPageProperty("title", "О компании Lokamed — история, партнёры и реквизиты");
$APPLICATION->SetPageProperty("description", "О компании Lokamed: история салонов оптики, фотографии, партнёры, достижения, рейтинги и реквизиты.");
$APPLICATION->SetTitle("О компании");

$contactsIblocks = [];
if (\Bitrix\Main\Loader::includeModule('iblock')) {
    foreach (['gallery_salons', 'partners_in_contacts', 'achievements_in_contacts'] as $code) {
        $iblock = CIBlock::GetList([], ['=TYPE' => 'contacts', '=CODE' => $code, 'ACTIVE' => 'Y'])->Fetch();
        $contactsIblocks[$code] = $iblock ? (int)$iblock['ID'] : 0;
    }
}

$renderContactsSlider = static function (int $iblockId, string $variant) use ($APPLICATION): void {
    if ($iblockId <= 0) {
        return;
    }

    $APPLICATION->IncludeComponent(
        'lokamed:about.sliders',
        '',
        [
            'IBLOCK_ID' => $iblockId,
            'CACHE_TYPE' => 'A',
            'CACHE_TIME' => 36000000,
            'CACHE_VERSION' => 'partner-details-popover-v5',
            'SLIDER_VARIANT' => $variant,
        ],
        false,
        ['HIDE_ICONS' => 'N']
    );
};
?>
<link rel="stylesheet" href="/o-kompanii/style.css?v=<?= (int)filemtime($_SERVER['DOCUMENT_ROOT'] . '/o-kompanii/style.css') ?>">

<main class="container lokamed-about-page">
    <div class="lokamed-about-content">
        <h1 class="lokamed-page-title">О компании</h1>

        <section class="lokamed-about-section lokamed-about-intro">
            <div class="lokamed-about-intro__text">
                <p>Сеть салонов оптики Lokamed уже 21 год (с 2005 года) работает на рынке города Москвы и области. Наша задача — помочь вам лучше видеть и лучше выглядеть. Lokamed является официальным дистрибьютором многих известных брендов в России и поставляет только 100% оригинальные брендовые оправы и солнцезащитные очки.</p>
                <details class="lokamed-about-intro__details">
                    <summary>Подробнее</summary>

                    <p>Здесь работают профессионалы высочайшего класса, которые смогут воплотить практически любую вашу задумку в жизнь, а также помогут подобрать очки, в которые вы точно влюбитесь.</p>
                    <p>Бесплатная проверка зрения при покупке очков, подбор оправ и линз, ремонт очков любой сложности - в салонах оптики мы проводим достаточно большой спектр услуг.</p>
                    <p>Будем рады приветствовать вас в наших салонах оптики в Зеленограде, Митино и Одинцово.</p>
                </details>

                <div class="lokamed-about-actions">
                    <a href="/review/" class="lokamed-green-btn">Отзывы о нас</a>
                    <a href="/o-kompanii/vacancies/" class="lokamed-green-btn">Вакансии</a>
                </div>
            </div>

            <?php $renderContactsSlider($contactsIblocks['gallery_salons'], 'gallery'); ?>
        </section>

        <section class="lokamed-about-section">
            <h2 class="h1 lokamed-section-title">Наши партнёры</h2>

            <?php $renderContactsSlider($contactsIblocks['partners_in_contacts'], 'partners'); ?>

            <div class="lokamed-partners-cta">
                <button type="button" class="lokamed-green-btn lokamed-partners-cta__button js-partner-request" data-toggle="modal" data-target="#modal_partner_request">
                    Стать партнёром
                </button>
            </div>
        </section>

        <section class="lokamed-about-section">
            <h2 class="h1 lokamed-section-title">Наши достижения</h2>

            <?php $renderContactsSlider($contactsIblocks['achievements_in_contacts'], 'achievements'); ?>
        </section>

        <section class="lokamed-about-section">
            <h2 class="h1 lokamed-section-title">Реквизиты</h2>

            <div class="lokamed-requisites">
                <div class="lokamed-requisites__row">
                    <div class="lokamed-requisites__label">Полное наименование</div>
                    <div class="lokamed-requisites__value">ИП Исаев Имран Абдуллаевич</div>
                </div>
                <div class="lokamed-requisites__row">
                    <div class="lokamed-requisites__label">ИНН</div>
                    <div class="lokamed-requisites__value">332804392013</div>
                </div>
                <div class="lokamed-requisites__row">
                    <div class="lokamed-requisites__label">ОГРНИП</div>
                    <div class="lokamed-requisites__value">307332818400010</div>
                </div>
                <div class="lokamed-requisites__row">
                    <div class="lokamed-requisites__label">Почтовый адрес</div>
                    <div class="lokamed-requisites__value">Московская обл., Красногорский р-н, д. Путилково, Спасо-Тушинский бульвар, 5</div>
                </div>
                <div class="lokamed-requisites__row">
                    <div class="lokamed-requisites__label">Телефон</div>
                    <div class="lokamed-requisites__value"><a href="tel:+78006005703">8-800-600-5703</a></div>
                </div>
                <div class="lokamed-requisites__row">
                    <div class="lokamed-requisites__label">E-mail</div>
                    <div class="lokamed-requisites__value"><a href="mailto:info@optika-lokamed.ru">info@optika-lokamed.ru</a></div>
                </div>
                <div class="lokamed-requisites__row">
                    <div class="lokamed-requisites__label">р/с</div>
                    <div class="lokamed-requisites__value">40802810238000015793</div>
                </div>
                <div class="lokamed-requisites__row">
                    <div class="lokamed-requisites__label">Банк</div>
                    <div class="lokamed-requisites__value">ПАО СБЕРБАНК Г.МОСКВА</div>
                </div>
                <div class="lokamed-requisites__row">
                    <div class="lokamed-requisites__label">БИК</div>
                    <div class="lokamed-requisites__value">044525225</div>
                </div>
                <div class="lokamed-requisites__row">
                    <div class="lokamed-requisites__label">к/с</div>
                    <div class="lokamed-requisites__value">30101810400000000225</div>
                </div>
            </div>
        </section>
    </div>
</main>

<div class="modal fade modal-form modal_feedback" id="modal_partner_request" tabindex="-1" role="dialog" aria-labelledby="modal_partner_request_title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <button type="button" class="btn-close" data-toggle="modal" data-target="#modal_partner_request" aria-label="Закрыть">
            <span class="btn-text">Закрыть</span>
            <i class="flaticon-close47" aria-hidden="true"></i>
        </button>
        <div class="content" aria-live="polite"></div>
    </div>
</div>
<script>
    jQuery(function ($) {
        function initAboutSlider($slider, isPartnerSlider) {
            if ($slider.hasClass('slick-initialized')) {
                return;
            }

            $slider.slick({
                dots: isPartnerSlider,
                infinite: false,
                speed: 300,
                slidesToShow: 5,
                slidesToScroll: isPartnerSlider ? 5 : 1,
                prevArrow: '<button type="button" class="utp_slider_prev lokamed-slider-arrow" aria-label="Предыдущий слайд"><span aria-hidden="true">‹</span></button>',
                nextArrow: '<button type="button" class="utp_slider_next lokamed-slider-arrow" aria-label="Следующий слайд"><span aria-hidden="true">›</span></button>',
                responsive: [
                    {
                        breakpoint: 1280,
                        settings: { slidesToShow: 4, slidesToScroll: isPartnerSlider ? 4 : 1 }
                    },
                    {
                        breakpoint: 980,
                        settings: { slidesToShow: 3, slidesToScroll: isPartnerSlider ? 3 : 1 }
                    },
                    {
                        breakpoint: 767,
                        settings: { slidesToShow: 2, slidesToScroll: isPartnerSlider ? 2 : 1 }
                    },
                    {
                        breakpoint: 550,
                        settings: { slidesToShow: 1, slidesToScroll: 1 }
                    }
                ]
            });
        }

        $('.lokamed-about-gallery-slider, .lokamed-achievements-slider').each(function () {
            initAboutSlider($(this), false);
        });

        var $partnerSliders = $('.lokamed-partners-slider');
        var partnerSliderBreakpoint = window.matchMedia('(max-width: 767px)');

        function syncPartnerSliders() {
            $partnerSliders.each(function () {
                var $slider = $(this);

                if (window.innerWidth <= 767) {
                    initAboutSlider($slider, true);
                } else if ($slider.hasClass('slick-initialized')) {
                    $slider.slick('unslick');
                }
            });
        }

        syncPartnerSliders();

        if (partnerSliderBreakpoint.addEventListener) {
            partnerSliderBreakpoint.addEventListener('change', syncPartnerSliders);
        } else if (partnerSliderBreakpoint.addListener) {
            partnerSliderBreakpoint.addListener(syncPartnerSliders);
        }

        $(window).on('resize', function () {
            window.setTimeout(syncPartnerSliders, 0);
        });

        var introBreakpoint = window.matchMedia('(min-width: 601px)');
        var $introDetails = $('.lokamed-about-intro__details');

        function setIntroSummaryLabel(details) {
            $(details).find('summary').text(details.open ? 'Скрыть' : 'Подробнее');
        }

        function syncIntroDetails() {
            $introDetails.each(function () {
                this.open = introBreakpoint.matches;
                setIntroSummaryLabel(this);
            });
        }

        syncIntroDetails();

        $introDetails.on('toggle', function () {
            setIntroSummaryLabel(this);
        });

        if (introBreakpoint.addEventListener) {
            introBreakpoint.addEventListener('change', syncIntroDetails);
        } else if (introBreakpoint.addListener) {
            introBreakpoint.addListener(syncIntroDetails);
        }

        $('.lokamed-partner-card').each(function () {
            var $card = $(this);
            var $legacyDetails = $card.children('.lokamed-partner-card__text, .lokamed-partner-card__more');

            if ($legacyDetails.length) {
                $legacyDetails.wrapAll('<div class="lokamed-partner-card__details"></div>');
            }
        });

        var $partnerCards = $('.lokamed-partner-card').filter(function () {
            return $(this).find('.lokamed-partner-card__details').length;
        });
        var partnerHoverMedia = window.matchMedia('(hover: hover) and (pointer: fine)');

        function setPartnerCardState(card, expanded) {
            var $card = $(card);

            $card.toggleClass('is-expanded', expanded).attr('aria-expanded', expanded ? 'true' : 'false');
            $card.find('.lokamed-partner-card__details').attr('aria-hidden', expanded ? 'false' : 'true');
            $card.find('.lokamed-partner-card__more a').attr('tabindex', expanded ? '0' : '-1');
        }

        $partnerCards.each(function () {
            setPartnerCardState(this, false);
        });

        $partnerCards.on('mouseenter', function () {
            if (partnerHoverMedia.matches) {
                setPartnerCardState(this, true);
            }
        }).on('mouseleave', function () {
            if (partnerHoverMedia.matches && !$(this).is(':focus')) {
                setPartnerCardState(this, false);
            }
        }).on('focusin', function () {
            setPartnerCardState(this, true);
        }).on('focusout', function () {
            var card = this;

            window.setTimeout(function () {
                if (!$(card).is(':focus') && !$(card).find(':focus').length) {
                    setPartnerCardState(card, false);
                }
            }, 0);
        }).on('keydown', function (event) {
            if (event.key === 'Enter' || event.key === ' ') {
                event.preventDefault();
                setPartnerCardState(this, !$(this).hasClass('is-expanded'));
            }

            if (event.key === 'Escape') {
                setPartnerCardState(this, false);
            }
        });

        $partnerCards.on('click', function (event) {
            var $card = $(this);

            if (!partnerHoverMedia.matches && !$(event.target).closest('.lokamed-partner-card__more, .lokamed-partner-card__logo-link').length) {
                event.preventDefault();
                setPartnerCardState(this, !$card.hasClass('is-expanded'));
            }
        });

        $(document).on('click', '.js-partner-request', function (event) {
            event.preventDefault();
            $('#modal_partner_request').modal('show');

            if (typeof RZB2.ajax.partnerRequest === 'undefined') {
                RZB2.ajax.partnerRequest = new RZB2.ajax.FormUnified({
                    ID: 'modal_partner_request',
                    AJAX_FILE: SITE_DIR + 'o-kompanii/partner-form.php',
                    URL: location.pathname
                });
                RZB2.ajax.partnerRequest.Load();
            }
        });

        function handlePartnerRequestResponse(response) {
            var $modal = $('#modal_partner_request');

            $modal.find('.content').html(response);

            if (response.indexOf("'fail'") === -1) {
                $modal.find('form').trigger('reset');
                $('#modal_success').one('hide.bs.modal', function () {
                    $modal.modal('hide');
                });
            }

            if (RZB2.utils.initValidForms) {
                RZB2.utils.initValidForms();
            }
        }

        $('#modal_partner_request').on('submit', 'form', function (event) {
            event.preventDefault();
            RZB2.ajax.partnerRequest.Post($(this), handlePartnerRequestResponse, false);
        });
    });
</script>
<?php require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>
