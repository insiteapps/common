<?php

class InsiteCommonListingExtension extends DataExtension
{


    private static $many_many = array();

    public function updateCMSFields(FieldList $fields)
    {
        //$setup = PageSetupBar::create('Setup', $this->getPageSetupFields());
        //$fields->insertBefore($setup, 'Root');
        //$fields->fieldByName('Root')->setTemplate('PageSetupBar');

    }

    function LayoutView()
    {
        $DefaultView = $this->View;
        $LayoutView = Cookie::get('LayoutView_' . $this->ID);
        if ($LayoutView) {
            return $LayoutView;
        }
        Cookie::set('LayoutView_' . $this->ID, $DefaultView);
        return $DefaultView ? $DefaultView : "List";
    }
}

class InsiteCommonListingControllerExtension extends DataExtension
{

    public function onAfterInit()
    {
        Requirements::css(INSITE_COMMON_DIR . '/css/ListItemsContainer.css');
        Requirements::javascript(ISOTOPE_DIR . '/dist/isotope.pkgd.min.js');
        Requirements::javascript(INSITE_COMMON_DIR . '/js/ListingManager.js');
        Requirements::javascript(INSITE_COMMON_DIR . '/js/imagesloaded.pkgd.min.js');
        Requirements::javascript(INSITE_COMMON_DIR . '/js/PluginManager.js');
        Requirements::javascript(INSITE_COMMON_DIR . "/js/js.cookie.js");


    }


}
