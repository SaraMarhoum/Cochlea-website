/*! ===================================
 *  Author: Nazarkin Roman, WPHunters
 *  -----------------------------------
 *  Email(support):
 * 	bbdesign_sp@yahoo.com
 *  ===================================
 */

'use strict';

/**
 * Trigger calculation functions on interval
 */
(function ($) {
    var lastWidth = null;
    $(window).trigger('wph.recalc');

    setInterval(function () {
        var currWidth = $(window).width();
        if (lastWidth === currWidth) {
            return;
        }

        $(window).trigger('wph.recalc');
        lastWidth = currWidth;
    }, 500);
})(jQuery);


/**
 * Other small code pieces
 */
jQuery(document).ready(function () {

    var $ = jQuery;

    // make clicks on mobile faster
    if(typeof FastClick === 'function') {
        FastClick.attach(document.body);
    }

    // run one-page navigation engine
    $('body').__initSmoothScroll();

    // add "table" class to all tables elements
    $('.post-content table')
        .add('.page-content table')
        .add('.site-widget table')
        .add('.wph-comments-section table')
        .add('#wp-calendar')
        .addClass('table');

    // add inner span helper to all buttons
    $('a.btn').wrapInner('<span/>');
    $('input.btn[type=submit]').each(function () {
        var $this = $(this),
            originalAtts = $this.getAllAttributes();

        var $button = $('<button/>', originalAtts).wrapInner('<span/>');
        $button.find('> span').text(originalAtts.value);
        $button.insertAfter($this);

        $this.remove();
    });

    // sequenced transition setter
    var prevParent = null, incValue = 0;
    $('.seq-transition').each(function() {

        var $this = $(this),
            $parent = $this.parent();

        // reset params when new block reached
        if (!$parent.is(prevParent)) {
            prevParent = $parent;
            incValue = 0;
        }

        this.style[Modernizr.prefixed('transitionDelay')] = (incValue++ * 75) + 'ms';
    });

    // is scrollbar can be hidden
    $('html').toggleClass('can-hide-scrollbar', (WPHJS.getScrollbarWidth() === 0));

    // shorthand trigger
    $(window).trigger('wph.docready');

});


/**
 * Code that runs after page show
 */
jQuery(window).on('wph.pageload', function () {

    // refresh match height plugin values
    WPHJS.refreshMatchHeight();

    // force trigger calculations
    jQuery(window).trigger('wph.recalc');

});


/**
 * Emulate media queries
 */
jQuery(window).on('wph.recalc', function () {

    var $ = jQuery,
        w = $(window).width(),
        $html = $('html');

    $html.removeClass('media-xs media-sm media-md');

    if (w >= 992) {
        $html.addClass('media-md');
    } else if (w >= 768) {
        $html.addClass('media-sm');
    } else {
        $html.addClass('media-xs');
    }

});


/**
 * Vertical & Horizontal centering elements via negative margins
 */
jQuery(window).on('wph.recalc.cr-js', function () {

    var $ = jQuery,
        $elems = $('.vh-center-js');

    // unbind if there is no target elements
    if (!$elems.length) {
        $(window).unbind('wph.recalc.cr-js');
        return;
    }

    // start processing
    $elems.each(function () {

        var $this = $(this),
            w = $this.outerWidth(),
            h = $this.outerHeight();

        $this.css('margin-top', -1 * Math.floor((h / 2)));
        $this.css('margin-left', -1 * Math.floor((w / 2)));

    });

});