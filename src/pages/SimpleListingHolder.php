<?php

/*
use SilverStripe\Control\Cookie;
use SilverStripe\Forms\CompositeField;
use SilverStripe\Forms\ToggleCompositeField;
use SilverStripe\Forms\DropdownField;
use SilverStripe\Forms\CheckboxField;
use SilverStripe\Forms\TextField;
use SilverStripe\Forms\NumericField;
*/

class SimpleListingHolder extends Page
{

    private static $allowed_children = array("ListingPage");

    private static $default_child = "ListingPage";

    private static $db = array(
        "View"                     => "Enum('list,grid','list')",
        "AllowViewChange"          => "Boolean",
        "Columns"                  => "Int",
        "RemoveReadMore"           => "Boolean",
        "SameHeightBoxes"          => "Boolean",
        "ReadMoreButtonText"       => "Varchar(255)",
        "ImageMaxHeight"           => "Varchar(255)",
        "RemoveOverlay"            => "Boolean",
        "RemoveChildLinking"       => "Boolean",
        "RandomDisplayImage"       => "Boolean",
        "ShowListImagesAsCarousel" => "Boolean",
        "ChildrenTemplate"         => "Enum('Simple,Boomerang','Boomerang')",
        'ListingsPerPage'          => 'Int',
    );

    private static $has_one = array();

    private static $has_many = array();

    private static $many_many = array();

    private static $defaults = array(
        "SidebarPosition" => "left",
        "View"            => "grid",
        'ListingsPerPage' => 10,
    );

    public static function getColumnEnums()
    {
        return array("0" => "0", "1" => "1", "2" => "2", "3" => "3", "4" => "4");
    }

    public function getCMSFields()
    {
        $f = parent::getCMSFields();
        $f->removeByName(["SidebarPosition"]);

        return $f;
    }

    public function requireDefaultRecords()
    {
        parent::requireDefaultRecords();

    }

    function LayoutView()
    {
        $DefaultView = $this->View;
        $LayoutView = Cookie::get('LayoutView_' . $this->ID);
        if ($LayoutView) {
            return $LayoutView;
        }
        Cookie::set('LayoutView_' . $this->ID, $DefaultView);

        return $DefaultView ? $DefaultView : "list";
    }

    /**
     * @return string
     */
    function getReadMoreText()
    {
        return ($txt = $this->ReadMoreButtonText) ? $txt : "More";
    }

    function ColumnsSpanWidth()
    {
        $Columns = ($c = $this->Columns) ? $c : 3;

        return 12 / $Columns;
    }

    function getPageSetupFields()
    {
        $fields = Page::getDefaultPageSetupFields();
        $fields->push(CompositeField::create(
            ToggleCompositeField::create('ViewConfiguration', 'Display', [
                DropdownField::create("SidebarPosition", "Sidebar position")->setSource(["none" => "none", "left" => "left", "right" => "right"]),
                CheckboxField::create("AllowViewChange"),
                DropdownField::create("View")->setSource($this->dbObject("View")->enumValues()),
                DropdownField::create("Columns")->setSource(self::getColumnEnums()),
                CheckboxField::create("SameHeightBoxes", "Same height boxes on Grid"),
                CheckboxField::create("RemoveReadMore"),
                TextField::create("ReadMoreButtonText", "Button Text"),
                NumericField::create('ListingsPerPage', 'Listings per page'),

            ]),
            ToggleCompositeField::create('ImagesConfiguration', 'List Item', [
                CheckboxField::create("RandomDisplayImage"),
                TextField::create("ImageMaxHeight", "Image max height")->setDescription('height in px against width of 520px'),
                CheckboxField::create("RemoveChildLinking"),
                CheckboxField::create("RemoveOverlay", "Remove image overlay"),
                CheckboxField::create("ShowListImagesAsCarousel"),

            ])

        ));
        //$fields->push(DropdownField::create("Template")->setSource($this->getTemplateList()));
        $fields->push(DropdownField::create("ChildrenTemplate", "Children template")
            ->setSource($this->getTemplateList()));

        return $fields;
    }

    function MakeSameHeight()
    {
        if ($this->View === 'grid' && $this->SameHeightBoxes) {
            return "SameHeightBoxes";
        }

        return false;

    }
}

class SimpleListingHolderController extends Page_Controller
{

    public function init()
    {

        parent:: init();


    }


}
