/*
 *
 * @copyright (c) 2017 Insite Apps - http://www.insiteapps.co.za
 * @package insiteapps
 * @author Patrick Chitovoro  <patrick@insiteapps.co.za>
 * All rights reserved. No warranty, explicit or implicit, provided.
 *
 * NOTICE:  All information contained herein is, and remains the property of Insite Apps and its suppliers,  if any.
 * The intellectual and technical concepts contained herein are proprietary to Insite Apps and its suppliers and may be covered by South African. and Foreign Patents, patents in process, and are protected by trade secret or copyright laws.
 * Dissemination of this information or reproduction of this material is strictly forbidden unless prior written permission is obtained from Insite Apps.
 * Proprietary and confidential.
 * There is no freedom to use, share or change this file.
 *
 *
 */

var PlugInManager = function () {
    return {
        initSpectrum: function () {

            $("input.spectrum-colour,input.colorpicker").spectrum({
                clickoutFiresChange: true,
                showInitial: true,
                flat: false,
                showSelectionPalette: true,
                showInput: true,
                allowEmpty: true,
                showAlpha: true,
                preferredFormat: "rgb",
                showPalette: true,
                palette: [
                    ["rgb(0, 0, 0)", "rgb(67, 67, 67)", "rgb(102, 102, 102)",
                        "rgb(204, 204, 204)", "rgb(217, 217, 217)", "rgb(255, 255, 255)"],
                    ["rgb(152, 0, 0)", "rgb(255, 0, 0)", "rgb(255, 153, 0)", "rgb(255, 255, 0)", "rgb(0, 255, 0)",
                        "rgb(0, 255, 255)", "rgb(74, 134, 232)", "rgb(0, 0, 255)", "rgb(153, 0, 255)", "rgb(255, 0, 255)"],
                    ["rgb(230, 184, 175)", "rgb(244, 204, 204)", "rgb(252, 229, 205)", "rgb(255, 242, 204)", "rgb(217, 234, 211)",
                        "rgb(208, 224, 227)", "rgb(201, 218, 248)", "rgb(207, 226, 243)", "rgb(217, 210, 233)", "rgb(234, 209, 220)",
                        "rgb(221, 126, 107)", "rgb(234, 153, 153)", "rgb(249, 203, 156)", "rgb(255, 229, 153)", "rgb(182, 215, 168)",
                        "rgb(162, 196, 201)", "rgb(164, 194, 244)", "rgb(159, 197, 232)", "rgb(180, 167, 214)", "rgb(213, 166, 189)",
                        "rgb(204, 65, 37)", "rgb(224, 102, 102)", "rgb(246, 178, 107)", "rgb(255, 217, 102)", "rgb(147, 196, 125)",
                        "rgb(118, 165, 175)", "rgb(109, 158, 235)", "rgb(111, 168, 220)", "rgb(142, 124, 195)", "rgb(194, 123, 160)",
                        "rgb(166, 28, 0)", "rgb(204, 0, 0)", "rgb(230, 145, 56)", "rgb(241, 194, 50)", "rgb(106, 168, 79)",
                        "rgb(69, 129, 142)", "rgb(60, 120, 216)", "rgb(61, 133, 198)", "rgb(103, 78, 167)", "rgb(166, 77, 121)",
                        "rgb(91, 15, 0)", "rgb(102, 0, 0)", "rgb(120, 63, 4)", "rgb(127, 96, 0)", "rgb(39, 78, 19)",
                        "rgb(12, 52, 61)", "rgb(28, 69, 135)", "rgb(7, 55, 99)", "rgb(32, 18, 77)", "rgb(76, 17, 48)"]
                ]

            });
        }
    }
}();
var NotyManager = function () {
    return {
        init: function (text, type, title, timeout) {

            return n = new Noty({
                text: text,
                type: type ? type : 'success',
                title: title ? title : 'Success!',
                theme: 'metroui',
                maxVisible: 3,
                timeout: timeout ? timeout : 4000,
                killer: true,
                layout: 'bottomRight'
            }).show();

        },
        metroui: function (text, type, title) {
            this.init(text, type, title);
        },
        init_static: function (text, type, title) {
            return n = new Noty({
                text: text,
                type: type ? type : 'success',
                title: title ? title : 'Success!',
                theme: 'metroui',
                maxVisible: 1,
                killer: true,
                layout: 'bottomRight'
            }).show();
        }
    }
}();
var _aj = function () {
    return {
        i: function (u, d, s, e, t, dt) {
            $.ajax({
                url: u,
                type: t ? t : 'post',
                dataType: dt ? dt : 'json',
                data: d,
                success: s,
                error: e
            });
        },
        errorHandler: function () {
            alert('Sorry there has been an error');
        }
    }


    var s = function (data) {

    };

    var e = function () {
        alert('Sorry there has been an error');
    };
}();

