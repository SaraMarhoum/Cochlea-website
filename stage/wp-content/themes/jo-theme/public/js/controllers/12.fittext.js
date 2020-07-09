/*! ===================================
 *  Author: Nazarkin Roman, WPHunters
 *  -----------------------------------
 *  Email(support):
 * 	bbdesign_sp@yahoo.com
 *  ===================================
 */

'use strict';

/**
 * Integration with fitText
 */
jQuery(document).ready(function() {

    var $ = jQuery;

    // abort if plugin isn't loaded
    if (typeof $.fn.fitText == 'undefined') {
        return;
    }

    // process elements
    $('.fittext').each(function() {
        var $this = $(this),
            compressor = $this.data('comp-rate') || 1;

        $this.fitText(compressor, {
            minFontSize: $this.data('min-size') || Number.NEGATIVE_INFINITY,
            maxFontSize: $this.data('max-size') || Number.POSITIVE_INFINITY
        });
    });

    // force recalc
    $(window).trigger('resize');
});
