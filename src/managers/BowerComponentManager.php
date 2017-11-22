<?php

/*
use SilverStripe\Core\Object;
use SilverStripe\View\Requirements;
 */

class BowerComponentManager extends Object
{

    public static function include_code(&$aRequirements)
    {
        self::includeBootstrap($aRequirements);
        $aRequirements["JS"] = array_merge($aRequirements["JS"], [


            INSITE_COMMON_DIR . '/js/AjaxRequestHandler.js',

            INSITE_COMMON_DIR . '/js/InsiteAppsPluginManager.js',
            INSITE_COMMON_DIR . '/js/InsiteAppsManager.js',

        ]);

        $aRequirements["CSS"] = array_merge($aRequirements["CSS"], [


        ]);

    }

    public static function includeBootstrap(&$aRequirements)
    {
        //Requirements::block(THIRDPARTY_DIR . "/jquery/jquery.js");

        $aRequirements["JS"] = array_merge($aRequirements["JS"], [
            //JQUERY_DIR . '/jquery.min.js',
            //BOWER_COMPONENTS_DIR . "/tether/dist/js/tether.js",
            //BOOTSTRAP_DIR . '/bootstrap/js/dist/util.js',
            //BOOTSTRAP_DIR . '/js/bootstrap.js',
        ]);

        $aRequirements["CSS"] = array_merge($aRequirements["CSS"], [
            //BOOTSTRAP_DIR . "/css/bootstrap.min.css",
            //BOOTSTRAP_DIR . "/css/bootstrap-theme.min.css",

        ]);

        //

    }


    public static function includeChosen(&$aRequirements)
    {
        $aRequirements["JS"] = array_merge($aRequirements["JS"], [
            CHOSEN_DIR . '/chosen.jquery.min.js',
            INSITE_COMMON_DIR . '/js/chosen.jquery_init.js',
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
