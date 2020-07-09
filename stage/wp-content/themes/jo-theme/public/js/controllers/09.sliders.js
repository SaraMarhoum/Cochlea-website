/*! ===================================
 *  Author: Nazarkin Roman, WPHunters
 *  -----------------------------------
 *  Email(support):
 * 	bbdesign_sp@yahoo.com
 *  ===================================
 */

'use strict';

/**
 * Site Sliders
 */
jQuery(document).ready(function () {

    var $ = jQuery;

    // abort if plugin isn't loaded
    if (typeof $.fn.slick == 'undefined') {
        return;
    }

    // ======================= testimonials slider
    var $sliders = $('.wph-testimonials > .slider'),
        $authors = $sliders.siblings('.authors-box').find('> .item');

    // set first author active
    $authors.filter(':first').addClass('active');

    // on change
    $sliders.on('afterChange', function(e, slick) {
        var $slider = $(this),
            $authors = $slider.siblings('.authors-box').find('> .item');

        $authors.removeClass('active')
            .eq(slick.currentSlide)
            .addClass('active');
    });

    // on click
    $authors.on('click', function() {
        var $this = $(this),
            $slider = $this.parents('.authors-box').siblings('.slider');

        $slider.slick('slickGoTo', $this.index());

        $this.addClass('active')
            .siblings().removeClass('active');
    });

    // run slick engine
    $sliders.slick({
        adaptiveHeight: true,
        autoplay      : true,
        autoplaySpeed : 7800,
        speed         : 750,

        slidesToShow  : 1,
        slidesToScroll: 1,

        dots          : false,
        arrows        : false,
        slide         : '.item',
        infinite      : true
    });


    // ======================= logo showcase sliders
    $('.wph-logo-showcase').slick({
        autoplaySpeed: 7500,
        autoplay     : false, // change to true to enable
        variableWidth: true,
        arrows       : true,
        dots         : false,
        centerMode   : true,
        centerPadding: 0
    });


    // ======================= jo main slider
    $('.wph-jo-slider').each(function() {

        var $container = $(this),
            $bg = $container.find('> .slides'),
            $titles = $container.find('> .titles'),
            slider_id = $container.data('slider-id');

        // parse height param
        var slideHeight = '100vh';
        if($container.data('slider-height') !== 'fullscreen') {
            slideHeight = $container.data('slider-height') + 'px';
        }

        // init bg slider
        $bg.find('> div.item').css('height', slideHeight);
        $bg.slick({
            slidesToShow  : 1,
            slidesToScroll: 1,
            autoplay      : false,
            dots          : false,
            pauseOnHover  : false,
            arrows        : false,
            asNavFor      : $titles
        });

        // init titles slider
        $titles.on('init', function () {
            $titles.append('<a href="#" class="slick-read-more"></a>');

            $titles.find('.item > h1').on('click', function () {
                var url = $(this).parent().data('url');

                if (url == '') {
                    return false;
                } else {
                    location.href = url;
                }
            });

            $titles.trigger('beforeChange', [null, 0, 0]);
        });

        $titles.on('beforeChange', function(e, slick, current, next) {
            var $next = $titles.find('.slick-slide').eq(next),
                color = $next.data('color');

            $titles.find('.slick-read-more').attr('href', $next.data('url'));
            $titles.toggleClass('without-btn', $next.data('url') == '');

            if ($container.hasClass('design-2')) {
                return;
            }

            $('.wph-slider-toolbox[data-slider-id="' + slider_id + '"]').css('color', color);
            $titles.find('.slick-dots, .slick-read-more').css('color', color);
            $('.wph-site-header').css('color', color);
            $next.css('color', color);
        });

        $(window).on('wph.docready wph.recalc', function () {
            if (!$container.hasClass('design-2')) {
                return;
            }

            $bg.find('.slick-slide > .container').css({
                borderTopWidth   : $('.wph-site-header:visible').outerHeight(),
                borderBottomWidth: $container.siblings('.wph-slider-toolbox:eq(0)').outerHeight()
            });

            $titles.toggleClass('tight-titles', $container.height() < 1000);
        });

        $titles.slick({
            slidesToShow  : 1,
            slidesToScroll: 1,
            pauseOnHover  : false,
            autoplay      : false,
            dots          : true,
            arrows        : false,
            fade          : true,
            adaptiveHeight: true,
            asNavFor      : $bg
        });

    });


    // ======================= custom sliders
    $('.slick-slider-api').slick();

});


/**
 * Stop sliders when not in viewport
 */
jQuery(window).on('scroll', jQuery.throttle(250, function () {

    var $ = jQuery;

    $('.slick-initialized').each(function () {

        var $this = $(this),
            $slick = $this.slick('getSlick');

        // do not touch sliders with disabled autoplaying
        if ($slick.options.autoplay === false) {
            return;
        }

        // stop slider
        if (!WPHJS.isElementInViewport(this) && !$slick.paused) {
            $this.slick('pause');
        }

        // unpause slider
        if (WPHJS.isElementInViewport(this) && $slick.paused) {
            $this.slick('play');
        }

    });

}));