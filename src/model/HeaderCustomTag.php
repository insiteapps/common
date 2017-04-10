<?php

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