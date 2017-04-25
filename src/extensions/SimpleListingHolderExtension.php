<?php


/*
use SilverStripe\ORM\DataExtension;
use SilverStripe\Control\Cookie;
use SilverStripe\Forms\CompositeField;
use SilverStripe\Forms\DropdownField;
use SilverStripe\Forms\TextField;
use SilverStripe\Forms\NumericField;
use SilverStripe\Forms\CheckboxField;
*/

class SimpleListingHolderExtension extends DataExtension
{

    private static $db = array(
        /*
        "View" => "Enum('list,grid','list')",
        "AllowViewChange" => "Boolean",
        "Columns" => "Int",
        "RemoveReadMore" => "Boolean",
        "SameHeightBoxes" => "Boolean",
        "ReadMoreButtonText" => "Varchar(255)",
        "ImageMaxHeight" => "Varchar(255)",
        "RemoveOverlay" => "Boolean",
        "RemoveChildLinking" => "Boolean",
        "RandomDisplayImage" => "Boolean",
        "ShowListImagesAsCarousel" => "Boolean",
        "ChildrenTemplate" => "Enum('Simple,Boomerang','Boomerang')",
        'ListingsPerPage' => 'Int',
        */
    );

    private static $has_one = array();
    private static $has_many = array();
    private static $many_many = array();

    private static $defaults = array(
        "SidebarPosition" => "left",
        "View" => "grid",
        'ListingsPerPage' => 10,
    );

    public static function getColumnEnums()
    {
        return array("0" => "0", "1" => "1", "2" => "2", "3" => "3", "4" => "4");
    }



    public function requireDefaultRecords()
    {
        parent::requireDefaultRecords();

    }

    function LayoutView()
    {
        $DefaultView = $this->owner->View;
        $LayoutView = Cookie::get('LayoutView_' . $this->owner->ID);
        if ($LayoutView) {
            return $LayoutView;
        }
        Cookie::set('LayoutView_' . $this->owner->ID, $DefaultView);
        return $DefaultView ? $DefaultView : "list";
    }

    /**
     * @return string
     */
    function getReadMoreText()
    {
        return ($txt = $this->owner->ReadMoreButtonText) ? $txt : "More";
    }

    function ColumnsSpanWidth()
    {
        $Columns = ($c = $this->owner->Columns) ? $c : 3;
        return 12 / $Columns;
    }

    function updatePageSetupFields($fields)
    {
        return $fields;
    }

    function MakeSameHeight()
    {
        if ($this->owner->View === 'grid' && $this->owner->SameHeightBoxes) {
            return "SameHeightBoxes";
        }
        return false;

    }
}
