/** =============================
 * ListingManager.js
 * * ===========================
 * @author Patrick Chito-voro
 * @copyright 2016 Chito Systems.
 *
 * ============================= */
var colonial = $("#ListingOuterContainer").data('parent');

(function ($) {
    "use strict";
    /*global jQuery, document, window*/
    jQuery(document).ready(function () {
        ListingManager.init();
        //ListingManager.initSliders();
        ListingManager.initializeLiveHandlers();
    });
}(jQuery));


var ListingManager = function () {
    var ControllerURL = 'listing-manager/';
    var ItemsContainer = $("#ListItemsContainer");


    function cleanArray(actual) {
        var newArray = new Array();
        for (var i = 0; i < actual.length; i++) {
            if (actual[i]) {
                newArray.push(actual[i]);
            }
        }
        return newArray;
    }

    function setLayoutView(layoutView) {

        if (typeof layoutView === 'undefined') {
            var layoutView = $("#ListingOuterContainer").data('view');
        } else {
            $("#LayoutView").removeClass('Grid List').addClass(layoutView);
        }
        Cookies.set("LayoutView_" + colonial, layoutView, {expires: 365, path: '/'});
    }

    return {

        init: function () {

        },
        initializeLiveHandlers: function () {

            $(".ListLayout").on('click', 'a', function (e) {
                e.preventDefault();
                var $t = $(this);
                var layout = $t.data('rel');
                $(".ListLayout a").removeClass('active');
                $t.addClass('active');
                setLayoutView(layout);
            });

        },
        initSliders: function () {
            $("#PriceRangeSlider").slider({
                orientation: "horizontal",
                range: true,
                min: 0,
                max: 10000,
                disabled: true,
                values: [0, 9999],
                slide: function (event, ui) {
                    $('#price-value').html("R" + ui.values[0] + " - R" + ui.values[1]);
                    $("#PriceRange").val(+ui.values[0] + ";" + ui.values[1]);
                },
                change: function (event, ui) {
                    setIsotopeHash();
                }
            });

            var PriceRangeSlider_0 = $("#PriceRangeSlider").slider("values", 0);
            var PriceRangeSlider_1 = $("#PriceRangeSlider").slider("values", 1);


            $('#price-value').html("R" + PriceRangeSlider_0 + " - R" + PriceRangeSlider_1);
            $("#PriceRange").val(PriceRangeSlider_0 + ";" + PriceRangeSlider_1);


        },
        isotope: function () {
            var $container = $('.isotopeContainer'), $items = $('.isotopeitem');
            pluginManager.initiateIsotope($container);
           
        },
        loadAjaxStart: function (id, reverse) {
            var AjaxLoading = "<div class=\"AjaxLoading show-overlay\"></div>";
            var $container = $("#" + id);
            $container.append(AjaxLoading);
            var AjaxLoading = $container.find(".AjaxLoading");
            if (reverse) {
                AjaxLoading.remove();
            } else {
                AjaxLoading.show();
            }
        }
    }

}();
