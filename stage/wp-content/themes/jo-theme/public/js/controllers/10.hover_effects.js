/*! ===================================
 *  Author: Nazarkin Roman, WPHunters
 *  -----------------------------------
 *  Email(support):
 * 	bbdesign_sp@yahoo.com
 *  ===================================
 */

'use strict';

/**
 * 3D Hover effect for portfolio thumbs
 */
(function ($) {

    // capability check
    // firefox have a bug with transitions for mouse events
    // IE10 cant properly animate bg on mousemove
    if (WPHJS.WOWDisabled ||
        !WPHJS.is_chrome ||
        Modernizr.touchevents || !Modernizr.csstransitions || !Modernizr.csstransforms) {
        return false;
    }

    // initial variables
    var transform = Modernizr.prefixed('transform'),
        currentElement = false;

    var processingFunction = function ($layer, e) {
        var w = $layer.outerWidth(),
            h = $layer.outerHeight();

        var offsetX = 0.5 - (e.pageX - $layer.offset().left) / w,
            offsetY = 0.5 - (e.pageY - $layer.offset().top) / h;

        // apply transform to bg
        var p_strength = $layer.data('parallax-strength') || 20,
            trX = Math.round(offsetX * p_strength) + 'px',
            trY = Math.round(offsetY * p_strength) + 'px',
            scale = '';

        // scale settings
        if (!$layer.data('mp-noscale')) {
            scale = 'scale(1.1, 1.1) ';
        }

        $layer[0].style[transform] = scale + 'translate(' + trX + ', ' + trY + ')';
    };

    // one main event listener
    $(window).on('mousemove', function (e) {
        if (!currentElement) {
            return;
        }
        processingFunction(currentElement, e);
    });

    // attach listener to element when mouse enter it
    $(document).on('mouseover', '.mp-container', function() {
        var $this = $(this).addClass('mp-initial'),
            $elem = $this.find('.mp-target');

        $this.addClass('mp-over').removeClass('mp-initial');
        currentElement = $elem;
    });

    // ..and when mouse goes out
    $(document).on('mouseout', '.mp-container', function() {
        $(this).removeClass('mp-over').addClass('mp-initial');
        currentElement = false;
    });

})(jQuery);