(function ($) {

    $.fn.extend({
        getColumnsWidth: function () {

            // append an empty <span>
            $this = $(this).append('<span></span>');

            // grab left position
            var pos = $this.find('span:last-of-type').position().left;

            // get prefix for css3
            var prefix;
            if (jQuery.browser.webkit) prefix = '-webkit-';
            else if (jQuery.browser.opera) prefix = '-o-';
            else if (jQuery.browser.mozilla) prefix = '-moz-';
            else if (jQuery.browser.msie) prefix = '-ms-';

            // add the width of the final column
            pos += parseInt($this.css(prefix + 'column-width'), 10);

            // subtract one column gap (not sure why this is necessary?)
            pos -= parseInt($this.css(prefix + 'column-gap'), 10);

            // remove empty <span>
            $(this).find('span:last-of-type').remove();

            // return position
            return pos;

        }
    });









    /*
     * debouncedresize: special jQuery event that happens once after a window resize
     *
     * latest version and complete README available on Github:
     * https://github.com/louisremi/jquery-smartresize
     *
     * Copyright 2012 @louis_remi
     * Licensed under the MIT license.
     *
     * This saved you an hour of work?
     * Send me music http://www.amazon.co.uk/wishlist/HNTU0468LQON
     */


    var $event = $.event,
        $special,
        resizeTimeout;

    $special = $event.special.debouncedresize = {
        setup: function () {
            $(this).on("resize", $special.handler);
        },
        teardown: function () {
            $(this).off("resize", $special.handler);
        },
        handler: function (event, execAsap) {
            // Save the context
            var context = this,
                args = arguments,
                dispatch = function () {
                    // set correct event type
                    event.type = "debouncedresize";
                    $event.dispatch.apply(context, args);
                };

            if (resizeTimeout) {
                clearTimeout(resizeTimeout);
            }

            execAsap ?
                dispatch() :
                resizeTimeout = setTimeout(dispatch, $special.threshold);
        },
        threshold: 150
    };



    var Loader = (function () {

        function init() {

            var $svg = $("#loaderSvg"),
                svg,
                text = '',
                letter = $('body').data('first-letter').toString().toLowerCase();

            svg = Snap("#loaderSvg");
            text = svg.text('50%', '20%', letter).attr({
                'text-anchor': 'middle',
                'id': 'letter',
                'font-size': '180',
                'font-weight': 'bold',
                'dy': '150'
            });

            var patterns = [],
                index = 0;

            $.each(loaderRandomImages, function (i, src) {
                var img = svg.image(src, -75, 0, 500, 300).toPattern();

                img.attr({
                    width: 500,
                    height: 300,
                    viewBox: '0 0 500 300'
                });
                patterns.push(img);
            });

            TweenMax.to($svg, .3, {
                opacity: 1,
                ease: Power3.easeOut
            });

            setInterval(function () {
                if (index == patterns.length) {
                    index = 0;
                }
                requestAnimationFrame(function () {
                    text.attr('fill', patterns[index]);
                });
                index = index + 1;
            }, 500);
        }

        return {
            init: init
        }

    })();


    Pace.on('done', function () {

        $('.site-content__mask').animate({
            percent: 1

        }, {
            step: function (a, p, c) {

            },
            progress: function (a, p, c) {
                var opcty = 1 - ( 1 * p ).toFixed(1);
                $('.site-content__mask').css('background', 'rgba(0, 0, 0, ' + opcty + ')');
            },
            duration: 1000,
            complete: function () {
                $('.site-content__mask').remove();
            }

        });

    });

})(jQuery);
function InsiteAppsPluginManager() {
    var currentTallest = 0, currentRowStart = 0, rowDivs = new Array(), $el, topPosition = 0;

    var window_width = $(window).width();

    this.setSameSize = function (element) {
        $(element).each(function () {

            $el = $(this);
            topPosition = $el.position().top;

            if (currentRowStart !== topPosition) {

                // we just came to a new row.  Set all the heights on the completed row
                for (var currentDiv = 0; currentDiv < rowDivs.length; currentDiv++) {
                    rowDivs[currentDiv].css({'height': currentTallest});
                }

                // set the variables for the new row
                rowDivs.length = 0; // empty the array
                currentRowStart = topPosition;
                currentTallest = $el.height();
                rowDivs.push($el);

            } else {

                // another div on the current row.  Add it to the list and check if it's taller
                rowDivs.push($el);
                currentTallest = (currentTallest < $el.height()) ? ($el.height()) : (currentTallest);

            }
            // do the last row
            for (currentDiv = 0; currentDiv < rowDivs.length; currentDiv++) {
                rowDivs[currentDiv].css({'height': currentTallest});
            }

        });
    }
    this.initiateIsotope = function ($container) {
        var SameHeightBoxes = $('.SameHeightBoxes');
        var Manager = this;
        if ($container.length) {
            var $resize = $container.attr('id');
            $container.isotope();
            var $grid = $container.imagesLoaded(function () {
                $grid.isotope({
                    itemSelector: '.isotopeitem',
                    percentPosition: true
                });
                if ($(window).width() > 767) {
                    Manager.setSameSize('.SameHeightBoxes');
                } else {
                    SameHeightBoxes.height("auto");
                }

            });

            $container.imagesLoaded(function () {
                $container.isotope('layout');

            });
        }
    }

    this.ResizeElements = function (sameAge) {
        var highest = null;
        //var sameAge = $(element);
        sameAge.each(function () {  //find the height of your highest link
            var h = $(this).height();
            if (h > highest) {
                highest = $(this).height();
            }
        });
        if ($(window).width() < 767) {
            highest = "auto";
        }

        //console.log($(window).width());
        sameAge.height(highest);  //set all your links to that height.


    }
    this.heightsEqualizer = function (selector) {
        var elements = document.querySelectorAll(selector),
            max_height = 0, len = 0, i, h;
        if ((elements) && (elements.length > 0)) {
            len = elements.length;
            for (i = 0; i < len; i++) { // get max height
                elements[i].style.height = ''; // reset height attr
                if (elements[i].clientHeight > max_height) {
                    max_height = elements[i].clientHeight;
                }
            }
            for (i = 0; i < len; i++) { // set max height to all elements

                console.log(window_width);

                if (window_width < 767) {
                    h = 'auto'
                } else {
                    h = max_height + 'px';
                }
                elements[i].style.height = h;
            }
        }
    }

}

