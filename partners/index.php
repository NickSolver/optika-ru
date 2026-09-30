<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");

$APPLICATION->SetPageProperty("title", "Партнёры Lokamed");
$APPLICATION->SetPageProperty("description", "Партнёры сети салонов оптики Lokamed.");
$APPLICATION->SetTitle("Партнёры");

$partnersIblockId = 0;
if (\Bitrix\Main\Loader::includeModule('iblock')) {
    $iblock = CIBlock::GetList(
        [],
        ['=TYPE' => 'contacts', '=CODE' => 'partners_in_contacts', 'ACTIVE' => 'Y']
    )->Fetch();
    $partnersIblockId = $iblock ? (int)$iblock['ID'] : 0;
}
?>
<link rel="stylesheet" href="/partners/style.css?v=<?= (int)filemtime($_SERVER['DOCUMENT_ROOT'] . '/partners/style.css') ?>">

<main class="container lokamed-about-page lokamed-partners-only">
    <section class="lokamed-about-section lokamed-partners-only__section">
        <h1 class="lokamed-page-title">Наши партнёры</h1>

        <?php if ($partnersIblockId > 0): ?>
            <?php $APPLICATION->IncludeComponent(
                'lokamed:about.sliders',
                '',
                [
                    'IBLOCK_ID' => $partnersIblockId,
                    'CACHE_TYPE' => 'A',
                    'CACHE_TIME' => 36000000,
                    'CACHE_VERSION' => 'partner-details-popover-v5',
                    'SLIDER_VARIANT' => 'partners',
                ],
                false,
                ['HIDE_ICONS' => 'N']
            ); ?>
        <?php endif; ?>

        <div class="lokamed-partners-cta">
            <button type="button" class="lokamed-green-btn lokamed-partners-cta__button js-partner-request" data-toggle="modal" data-target="#modal_partner_request">
                Стать партнёром
            </button>
        </div>
    </section>
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
        var $partnerSlider = $('.lokamed-partners-slider');
        var partnerSliderBreakpoint = window.matchMedia('(max-width: 767px)');

        function syncPartnerSlider() {
            if (partnerSliderBreakpoint.matches && !$partnerSlider.hasClass('slick-initialized')) {
                $partnerSlider.slick({
                    dots: true,
                    infinite: false,
                    speed: 300,
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    prevArrow: '<button type="button" class="utp_slider_prev lokamed-slider-arrow" aria-label="Предыдущий слайд"><span aria-hidden="true">‹</span></button>',
                    nextArrow: '<button type="button" class="utp_slider_next lokamed-slider-arrow" aria-label="Следующий слайд"><span aria-hidden="true">›</span></button>'
                });
            } else if (!partnerSliderBreakpoint.matches && $partnerSlider.hasClass('slick-initialized')) {
                $partnerSlider.slick('unslick');
            }
        }

        syncPartnerSlider();
        if (partnerSliderBreakpoint.addEventListener) {
            partnerSliderBreakpoint.addEventListener('change', syncPartnerSlider);
        } else {
            partnerSliderBreakpoint.addListener(syncPartnerSlider);
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
            if (!partnerHoverMedia.matches && !$(event.target).closest('.lokamed-partner-card__more, .lokamed-partner-card__logo-link').length) {
                event.preventDefault();
                setPartnerCardState(this, !$(this).hasClass('is-expanded'));
            }
        });

        $(document).on('click', '.js-partner-request', function (event) {
            event.preventDefault();
            $('#modal_partner_request').modal('show');

            if (typeof RZB2.ajax.partnerRequest === 'undefined') {
                RZB2.ajax.partnerRequest = new RZB2.ajax.FormUnified({
                    ID: 'modal_partner_request',
                    AJAX_FILE: SITE_DIR + 'partners/partner-form.php',
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
