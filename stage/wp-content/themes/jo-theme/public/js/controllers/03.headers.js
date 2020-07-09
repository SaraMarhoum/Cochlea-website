/*! ===================================
 *  Author: Nazarkin Roman, WPHunters
 *  -----------------------------------
 *  Email(support):
 * 	bbdesign_sp@yahoo.com
 *  ===================================
 */

/**
 * Init header code
 */
'use strict';
(function($) {

    var $header = $('.wph-site-header'),
        $fn = $('#wph-fullscreen-navigation'),
        $fnToggle = $('.fullscreen-menu-toggle'),
        $html = $('html');

    // searchform toggle
    $header.find('.toolbox .search-icon-toggle').on('click', function () {
        var $toolbox = $(this).closest('.toolbox').toggleClass('search-open');

        $(this).on(WPHJS.transitionEnd, function () {
            $toolbox.find('#searchform input[type="text"]').focus();
        });
    });

    // close search field on blur if no text entered
    $header.find('.toolbox #searchform input[type="text"]').on('blur', function () {
        var $this = $(this);

        if (!$this.val()) {
            $this.closest('.toolbox').removeClass('search-open');
        }
    });

    // set proper padding to hide scrollbar inside fullscreen navigation
    $fn.find('> .inner-wrap').css('padding-right', (50 - WPHJS.getScrollbarWidth()) + 'px');

    // disable click on parent menu items
    $header.find('.menu-item-has-children > a').on('click', function() {
        var $parent = $(this).parent();

        if($parent.hasClass('dd-active')) {
            $parent.removeClass('dd-active');
            $parent.find('.dd-active').removeClass('dd-active');
            return false;
        }

        $parent.addClass('dd-active').siblings().removeClass('dd-active');

        $parent.__doWhenClickOutside(function() {
            $(this).removeClass('dd-active');
        });

        return false;
    });

    // fullscreen menu
    $fn.find('.menu-item-has-children > a').on('click.wph', function() {
        var $this = $(this),
            $parent = $this.parent(),
            $siblings = $parent.siblings().filter('.dropdown-active');

        var $elems = $parent.add($siblings);

        $elems.toggleClass('dropdown-active');
        $parent.parents('.nav_menu').toggleClass('dropdown-active');

        $elems.find('> .sub-menu').animate({
            opacity: 'toggle',
            height : 'toggle'
        }, 250);

        return false;
    });

    // fullscreen menu toggle controller
    var fnOpen = false;
    var fnToggleFunc = function() {

        fnOpen = !fnOpen;
        $html.toggleClass('wph-fullscreen-nav-open');

        var headerHeight = $('.wph-site-header:visible:eq(0)').outerHeight();
        $('#wph-fullscreen-navigation').css('border-top-width', headerHeight).fadeToggle('fast');

        return false;
    };

    // bind events
    $fnToggle.on('click.wph', fnToggleFunc);

    $(document).on('keyup.wph', function(e) {
        if (e.keyCode == 27 && fnOpen) fnToggleFunc(); // 27 = escape key
    });

    $fn.find('li:not(.menu-item-has-children) > a').one('click.wph', function() {
        fnToggleFunc();
        return true;
    });

})(jQuery);