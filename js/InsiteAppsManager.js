/**
 * Shared variables
 */
var ua = navigator.userAgent.toLowerCase(),
    platform = navigator.platform.toLowerCase(),
    $window = $(window),
    $document = $(document),
    $html = $('html'),
    $body = $('body'),

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


(function ($) {
    "use strict";
    /*global jQuery, document, window*/

    jQuery(document).ready(function () {
        var InsiteAppsManagerInstance = new InsiteAppsManager();
    });

    var InsiteAppsManager = function () {
        var self = this;
        $.proxy(self.init, self);
    };

    InsiteAppsManager.prototype.init = function () {
        self.browserSize();
        self.browserSupport();
        self.eventHandlers();
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

    InsiteAppsManager.prototype.eventHandlers = function () {
        $window.on('debouncedresize', onResize);

        $window.on('scroll', onScroll);

        if (Modernizr.touchevents && isFilmstrip()) {
            $('.site-content').on('scroll', onScroll);
        }

        $window.on('mousemove', function (e) {
            latestKnownMouseX = e.clientX;
            latestKnownMouseY = e.clientY;
        });

        $window.on('deviceorientation', function (e) {
            latestDeviceAlpha = e.originalEvent.alpha;
            latestDeviceBeta = e.originalEvent.beta;
            latestDeviceGamma = e.originalEvent.gamma;
        });

        if (windowWidth > 740) {
            bindVertToHorScroll();
        }
    }

}(jQuery));
