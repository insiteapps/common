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
        InsiteAppsManager.init();
        InsiteAppsManager.browserSize();
        InsiteAppsManager.platformDetect();
        InsiteAppsManager.browserSupport();
    });

    $window.on('resize', function () {
        //var InsiteAppsManagerInstance = new InsiteAppsManager();

    });
}(jQuery));


var InsiteAppsManager = function () {
    var self = this;


    return {
        init: function () {
            //$.proxy(self.init, self);
            // self.browserSize();
            // self.browserSupport();
        }
    }

}();
InsiteAppsManager.init = function () {

};
InsiteAppsManager.platformDetect = function () {
    var navUA = navigator.userAgent.toLowerCase(),
        navPlat = navigator.platform.toLowerCase();

    isiPhone = navPlat.indexOf("iphone");
    isiPod = navPlat.indexOf("ipod");
    isAndroidPhone = navPlat.indexOf("android");
    isSafari = navUA.indexOf('safari') != -1 && navUA.indexOf('chrome') == -1;
    isIE = typeof(is_ie) !== "undefined" || (!(window.ActiveXObject) && "ActiveXObject" in window);
    isiele10 = ua.match(/msie (9|([1-9][0-9]))/i),
        ieMobile = ua.match(/Windows Phone/i) ? true : false;
    iOS = getIOSVersion();
    android = getAndroidVersion();
    isMac = navigator.platform.toUpperCase().indexOf('MAC') >= 0;
    isWindows = navigator.platform.toUpperCase().indexOf('WIN') !== -1;

    if (iOS && iOS < 8) {
        $html.addClass('no-scroll-fx')
    }

    if (isIE) {
        $html.addClass('is--ie');
    }

    if (isiele10) {
        $html.addClass('is--ie-le10');
    }

    if (ieMobile) {
        $html.addClass('is--ie-mobile')
    }

    var browser = {
        isIe: function () {
            return navigator.appVersion.indexOf("MSIE") != -1;
        },
        navigator: navigator.appVersion,
        getVersion: function () {
            var version = 999; // we assume a sane browser
            if (navigator.appVersion.indexOf("MSIE") != -1)
            // bah, IE again, lets downgrade version number
                version = parseFloat(navigator.appVersion.split("MSIE")[1]);
            return version;
        }
    };

    if (browser.isIe() && browser.getVersion() == 9) {
        $('html').addClass('is--ie9');
    }
}
InsiteAppsManager.browserSize = function () {
    window.windowHeight = $window.height();
    window.windowWidth = $window.width();
    window.documentHeight = $document.height();
    window.orientation = windowWidth > windowHeight ? 'portrait' : 'landscape';
}
InsiteAppsManager.browserSupport = function () {
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



