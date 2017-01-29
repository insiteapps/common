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

use SilverStripe\ORM\DataExtension;
use SilverStripe\Forms\CheckboxField;
use SilverStripe\Forms\TreeDropdownField;
use SilverStripe\Forms\FieldList;

class GroupDecorator extends DataExtension
{

    static $db = array(
        "GoToAdmin" => "Boolean",
    );
    static $has_one = array(
        "LinkPage" => "SiteTree"
    );

    public function updateCMSFields(FieldList $fields)
    {
        $fields->addFieldToTab("Root.Members", new CheckboxField("GoToAdmin", " Go to Admin area"), 'Members');
        $fields->addFieldToTab("Root.Members", new TreeDropdownField("LinkPageID", "Or select a Page to redirect to", "SiteTree"), 'Members');
    }

}
