/*! ===================================
 *  Author: Nazarkin Roman, WPHunters
 *  -----------------------------------
 *  Email(support):
 * 	bbdesign_sp@yahoo.com
 *  ===================================
 */

'use strict';

/**
 * Refresh positioning when page is loaded
 */
jQuery(window).on('load', WPHJS.refreshShuffle);


/**
 * Shuffle grid plugin integration
 */
jQuery(document).ready(function() {

    var $ = jQuery;

    // if shuffle is not available
    if(typeof window.shuffle !== 'function') return;

    // loop through available containers on page
    $('.shuffle-grid').each(function() {
        var Shuffle = window.shuffle;

        var $this = $(this),
            $grid = $this.find('> .grid');

        // plugin init
        var shuffle = new Shuffle($grid[0], {
            itemSelector: '.item',
            speed       : 500,
            delimeter   : '|',
            easing      : 'ease-in-out',
            sizer       : '.sizer-elem'
        });

        // save instance to memory
        $grid.eq(0).data('shuffle', shuffle);

        // setup filter functionality
        $this.find('> .filter a').on('click', function() {
            var $_this = $(this),
                filterGroup = $_this.attr('data-filter');

            shuffle.filter(filterGroup);
            $_this.addClass('filter-active')
                .siblings().removeClass('filter-active');

            return false;
        });
    });

    // apply shuffle to wp galleries too
    var $sizer = $('<div>', {class: 'shuffle-sizer'});
    $('.post-content, .page-content').find('.gallery').each(function () {

        var Shuffle = window.shuffle;

        var $this = $(this).append($sizer);
        $this.addClass('shuffle-gallery');

        // plugin init
        var shuffle = new Shuffle($this[0], {
            itemSelector: '.gallery-item',
            speed       : 500,
            sizer       : '.shuffle-sizer'
        });

        // update layout each time image loaded
        $this.imagesLoaded().progress( function() {
            shuffle.layout();
        });

    });
});