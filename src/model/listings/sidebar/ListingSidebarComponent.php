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
use SilverStripe\Core\Config\Config;

/**
 * Class ListingSidebarComponent
 */
class ListingSidebarComponent extends DataObject
{

    private static $default_sort = 'SortOrder';
    private static $db = array(
        "Title" => "Varchar(255)",
        "RemoveTitle" => "Boolean",
        'SortOrder' => 'Int',
    );
    private static $has_one = array(
        "ListingHolder" => "ListingHolder",
    );

    public function getCMSFields()
    {
        $f = parent::getCMSFields();
        $f->removeByName('SortOrder');
        $f->removeByName('ListingHolderID');

        return $f;
    }

    /**
     * Returns a template based on the current ClassName
     * @return {mixed} template to be rendered
     **/
    public function getIncludeTemplate()
    {
        return $this->renderWith($this->ClassName);
    }

    function SidebarComponentManager($method)
    {
        return $this->$method();
    }

    function ListItems()
    {
        $method = Config::inst()->get(get_class($this), 'plural_name');
        return $this->ListingHolder()->$method();
    }


    function NumericDropdown($name)
    {
        return BootstrapDropdownField::create($name)
            ->setSource(self::getNumericValues());
    }

    public function requireDefaultRecords()
    {
        parent::requireDefaultRecords();

        /*
        if ($this->ClassName === 'ListingSidebarComponent') {
            foreach (ClassInfo::subclassesFor('ListingSidebarComponent') as $i => $class) {
                if ($class == 'ListingSidebarComponent') continue;
                $obj = DataObject::get_one($class);
                if (!$obj) {
                    $obj = $class::create();
                    $obj->Title = Config::inst()->get($class, 'singular_name');
                    $obj->write();
                    DB::alteration_message('Sidebar Component created - ' . $obj->Title, 'created');
                }

            }
        }


        */

    }

    /**
     * @param int $x
     * @param int $max
     * @return array
     */
    public static function getNumericValues($x = 0, $max = 6)
    {
        $arrValues = array();
        for ($i = $x; $i <= $max; $i++) {
            $arrValues[$i] = $i;
        }
        return $arrValues;
    }
}
