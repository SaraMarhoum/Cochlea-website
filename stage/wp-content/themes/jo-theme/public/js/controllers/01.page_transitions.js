/*! ===================================
 *  Author: Nazarkin Roman, WPHunters
 *  -----------------------------------
 *  Email(support):
 * 	bbdesign_sp@yahoo.com
 *  ===================================
 */

/**
 * Used to trigger pageload event & work with preloaders
 */
'use strict';
(function($) {

    // fade-in function
    var fadeIn = function () {
        if ($(window).data('wph-loaded')) {
            return;
        }

        $('.preloader-overlay').delay(250).fadeOut(500);
        $(window).data('wph-loaded', true);
        $(window).trigger('wph.pageload');
    };

    // fallback preloader removal
    setTimeout(fadeIn, 7500);

    // onload preloader removal
    $(window).on('load', WPHJS.timeoutIt(750, fadeIn));

})(jQuery);


/**
 * Disable hover effects when scroll
 */
(function () {
    var body = document.body,
        timer;

    window.addEventListener('scroll', function () {
        clearTimeout(timer);
        if (!body.classList.contains('disable-hover')) {
            body.classList.add('disable-hover')
        }

        timer = setTimeout(function () {
            body.classList.remove('disable-hover')
        }, 100);
    }, false);
})();