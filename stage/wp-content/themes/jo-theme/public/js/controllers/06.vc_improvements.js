/*! ===================================
 *  Author: Nazarkin Roman, WPHunters
 *  -----------------------------------
 *  Email(support):
 * 	bbdesign_sp@yahoo.com
 *  ===================================
 */

/**
 * Visual Composer front-end improvements
 */
'use strict';

jQuery(document).ready(function() {

    var $ = jQuery;

    // set proper placeholder for blocks with video background
    var $containers = $('.vc_video-bg-container').each(function() {
        var $this = $(this), v_url = $this.attr('data-vc-parallax-image');

        var video_id = v_url.split('v=')[1];
        var ampersandPosition = video_id.indexOf('&');
        if (ampersandPosition != -1) {
            video_id = video_id.substring(0, ampersandPosition);
        }

        $this.css('background-image', 'url(http://img.youtube.com/vi/'+video_id+'/maxresdefault.jpg)');
    });


    // show video container after small delay to avoid glitches
    $(window).on('load', WPHJS.timeoutIt(500, function () {
        $containers.find('> .vc_video-bg').addClass('loaded');
    }));


    // disable video bg on mobile devices
    if(Modernizr.touchevents) {
        $containers.find('> .vc_video-bg').remove();
    }


    // add transparent overlay for maps (to prevent mouse scrolling)
    var title = WPHJS.phpData('map_overlay_title', 'Click here to enable interaction');
    $('.wpb_gmaps_widget').each(function() {

        $(this).append('<div class="gmaps-overlay"/>')
            .find('> .gmaps-overlay')
            .attr('title', title)
            .one('click', function() {
                $(this).hide();
            });

    });

});