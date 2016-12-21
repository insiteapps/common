<?php

define('INSITE_COMMON_DIR', basename(dirname(__FILE__)));

define('BOWER_COMPONENTS_DIR', INSITE_COMMON_DIR . "/components");
define('BOOTSTRAP_DIR', BOWER_COMPONENTS_DIR . "/bootstrap/dist");
define('JQUERY_DIR', BOWER_COMPONENTS_DIR . "/jquery/dist");
define('JQUERY_FORM_DIR', BOWER_COMPONENTS_DIR . "/jquery-form");
define('UNDERSCORE_DIR', BOWER_COMPONENTS_DIR . "/underscore");
define('CHOSEN_PLUGIN_DIR', BOWER_COMPONENTS_DIR . "/chosen");
define('MOMENT_DIR', BOWER_COMPONENTS_DIR . "/moment");
define('CHOSEN_DIR', BOWER_COMPONENTS_DIR . "/chosen");
define('MASONRY_DIR', BOWER_COMPONENTS_DIR . "/masonry");
define('ISOTOPE_DIR', BOWER_COMPONENTS_DIR . "/isotope");
define('DATA_TABLES_DIR', BOWER_COMPONENTS_DIR . "/datatables");
define('JQUERY_UI_DIR', BOWER_COMPONENTS_DIR . "/jquery-ui");

CMSMenu::remove_menu_item('InsiteModelAdmin');
define('INSITE_COMMON_PLUGING_DIR', INSITE_COMMON_DIR . "/plugins");
