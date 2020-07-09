/*! ===================================
 *  Author: Nazarkin Roman, WPHunters
 *  -----------------------------------
 *  Email(support):
 * 	bbdesign_sp@yahoo.com
 *  ===================================
 */


/**
 * Main variable
 * --------------------------------------------------
 */
'use strict';
var WPHJS = {
    is_safari    : /^((?!chrome|android).)*safari/i.test(navigator.userAgent),
    is_firefox   : navigator.userAgent.toLowerCase().indexOf('firefox') > -1,
    is_chrome    : /Chrome/.test(navigator.userAgent) && /Google Inc/.test(navigator.vendor),
    is_ie10      : navigator.appVersion.indexOf('MSIE 10') !== -1,
    WOWDisabled  : false,
    transitionEnd: 'transitionend webkitTransitionEnd oTransitionEnd otransitionend MSTransitionEnd'
};



/**
 * Functions
 * --------------------------------------------------
 */
WPHJS.phpData = function (key, default_value) {

    if (typeof default_value == 'undefined') {
        default_value = 'translation not found';
    }

    if (typeof WPH_JS != 'undefined' && WPH_JS.hasOwnProperty(key)) {
        return WPH_JS[key];
    }

    return default_value;

};

/**
 * Generates random ID for elements
 *
 * @returns {string}
 */
WPHJS.randomID = function () {
    return Math.random().toString(36).substr(2);
};


/**
 * Generates random integer in a specified range
 *
 * @param min
 * @param max
 * @returns {*}
 */
WPHJS.randomInt = function (min, max) {
    return Math.floor(Math.random() * (max - min + 1)) + min;
};


/**
 * Refresh all Isotope instances on the page
 */
WPHJS.refreshShuffle = function() {
    var $ = jQuery;

    $('.shuffle-grid > .grid, .shuffle-gallery').each(function () {
        var shuffle = $(this).data('shuffle');
        if (!shuffle) { return; }

        shuffle.update();
    });
};


/**
 * Calculates width of scrollbar in present browser
 * @returns {number}
 */
WPHJS.getScrollbarWidth = function() {
    var $ = jQuery;

    var calcHelper = $('<div/>').css({
        position : 'absolute',
        opacity  : 0,
        width    : '100%',
        overflowY: 'scroll'
    })
        .appendTo($('body'));

    var scrollbarWidth = calcHelper[0].offsetWidth - calcHelper[0].clientWidth;
    calcHelper.remove();

    return scrollbarWidth;
};


/**
 * Generates random int.
 * @returns {string}
 */
WPHJS.randomID = function () {
    return Math.random().toString(36).substr(2);
};


/**
 * Refresh all MH instances on the page
 */ 
WPHJS.refreshMatchHeight = function() {
    var $ = jQuery;

    if(typeof $.fn.matchHeight !== 'undefined') {
        $.fn.matchHeight._update();
    }
};


/**
 * Wrap function into timeout call (just syntax sugar)
 */ 
WPHJS.timeoutIt = function(timeout, callback) {

    return function() {
        var $this = jQuery(this);
        setTimeout(function() { callback.call($this) }, timeout);
    }

};


/**
 * Checks if element is visible in current viewport
 * @param el
 * @returns {boolean}
 */
WPHJS.isElementInViewport = function(el) {

    // special bonus for those using jQuery
    if (typeof jQuery === 'function' && el instanceof jQuery) {
        el = el[0];
    }

    var rect = el.getBoundingClientRect();

    return (
        rect.top >= 0 &&
        rect.left >= 0 &&
        rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
        rect.right <= (window.innerWidth || document.documentElement.clientWidth)
    );
};


/**
 * Animated scroll-to element
 *
 * @returns {boolean}
 */
jQuery.fn.__scrollTo = function() {
    var $ = jQuery, target = $(this);

    if (target.length) {
        $('html, body').animate({
            scrollTop: target.offset().top - 100
        }, 1000);
    }

    return target;
};


/**
 * OnePage website function. Smoothscroll & url processing.
 */
jQuery.fn.__initSmoothScroll = function() {
    var $ = jQuery;

    // disable this function for VC containers
    $('.vc_tta-container a').each(function () {
        $(this).attr('data-smscroll-disabled', true);
    });

    // parse urls
    $('a:not([href="#"])', this).each(function() {
        var $this = $(this);

        if($this[0].hash == '') {
            return;
        }

        if(location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
            $this.attr('href', $this[0].hash);
        }
    });

    // attach event
    $('a[href*="#"]:not([href="#"]):not([data-toggle="dropdown"])', this).on('click', function() {
        var $this = $(this);

        if ($this.attr('data-smscroll-disabled')) {
            return true;
        }

        if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
            var target = $(this.hash);
            target = target.length ? target : $('[name="' + this.hash.slice(1) +'"]');

            if (target.length) {
                $this.blur();

                $('html, body').animate({
                    scrollTop: target.offset().top
                }, 750);

                return false;
            }
        }
    });
};


/**
 * Retrieve list of all attributes of element
 * @returns {{}}
 */
jQuery.fn.getAllAttributes = function() {
    var attributes = {};

    if( this.length ) {
        jQuery.each( this[0].attributes, function( index, attr ) {
            attributes[ attr.name ] = attr.value;
        } );
    }

    return attributes;
};


/**
 * Fires callback when user clicks outside element
 */
(function($) {
    var handlersCache = [];

    // setter
    jQuery.fn.__doWhenClickOutside = function(callback, remove_after_exec) {

        // define vars
        var $this = $(this);
        remove_after_exec = (typeof remove_after_exec != 'undefined') ? remove_after_exec : true;

        // add new callback to a storage
        handlersCache.push({
            elem  : $this,
            cb    : callback,
            remove: remove_after_exec
        });

        return $this;
    };

    // trigger
    $(document).on('click.wph-outside', function (e) {

        var $target = $(e.target);
        if (handlersCache.length <= 0) {
            return;
        }

        $(handlersCache).each(function (index, handler) {
            if ($target.closest(handler.elem).length !== 0 || $target.is(handler.elem)) {
                return;
            }

            handler.cb.apply(handler.elem);

            if (handler.remove) {
                handlersCache.splice(index, 1);
            }
        });

    });
})(jQuery);