<?php

/*
use SilverStripe\ORM\DataObject;
*/

class ListingType extends DataObject
{
    /**
     * Human-readable singular name.
     * @var string
     * @config
     */
    private static $singular_name = "Type";

    /**
     * Human-readable plural name
     * @var string
     * @config
     */
    private static $plural_name = "Types";
    private static $defaut_sort = 'SortOrder';
    private static $db = array(
        'Title' => 'Varchar(255)',
        'SortOrder' => 'Int',
    );
    private static $has_one = array(
        'Page' => 'Page',
    );

    function getCMSFields()
    {
        $f = parent::getCMSFields();
        $f->removeByName('SortOrder');

        return $f;
    }


}
