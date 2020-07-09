/*! ===================================
 *  Author: Nazarkin Roman, WPHunters
 *  -----------------------------------
 *  Email(support):
 * 	bbdesign_sp@yahoo.com
 *  ===================================
 */

/**
 * Integration with typed.js plugin
 */
'use strict';

jQuery(window).on('wph.pageload', WPHJS.timeoutIt(250, function () {

    var $ = jQuery;

    // abort function if plugin isn't loaded
    if (typeof $.fn.typed == 'undefined') {
        return;
    }

    // process each typed-enabled element
    $('[data-typed-str]').each(function () {
        var $this = $(this),
            texts = $this.attr('data-typed-str').split('|');

        $this.html('').append('<span class="typed-container"></span>');
        $this.find('.typed-container').typed({
            strings   : texts,
            typeSpeed : 65,
            loop      : ($this.attr('data-typed-repeat') === 'yes'),
            backDelay : 1500,
            showCursor: ($this.attr('data-typed-cursor') === 'yes')
        });
    });

}));