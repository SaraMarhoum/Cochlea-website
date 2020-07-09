/*! ===================================
 *  Author: Nazarkin Roman, WPHunters
 *  -----------------------------------
 *  Email(support):
 * 	bbdesign_sp@yahoo.com
 *  ===================================
 */

'use strict';

/**
 * Other small code pieces
 */
jQuery(document).ready(function () {

    var $ = jQuery,
        $elems = $('#wph-main-container iframe');

    // abort if plugin isn't loaded
    if (typeof $.fn.recliner == 'undefined') {
        return;
    }

    // pre-process elements
    $elems.each(function () {
        var $this = $(this);
        $this.attr('data-src', $this.attr('src'));
        $this.attr('src', '');

        $this.css('opacity', 0).parent().addClass('lazy-wrap');
    });

    // show element callback
    $elems.on('lazyshow', WPHJS.timeoutIt(1000, function () {
        var $this = $(this);

        $this.animate({opacity: 1}, 'slow')
            .parent().removeClass('lazy-wrap');
    }));

    $elems.recliner({
        attrib   : 'data-src',  // selector for attribute containing the media src
        throttle : 300,         // millisecond interval at which to process events
        threshold: 100,         // scroll distance from element before its loaded
        live     : true         // auto bind lazy loading to ajax loaded elements
    });
});