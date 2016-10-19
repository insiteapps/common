<?php

class ListingHolder extends Page
{

    private static $allowed_children = array("ListingPage");
    private static $default_child = "ListingPage";
    private static $db = array();

    private static $has_one = array();
    private static $has_many = array();

    private static $defaults = array();

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();
        return $fields;
    }
}

class ListingHolder_Controller extends Page_Controller
{

    public function init()
    {

        Requirements::css(INSITE_COMMON_DIR . '/css/ListItemsContainer.css');

        parent:: init();
        Requirements::javascript(ISOTOPE_DIR . '/dist/isotope.pkgd.min.js');
        Requirements::javascript(INSITE_COMMON_DIR . '/js/ListingManager.js');
        Requirements::javascript(INSITE_COMMON_DIR . '/js/imagesloaded.pkgd.min.js');
        Requirements::javascript(INSITE_COMMON_DIR . '/js/PluginManager.js');
        Requirements::javascript(INSITE_COMMON_DIR . "/js/js.cookie.js");


    }


}
