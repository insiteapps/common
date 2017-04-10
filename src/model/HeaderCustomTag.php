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

use SilverStripe\ORM\DataObject;

/**
 * Class HeaderCustomTag
 */
class HeaderCustomTag extends DataObject
{

    /**
     * Human-readable singular name.
     * @var string
     * @config
     */
    private static $singular_name = 'HeaderCustomTag';

    /**
     * Human-readable plural name
     * @var string
     * @config
     */
    private static $plural_name = 'HeaderCustomTags';

    private static $db = array(
        "Name" => "Varchar(255)",
        "Tag" => "Text",
        'SortOrder' => 'Int',
    );

    private static $has_many = array();

    function getCMSFields()
    {
        $f = parent::getCMSFields();
        $f->removeByName(["SortOrder"]);

        return $f;
    }
}