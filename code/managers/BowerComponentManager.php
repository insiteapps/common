<?php

/**
 * Class BowerComponentManager
 */
class BowerComponentManager extends Object
{

    public static function include_code(&$aRequirements)
    {
        self::includeBootstrap($aRequirements);
        $aRequirements["JS"] = array_merge($aRequirements["JS"], [
            BOWER_COMPONENTS_DIR . '/jquery-migrate/index.js',
            JQUERY_UI_DIR . '/jquery-ui.min.js',
            JQUERY_FORM_DIR . '/jquery.form.js',
            INSITE_COMMON_DIR . "/js/js.cookie.js",
            UNDERSCORE_DIR . '/underscore.js',
            MOMENT_DIR . '/moment.js',
            MASONRY_DIR . '/dist/masonry.pkgd.min.js',
            ISOTOPE_DIR . '/dist/isotope.pkgd.min.js',

            BOWER_COMPONENTS_DIR . '/wow/dist/wow.min.js',

            INSITE_COMMON_DIR . '/js/modernizr.min.js',

            BOWER_COMPONENTS_DIR . '/isotope-horizontal/horizontal.js',
            BOWER_COMPONENTS_DIR . '/isotope-masonry-horizontal/masonry-horizontal.js',
            BOWER_COMPONENTS_DIR . '/jquery.lazyload/jquery.lazyload.js',
            BOWER_COMPONENTS_DIR . '/jquery.nicescroll/dist/jquery.nicescroll.min.js',

            BOWER_COMPONENTS_DIR . '/imagesloaded/imagesloaded.pkgd.min.js',
            BOWER_COMPONENTS_DIR . "/owl.carousel/dist/owl.carousel.min.js",
            BOWER_COMPONENTS_DIR . "/rrssb/js/rrssb.js",
            BOWER_COMPONENTS_DIR . "/nouislider/distribute/nouislider.min.js",

            BOWER_COMPONENTS_DIR . "/mixitup/src/jquery.mixitup.js",
            BOWER_COMPONENTS_DIR . "/gsap/src/minified/TweenMax.min.js",
            BOWER_COMPONENTS_DIR . "/gsap/src/minified/utils/Draggable.min.js",
            BOWER_COMPONENTS_DIR . "/gsap/src/minified/jquery.gsap.min.js",
            BOWER_COMPONENTS_DIR . "/gsap/src/minified/plugins/ScrollToPlugin.min.js",
            BOWER_COMPONENTS_DIR . "/gsap/src/minified/plugins/CSSRulePlugin.min.js",
            BOWER_COMPONENTS_DIR . "/gsap/src/minified/plugins/TextPlugin.min.js",
            BOWER_COMPONENTS_DIR . "/gsap/src/minified/plugins/ColorPropsPlugin.min.js",

            BOWER_COMPONENTS_DIR . "/snap.svg/dist/snap.svg-min.js",
            BOWER_COMPONENTS_DIR . "/pace/pace.js",

            BOWER_COMPONENTS_DIR . "/hammerjs/hammer.js",
            BOWER_COMPONENTS_DIR . "/jquery-hammerjs/jquery.hammer.js",
            BOWER_COMPONENTS_DIR . "/jquery-mousewheel/jquery.mousewheel.js",

            BOWER_COMPONENTS_DIR . "/mediaelement/build/mediaelement-and-player.min.js",

            CHOSEN_DIR . '/chosen.jquery.min.js',
            INSITE_COMMON_DIR . '/js/chosen.jquery_init.js',

            INSITE_COMMON_DIR . '/js/InsiteAppsPluginManager.js',
            INSITE_COMMON_DIR . '/js/InsiteAppsManager.js',



        ]);

        $aRequirements["CSS"] = array_merge($aRequirements["CSS"], [
            BOWER_COMPONENTS_DIR . '/font-awesome/css/font-awesome.min.css',
            JQUERY_UI_DIR . '/themes/smoothness/jquery-ui.min.css',
            BOWER_COMPONENTS_DIR . "/animate.css/animate.min.css",
            BOWER_COMPONENTS_DIR . "/owl.carousel/dist/assets/owl.carousel.css",
            BOWER_COMPONENTS_DIR . "/owl.carousel/dist/assets/owl.theme.css",
            BOWER_COMPONENTS_DIR . '/pixeden-stroke-7-icon/pe-icon-7-stroke/dist/pe-icon-7-stroke.min.css',
            CHOSEN_DIR . '/chosen.css',
            BOWER_COMPONENTS_DIR . "/mediaelement/build/mediaelementplayer.min.css",
        ]);

    }

    public static function includeBootstrap(&$aRequirements)
    {
        Requirements::block(THIRDPARTY_DIR . "/jquery/jquery.js");

        $aRequirements["JS"] = array_merge($aRequirements["JS"], [
            JQUERY_DIR . '/jquery.min.js',
            BOWER_COMPONENTS_DIR . "/tether/dist/js/tether.js",
            BOWER_COMPONENTS_DIR . '/bootstrap/js/dist/util.js',
            BOOTSTRAP_DIR . '/js/bootstrap.js'
        ]);

        $aRequirements["CSS"] = array_merge($aRequirements["CSS"], [
            BOOTSTRAP_DIR . "/css/bootstrap.min.css",
            BOOTSTRAP_DIR . "/css/bootstrap-theme.min.css",

        ]);

        //

    }


    public static function includeChosen(&$aRequirements)
    {
        $aRequirements["JS"] = array_merge($aRequirements["JS"], [
            CHOSEN_DIR . '/chosen.jquery.min.js',
            INSITE_COMMON_DIR . '/js/chosen.jquery_init.js'
        ]);

        $aRequirements["CSS"] = array_merge($aRequirements["CSS"], [
            CHOSEN_DIR . '/chosen.css',
        ]);
    }


    public static function includeDataTables()
    {
        Requirements::css(DATA_TABLES_DIR . " / media / css / dataTables . bootstrap . css");
        Requirements::javascript(DATA_TABLES_DIR . " / media / js / jquery . dataTables . min . js");
        Requirements::javascript(DATA_TABLES_DIR . " / media / js / dataTables . bootstrap . js");
    }
}
