/**
 * Shared variables
 */
var ua = navigator.userAgent.toLowerCase(),
    platform = navigator.platform.toLowerCase(),
    $window = $(window),
    $document = $(document),
    $html,
    $body,

    android_ancient = (ua.indexOf('mozilla/5.0') !== -1 && ua.indexOf('android') !== -1 && ua.indexOf('applewebKit') !== -1) && ua.indexOf('chrome') === -1,
    apple = ua.match(/(iPad|iPhone|iPod|Macintosh)/i),
    webkit = ua.indexOf('webkit') != -1,

    isiPhone = false,
    isiPod = false,
    isAndroidPhone = false,
    android = false,
    iOS = false,
    isIE = false,
    ieMobile = false,
    isSafari = false,
    isMac = false,
    isWindows = false,
    isiele10 = false,

    firefox = ua.indexOf('gecko') != -1,
    safari = ua.indexOf('safari') != -1 && ua.indexOf('chrome') == -1,

    is_small = $('.js-nav-trigger').is(':visible'),

    windowHeight = $window.height(),
    windowWidth = $window.width(),
    documentHeight = $document.height(),
    orientation = windowWidth > windowHeight ? 'portrait' : 'landscape';
window.$html = $('html'), window.$body = $('body');

(function ($) {
    // "use strict";
    /*global jQuery, document, window*/

    jQuery(document).ready(function () {
        var InsiteAppsManagerInstance = new InsiteAppsManager();
    });

    $window.on('resize', function () {
        var InsiteAppsManagerInstance = new InsiteAppsManager();

    });
    var InsiteAppsManager = function () {
        var self = this;
        $.proxy(self.init, self);
        self.init();
        self.browserSize();
        self.browserSupport();

    };
    InsiteAppsManager.prototype.init = function () {

    };

    InsiteAppsManager.prototype.browserSize = function () {
        window.windowHeight = $window.height();
        window.windowWidth = $window.width();
        window.documentHeight = $document.height();
        window.orientation = windowWidth > windowHeight ? 'portrait' : 'landscape';
    }
    InsiteAppsManager.prototype.browserSupport = function () {
        $.support.touch = Modernizr.touchevents;
        $.support.svg = (document.implementation.hasFeature("http://www.w3.org/TR/SVG11/feature#BasicStructure", "1.1")) ? true : false;
        $.support.transform = getSupportedTransform();

        $html
            .addClass($.support.touch ? 'touch' : 'no-touch')
            .addClass($.support.svg ? 'svg' : 'no-svg')
            .addClass(!!$.support.transform ? 'transform' : 'no-transform');
    }
    function getSupportedTransform() {
        var prefixes = ['transform', 'WebkitTransform', 'MozTransform', 'OTransform', 'msTransform'];
        for (var i = 0; i < prefixes.length; i++) {
            if (document.createElement('div').style[prefixes[i]] !== undefined) {
                return prefixes[i];
            }
        }
        return false;
    }
    /*

     var Placeholder = (function() {
     var $items;

     function update($container, src) {

     var $container = $container || $('body');

     $items = $container.find('.insite-js-placeholder');

     $items.each(function(i, item) {
     var $item = $(item);
     $item.data('actualHeight', $item.height());
     });

     $items.each(function(i, item) {
     var $item = $(item).data('loaded', false),
     width = $item.data('width'),
     height = $item.data('height'),
     newHeight = $item.height(),
     newWidth = Math.round(newHeight * $item.data('width') / $item.data('height')),
     $image = $(document.createElement('img')).css('opacity', 0);

     $item.toggleClass('is--portrait', height > width);

     $item.width(newWidth);
     $item.data('image', $image);
     });

     $(window).on('DOMContentLoaded load resize scroll djaxLoad', bindImageLoad);
     $('.portfolio-grid, .site-content').on('scroll', bindImageLoad);

     bindImageLoad();

     $(window).on('djaxClick', function() {
     $(window).off('DOMContentLoaded load resize scroll djaxLoad', bindImageLoad);
     $('.portfolio--grid, .site-content').off('scroll', bindImageLoad);
     });
     }



     function onResize() {
     $items.each(function(i, item) {
     var $item = $(item),
     width = $item.data('width'),
     height = $item.data('height'),
     newHeight = $item.height(),
     newWidth = Math.round(newHeight * width / height);

     $item.data('newWidth', newWidth);
     });

     $items.each(function(i, item) {
     var $item = $(item);
     $item.width($item.data('newWidth'));
     });
     }

     return {
     update: update,
     resize: onResize
     }

     })();
     */


}(jQuery));
