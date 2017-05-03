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
        'Title'      => 'Varchar(255)',
        'SortOrder'  => 'Int',
        'URLSegment' => 'Varchar(255)',
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


    function Link()
    {
        return Controller::join_links(ProductCollectionHolder::find_link(), $this->getItemURLSegment(), '/');
    }

    public function onBeforeWrite()
    {

        parent::onBeforeWrite();

        if ($this->isChanged($this->Title)) {
            $this->GenerateURLSegment();
        }


    }

    /**
     * @return string
     */
    function GenerateURLSegment()
    {
        $siteTree = Page::create();
        if ($this->Title) {
            $this->Title = trim($this->Title);
            $this->URLSegment = $siteTree->GenerateURLSegment($this->Title);
            $object = DataObject::get_one($this->ClassName, "URLSegment='" . $this->URLSegment . "' AND ID !=" . $this->ID);
            if ($object)
                $this->URLSegment = $this->URLSegment . '-' . $this->ID;
        } else {
            $this->URLSegment = $siteTree->GenerateURLSegment($this->ClassName . '-' . $this->ID);
        }
        $this->write();

        return $this->URLSegment;
    }

    /**
     * @return mixed|string
     */
    function getItemURLSegment()
    {
        if ($this->URLSegment) {
            return $this->URLSegment;
        }

        return $this->GenerateURLSegment();
    }

}
