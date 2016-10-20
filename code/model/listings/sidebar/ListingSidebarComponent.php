<?php

/**
 * Class ListingSidebarComponent
 */
class ListingSidebarComponent extends DataObject
{

    private static $db = array(
        "Title" => "Varchar(255)",
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
}
