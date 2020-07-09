/*! ===================================
 *  Author: Nazarkin Roman, WPHunters
 *  -----------------------------------
 *  Email(support):
 * 	bbdesign_sp@yahoo.com
 *  ===================================
 */

/**
 * Swapping image positions in chess-styled blogroll
 */
'use strict';
jQuery(document).ready(function () {

    var $ = jQuery;

    // loop through all chess items on page
    $('.wph-blog-chess > .post-item').each(function() {

        var $this = $(this);
        if($this.index() % 2 === 1) { return; }

        $this.find('> .image-column').insertAfter($this.find('> .meta-column'));

    });

});