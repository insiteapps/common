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
            JQUERY_UI_DIR . '/jquery-ui.min.js',
            JQUERY_FORM_DIR . '/jquery.form.js',
            INSITE_COMMON_DIR . "/js/js.cookie.js",
            UNDERSCORE_DIR . '/underscore.js',
            MOMENT_DIR . '/moment.js',
            MASONRY_DIR . '/dist/masonry.pkgd.min.js',
            ISOTOPE_DIR . '/dist/isotope.pkgd.min.js',
            BOWER_COMPONENTS_DIR . '/imagesloaded/imagesloaded.pkgd.min.js',
            BOWER_COMPONENTS_DIR . "/owl.carousel/dist/owl.carousel.min.js",
            BOWER_COMPONENTS_DIR . "/rrssb/js/rrssb.js",
            BOWER_COMPONENTS_DIR . "/nouislider/distribute/nouislider.min.js",
            INSITE_COMMON_DIR . '/js/InsiteAppsPluginManager.js'
        ]);

        $aRequirements["CSS"] = array_merge($aRequirements["CSS"], [
            BOWER_COMPONENTS_DIR . '/font-awesome/css/font-awesome.min.css',
            JQUERY_UI_DIR . '/themes/smoothness/jquery-ui.min.css',
            BOWER_COMPONENTS_DIR . "/animate.css/animate.min.css",
            BOWER_COMPONENTS_DIR . "/owl.carousel/dist/assets/owl.carousel.css",
            BOWER_COMPONENTS_DIR . "/owl.carousel/dist/assets/owl.theme.css",
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
