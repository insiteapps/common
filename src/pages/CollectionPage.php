<?php

/**
 *
 * @copyright (c) 2017 Insite Apps - http://www.insiteapps.co.za
 * @package       insiteapps
 * @author        Patrick Chitovoro  <patrick@insiteapps.co.za>
 * All rights reserved. No warranty, explicit or implicit, provided.
 *
 * NOTICE:  All information contained herein is, and remains the property of Insite Apps and its suppliers,  if any.
 * The intellectual and technical concepts contained herein are proprietary to Insite Apps and its suppliers and may be
 * covered by South African. and Foreign Patents, patents in process, and are protected by trade secret or copyright
 * laws. Dissemination of this information or reproduction of this material is strictly forbidden unless prior written
 * permission is obtained from Insite Apps. Proprietary and confidential. There is no freedom to use, share or change
 * this file.
 *
 *
 */
class CollectionPage extends Page
{
    private static $empty_string = "-Select-";

    private static $many_many = array(
        "Collections" => "ListingCollection",
    );

    private static $allowed_children = array();

    private static $default_child = "";

    public function canCreate()
    {
        return !DataObject::get_one($this->class);
    }

    public static function find_link($action = false)
    {
        if (!$page = DataObject::get_one(get_class())) {
            user_error(sprintf('No %s found. Please create one in the CMS!', get_class()), E_USER_ERROR);
        }

        return $page->Link($action);
    }

    function Children()
    {
        $aChildren = ArrayList::create();
        $oCollections = ListingCollection::get();
        foreach ( $oCollections as $oCollection ) {
            $aData = array(
                "Title" => $oCollection->Title,
                "Link"  => $oCollection->Link(),
            );
        }

        return $aChildren;
    }

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $oListingCollection = ListingCollection::get();
        $oListingCollectionMap = $oListingCollection ? $oListingCollection->map()->toArray() : array();
        asort($oListingTypeMap);
        $fields->addFieldToTab('Root.Main', ListboxField::create('Collections', 'Please select your Collections')
            ->setMultiple(true)
            ->setSource($oListingCollectionMap)
            ->setAttribute('data-placeholder', 'Collections'));


        return $fields;
    }

}

class CollectionPage_Controller extends Page_Controller
{
    private static $allowed_actions = array('collections',);

    function collections()
    {
        $oCollection = DataObject::get_one("ListingCollection", sprintf("URLSegment = '%s'", $this->urlParamsID()));
        if ($oCollection) {
            $title = $oCollection->Title;
            $aData = array(
                "Title"           => $title,
                "CustomPageTitle" => $this->Title . " - " . $title . " <small>Collection</small>",
                "ProductList"     => $oCollection->Products(),
            );

            return $this->customise($aData)->renderWith(["Product_collection", "Page"]);

        }

        return $this->httpError('404');
    }

}
