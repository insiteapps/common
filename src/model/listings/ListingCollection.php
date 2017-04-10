<?php

/*
use SilverStripe\ORM\DataObject;
*/

class ListingCollection extends DataObject
{
    /**
     * Human-readable singular name.
     *
     * @var string
     * @config
     */
    private static $singular_name = "Collection";

    /**
     * Human-readable plural name
     *
     * @var string
     * @config
     */
    private static $plural_name = "Collections";

    private static $defaut_sort = 'SortOrder';

    private static $db = array(
        'Title'     => 'Varchar(255)',
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
