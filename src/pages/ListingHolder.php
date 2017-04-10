<?php
/**
 *
 * Copyright (c) 2017 Insite Apps - http://www.insiteapps.co.za
 * All rights reserved.
 * @package insiteapps
 * @author Patrick Chitovoro  <patrick@insiteapps.co.za>
 * Redistribution and use in source and binary forms, with or without modification, are NOT permitted at all.
 * There is no freedom to share or change it this file.
 *
 *
 */

use SilverStripe\View\Requirements;
use SilverStripe\ORM\PaginatedList;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\GridField\GridFieldConfig_RecordEditor;
use SilverStripe\GridFieldExtensions\GridFieldAddNewMultiClass;

class ListingHolder extends Page
{

    //private static $allowed_children = array("ListingPage");
    private static $default_child = "ListingPage";
    private static $db = array();

    private static $has_one = array();
    private static $has_many = array(
        "Areas" => "ListingArea",
        "Collections" => "ListingCollection",
        "Locations" => "ListingLocation",
        "Types" => "ListingType",
        "FilterComponents" => "ListingSidebarComponent"
    );
    private static $many_many = array();

    private static $defaults = array();

    public function getCMSFields()
    {
        $f = parent::getCMSFields();

        $gridFieldConfig = GridFieldConfig_RecordEditor::create();
        $gridFieldConfig->addComponent(new GridFieldAddNewMultiClass());
        $gridFieldConfig->removeComponentsByType('GridFieldAddNewButton');
       // $gridFieldConfig->addComponent(new GridFieldSortableRows('SortOrder'));

        $f->addFieldsToTab('Root.Manager', [
            //new GridField('FilterComponents', 'FilterComponents', $this->FilterComponents(), $gridFieldConfig),
            GridField::create('Areas', 'Areas', $this->Areas(), GridFieldConfig_RecordEditor::create()),
            GridField::create('Locations', 'Locations', $this->Locations(), GridFieldConfig_RecordEditor::create()),
            new GridField('Types', 'Types', $this->Types(), GridFieldConfig_RecordEditor::create()),
            new GridField('Collections', 'Collections', $this->Collections(), GridFieldConfig_RecordEditor::create())
        ]);

        return $f;
    }

    public function requireDefaultRecords()
    {
        parent::requireDefaultRecords();

    }

    function ActiveListings($limit = 50)
    {
        $oPages = $this->Children();
        $oListings = new PaginatedList($oPages);
        $oListings->setPageLength($limit);
        return $oListings;
    }

    function MakeSameHeight()
    {
        if ($this->owner->LayoutView() === 'grid' && $this->owner->SameHeightBoxes) {
            return "SameHeightBoxes";
        }
        return false;

    }
}

class ListingHolderController extends PageController
{

    public function init()
    {

        Requirements::css(INSITE_COMMON_DIR . '/css/ListItemsContainer.css');

        parent:: init();
        Requirements::javascript(ISOTOPE_DIR . '/dist/isotope.pkgd.min.js');
        Requirements::javascript(INSITE_COMMON_DIR . '/js/ListingManager.js');
        Requirements::javascript(INSITE_COMMON_DIR . '/js/imagesloaded.pkgd.min.js');
        Requirements::javascript(INSITE_COMMON_DIR . '/js/PluginManager.js');


    }


}