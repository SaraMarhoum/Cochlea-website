/*! ===================================
 *  Author: Nazarkin Roman, WPHunters
 *  -----------------------------------
 *  Email(support):
 * 	bbdesign_sp@yahoo.com
 *  ===================================
 */

/**
 * Magnific Popup plugin integration
 */
'use strict';

jQuery(document).ready(function() {

    var $ = jQuery;

    // abort if plugin is not loaded
    if(typeof $.fn.magnificPopup == 'undefined') {
        return;
    }

    // attach to images inside post/page body
    $('.post-content, .static-page, .wpb_single_image, .wph-img-popup')
        .find('a[href*=".png"], a[href*=".gif"], a[href*=".jpg"], a[href*=".jpeg"]')
        .filter('a:not(.prettyphoto)')
        .filter('a:not(.envira-gallery-link)')
        .addClass('remove-outline')
        .magnificPopup({type: 'image'});


    // attach to WP galleries
    $('#wph-main-container')
    .find('.gallery')
    .each(function() {
        $(this).find('.gallery-item a').magnificPopup({
            type    : 'image',
            gallery : {enabled: true},
            image: {
                titleSrc: function (item) {
                    return item.el.parent().siblings('.gallery-caption').text();
                }
            }
        });
    });

});