<?php

/*
use SilverStripe\ORM\DataObject;
 */

class SecureImageResource extends DataObject
{

    private static $default_sort = 'SortOrder';

    private static $db = array(
        'Name'        => 'Varchar(255)',
        'Description' => 'Text',
        'SortOrder'   => 'Int',
    );

    private static $has_one = array(
        'Image' => 'FittedImage',
        'Page'  => 'Page',
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
        'Description',
    );

    function getThumbnail()
    {
        $image = $this->Image();
        if ($image && $image->ID) {
            return $image->CMSThumbnail();
        }
    }

}
