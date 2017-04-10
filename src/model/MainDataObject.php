<?php

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
        $f->addFieldToTab("Root.Main", HtmlEditorField::create("Content")->setRows(15));


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
