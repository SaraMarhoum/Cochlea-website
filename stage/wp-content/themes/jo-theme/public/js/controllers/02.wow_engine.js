/*! ===================================
 *  Author: Nazarkin Roman, WPHunters
 *  -----------------------------------
 *  Email(support):
 * 	bbdesign_sp@yahoo.com
 *  ===================================
 */

/**
 * Code related to WOW.js appearance animation engine
 */
'use strict';
jQuery(window).on('wph.pageload', WPHJS.timeoutIt(250, function () {

    var $ = jQuery;

    // this engine is disabled for touch devices
    // and can be manually disable in theme options
    if (Modernizr.touchevents || parseInt(WPHJS.phpData('WOWDisable', '0')) === 1) {
        WPHJS.WOWDisabled = true;
        return;
    }

    // sequenced animations
    $('.wow.sequenced').each(function () {
        var $this = $(this), rowStart = null;
        $this.removeClass('wow sequenced');

        // get fx name
        var classname = $this.attr('class'),
            fxname = /fx-([a-zA-Z]+)/g.exec(classname),
            i = 0, row_id = 0, row_start_timing = 0;

        // child elements
        var $children = $this.find('> *');
        //if ($this.hasClass('wpb_column') || $this.hasClass('wpb_row')) {
        //    $children = $this.find('.wpb_wrapper > *');
        //    row_start_timing = 1;
        //}

        // enqueue
        $children.each(function () {
            var $_this = $(this), currTopPosition = $_this.position().top;

            // check for a new row
            if (currTopPosition != rowStart) {
                rowStart = currTopPosition;
                i = row_start_timing;
                row_id++;
            }

            $_this.addClass('wow ' + fxname[1]).attr('data-wow-delay', (i * (100 + row_id * 100)).toString() + 'ms');
            i++;
        });
    });

    // init engine
    new WOW({
        boxClass    : 'wow',      // animated element css class (default is wow)
        animateClass: 'animated', // animation css class (default is animated)
        offset      : 100,        // distance to the element when triggering the animation (default is 0)
        mobile      : false       // trigger animations on mobile devices (default is true)
    }).init();

}));