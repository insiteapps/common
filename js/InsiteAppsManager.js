(function ($) {
    "use strict";
    /*global jQuery, document, window*/

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
        orientation = windowWidth > windowHeight ? 'portrait' : 'landscape',


        jQuery
    (document).ready(function () {
        var InsiteAppsManagerInstance = new InsiteAppsManager();
    });

    var InsiteAppsManager = function () {
        var self = this;
        $.proxy(self.init, self);
    };

    ThemeManager.prototype.init = function () {
        self.browserSize();
        self.browserSupport();
    };

    ThemeManager.prototype.browserSize = function () {
        window.windowHeight = $window.height();
        window.windowWidth = $window.width();
        window.documentHeight = $document.height();
        window.orientation = windowWidth > windowHeight ? 'portrait' : 'landscape';
    }
    ThemeManager.prototype.browserSupport = function () {
        $.support.touch = Modernizr.touchevents;
        $.support.svg = (document.implementation.hasFeature("http://www.w3.org/TR/SVG11/feature#BasicStructure", "1.1")) ? true : false;
        $.support.transform = getSupportedTransform();

        $html
            .addClass($.support.touch ? 'touch' : 'no-touch')
            .addClass($.support.svg ? 'svg' : 'no-svg')
            .addClass(!!$.support.transform ? 'transform' : 'no-transform');
    }

}(jQuery));
