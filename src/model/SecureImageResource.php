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
 * Class ListingImageResource
 */
class SecureImageResource extends DataObject
{

    private static $default_sort = 'SortOrder';
    private static $db = array(
        'Name' => 'Varchar(255)',
        'Description' => 'Text',
        'SortOrder' => 'Int',
    );
    private static $has_one = array(
        'Image' => 'FittedImage',
        'Page' => 'Page',
    );

    public function getCMSFields()
    {
        $f = parent::getCMSFields();
        $f->removeByName('SortOrder');
        $f->removeByName('PageID');

        return $f;
    }

    private static $summary_fields = array(
        'Thumbnail',
        'Name',
        'Description'
    );

    function getThumbnail()
    {
        $image = $this->Image();
        if ($image && $image->ID) {
            return $image->CMSThumbnail();
        }
    }

}
