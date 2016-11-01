/** =============================
 * ListingManager.js
 * * ===========================
 * @author Patrick Chito-voro
 * @copyright 2016 Chito Systems.
 *
 * ============================= */
var colonial = $("#ListingOuterContainer").data('parent');
var SameHeightBoxes = $('.SameHeightBoxes');
var $container = $('.isotopeContainer');
(function ($) {
    "use strict";
    /*global jQuery, document, window*/

    $(window).on('resize', function () {
        ListingManager.isotope();
    });


    jQuery(document).ready(function () {
        ListingManager.init();
        ListingManager.isotope();
        ListingManager.initializeLiveHandlers();
    });
}(jQuery));


var ListingManager = function () {
    var ControllerURL = 'listing-manager/';
    var ItemsContainer = $("#ListItemsContainer");

    var StageArea = $('#ListingOuterContainer');
    var insiteAppsPluginManager = new InsiteAppsPluginManager();

    function cleanArray(actual) {
        var newArray = new Array();
        for (var i = 0; i < actual.length; i++) {
            if (actual[i]) {
                newArray.push(actual[i]);
            }
        }
        return newArray;
    }

    function initiateIsotope() {
        //return;
        var $grid = StageArea.imagesLoaded(function () {
            $container.mixitup({

                animation: {
                    enable: false
                },
                listEffects: ['fade','rotateX'] // List of effects ONLY for list mode
            });

        });
    }

    function setLayoutView(layoutView) {

        var ListingOuterContainer = $("#ListingOuterContainer");
        if (typeof layoutView === 'undefined') {
            var layoutView = ListingOuterContainer.data('view');
        }
        ListingOuterContainer
            .data('view', layoutView)
            .removeClass('grid list')
            .addClass(layoutView)

        //$("#LayoutView").removeClass('grid list').addClass(layoutView);
        $(".wp-block.list-item").removeClass('grid list').addClass(layoutView)
       // console.log("LayoutView_" + colonial);

        Cookies.set("LayoutView_" + colonial, layoutView, {expires: 365, path: '/'});
        return initiateIsotope();
    }

    return {

        init: function () {

        },
        initializeLiveHandlers: function () {
            $(document).on('submit', 'form#FilterComponents', function (e) {
                // e.preventDefault();
                var $t = $(this);

                var data = $t.closest('form').serialize();
                console.log(data);


                //  SubmitListingFilter

                // return false;
            });


            $(".ListLayout").on('click', 'a', function (e) {
                e.preventDefault();
                var $t = $(this);
                var layout = $t.data('rel');
                $(".ListLayout a").removeClass('active');
                $t.addClass('active');
                SameHeightBoxes.height("auto");
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
            var self = this;
            var $grid = StageArea.imagesLoaded(function () {
                if(self.OnResize()){
                    $container.mixitup({

                        animation: {
                            enable: false
                        },
                        listEffects: ['fade','rotateX'] // List of effects ONLY for list mode
                    });
                }


            });
           // insiteAppsPluginManager.initiateIsotope($container);

        },
        OnResize: function () {

            var InsiteAppsPluginManagerInstance = new InsiteAppsPluginManager();
            if ($(window).width() > 767) {
                InsiteAppsPluginManagerInstance.setSameSize('.SameHeightBoxes');
            } else {
                SameHeightBoxes.height("auto");
            }
           // console.log("sdsd");
            return true;

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

