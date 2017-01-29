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
use SilverStripe\Forms\HTMLEditor\HTMLEditorField;
use SilverStripe\ORM\DB;

/**
 * Class MainDataObject
 * @author Patrick Chitovoro
 * @copyright (c) 2017 ChitoSystems
 */
class MainDataObject extends DataObject
{


    private static $default_sort = 'SortOrder';
    private static $db = array(
        'Name' => 'Varchar(255)',
        'Content' => 'HTMLText',
        'SortOrder' => 'Int',
    );
    private static $has_one = array();
    private static $has_many = array();

    public function getCMSFields()
    {
        $f = parent::getCMSFields();
        $f->removeByName(array("SortOrder", "URLSegment"));
        $f->addFieldToTab("Root.Main", HTMLEditorField::create("Content")->setRows(15));


        return $f;
    }

    private static $summary_fields = array(
        'Name',
    );

    /**
     * @param $tbl
     * @param $joinTbl
     * @return SS_Query
     */
    function ItemIds($tbl, $joinTbl)
    {
        $formTable = sprintf("%s_Categories", $tbl);
        $whereId = sprintf("%sCategoryID", $joinTbl);
        $sql = "SELECT * FROM $formTable WHERE $whereId = {$this->ID}";
        return DB::query($sql);
    }
}
