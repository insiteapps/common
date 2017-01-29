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
 * Class SecureDocumentLibrary
 */
class SecureDocumentLibrary extends DataObject
{

    private static $default_sort = 'SortOrder';
    private static $db = array(
        'Title' => 'Varchar(255)',
        'Content' => 'HTMLText',
        'SortOrder' => 'Int',
    );
    private static $has_one = array(
        'File' => 'File',
        'MemberAreaPage' => 'MemberAreaPage',
    );

    public function getCMSFields()
    {
        $f = parent::getCMSFields();
        $f->removeByName(['SortOrder', 'MemberAreaPage']);

        return $f;
    }

    private static $summary_fields = array(
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
