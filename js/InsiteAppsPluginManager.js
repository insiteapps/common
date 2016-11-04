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