/**
 * Shared variables
 */


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

function isInt(n) {
    return n % 1 === 0;
}

var ua = navigator.userAgent.toLowerCase(),
    platform = navigator.platform.toLowerCase(),
    $window = $(window),
    $document = $(document),
    $html,
    $body,

    android_ancient = (ua.indexOf('mozilla/5.0') !== -1 && ua.indexOf('android') !== -1 && ua.indexOf('applewebKit') !== -1) && ua.indexOf('chrome') === -1,
    apple = ua.match(/(iPad|iPhone|iPod|Macintosh)/i),
    webkit = ua.indexOf('webkit') != -1,


    is_small = $('.js-nav-trigger').is(':visible'),

    windowHeight = $window.height(),
    windowWidth = $window.width(),
    documentHeight = $document.height(),
    orientation = windowWidth > windowHeight ? 'portrait' : 'landscape';
window.$html = $('html'), window.$body = $('body');

(function ($) {
    // "use strict";
    /*global jQuery, document, window*/

    $(document).ready(function () {
        InsiteAppsManager.init();
        InsiteAppsManager.browserSize();
        InsiteAppsManager.platformDetect();
        InsiteAppsManager.browserSupport();
    });

    $window.on('resize', function () {
        InsiteAppsManager.browserSize();

    });
}(jQuery));


var debug = function (elem) {
    return console.log(elem);
}

var InsiteAppsManager = function () {
    var self = this;


    return {
        init: function () {


            //$.proxy(self.init, self);
            // self.browserSize();
            // self.browserSupport();
        },
        getParameterByName: function (name) {
            var match = RegExp('[?&]' + name + '=([^&]*)').exec(window.location.search);
            return match && decodeURIComponent(match[1].replace(/\+/g, ' '));
        }
    }

}();
InsiteAppsManager.init = function () {

};

InsiteAppsManager.platformDetect = function () {
    var navUA = navigator.userAgent.toLowerCase(),
        navPlat = navigator.platform.toLowerCase(),
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
        safari = ua.indexOf('safari') != -1 && ua.indexOf('chrome') == -1;

    window.isiPhone = navPlat.indexOf("iphone");
    window.isiPod = navPlat.indexOf("ipod");
    window.isAndroidPhone = navPlat.indexOf("android");
    window.isSafari = navUA.indexOf('safari') != -1 && navUA.indexOf('chrome') == -1;
    window.isIE = typeof(is_ie) !== "undefined" || (!(window.ActiveXObject) && "ActiveXObject" in window);
    window.isiele10 = ua.match(/msie (9|([1-9][0-9]))/i),
        ieMobile = ua.match(/Windows Phone/i) ? true : false;
    window.iOS = getIOSVersion();
    window.android = getAndroidVersion();
    window.isMac = navigator.platform.toUpperCase().indexOf('MAC') >= 0;
    window.isWindows = navigator.platform.toUpperCase().indexOf('WIN') !== -1;

    // Platform Detection
    function getIOSVersion(ua) {
        ua = ua || navigator.userAgent;
        return parseFloat(
                ('' + (/CPU.*OS ([0-9_]{1,5})|(CPU like).*AppleWebKit.*Mobile/i.exec(ua) || [0, ''])[1])
                    .replace('undefined', '3_2').replace('_', '.').replace('_', '')
            ) || false;
    }

    function getAndroidVersion(ua) {
        var matches;
        ua = ua || navigator.userAgent;
        matches = ua.match(/[A|a]ndroid\s([0-9\.]*)/);
        return matches ? matches[1] : false;
    }

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
