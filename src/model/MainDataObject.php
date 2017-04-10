<?php


/*
use SilverStripe\ORM\DataObject;
use SilverStripe\Forms\HTMLEditor\HTMLEditorField;
use SilverStripe\ORM\DB;
 */

class MainDataObject extends DataObject
{


    private static $default_sort = 'SortOrder';

    private static $db = array(
        'Name'      => 'Varchar(255)',
        'Content'   => 'HTMLText',
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
     *
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
