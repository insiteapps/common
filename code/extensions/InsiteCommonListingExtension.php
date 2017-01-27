<?php

use SilverStripe\ORM\DataExtension;
use SilverStripe\Forms\CompositeField;
use SilverStripe\Forms\ToggleCompositeField;
use SilverStripe\Forms\DropdownField;
use SilverStripe\Forms\TextField;
use SilverStripe\Forms\CheckboxField;
use SilverStripe\Forms\NumericField;
use SilverStripe\Forms\FieldList;
use SilverStripe\Control\Cookie;

class InsiteCommonListingExtension extends DataExtension
{
    function getPageSetupFields()
    {
        $fields = CompositeField::create(

            ToggleCompositeField::create('ViewConfiguration', 'View', [
                DropdownField::create("View")->setSource($this->owner->dbObject("View")->enumValues()),
                DropdownField::create("Columns")->setSource(self::getColumnEnums())

            ]),
            ToggleCompositeField::create('ActionBarConfiguration', 'ActionBar', [
                CheckboxField::create("AllowViewChange"),
                TextField::create("ActionBarBackgroundColour")->addExtraClass('colorpicker'),
                //TextField::create("ActionBarButtonColour")->addExtraClass('colorpicker'),
                //TextField::create("ActionBarButtonActiveStateColour")->addExtraClass('colorpicker')
            ]),
            ToggleCompositeField::create('DefaultConfiguration', 'Default', [
                DropdownField::create("SliderSetup", "Slider Setup", [
                    "ShowOnAncestry" => "ShowOnAncestry",
                    "HideOnAncestry" => "HideOnAncestry",
                    "HideOnChildPages" => "HideOnChildPages"
                ])->setEmptyString("--select--"),
                CheckboxField::create("ShowSidebar"),
                DropdownField::create("SidebarPosition", "Sidebar position")->setSource(["none" => "none", "left" => "left", "right" => "right"])
            ]),
            ToggleCompositeField::create('ViewConfiguration', 'Display', [
                CheckboxField::create("SameHeightBoxes", "Same height boxes on Grid"),
                CheckboxField::create("RemoveReadMore"),
                TextField::create("ReadMoreButtonText", "Button Text"),
                DropdownField::create("ReadMoreButtonClass")->setSource($this->owner->dbObject("ReadMoreButtonClass")->enumValues()),
                NumericField::create('ListingsPerPage', 'Listings per page')

            ]),
            ToggleCompositeField::create('ImagesConfiguration', 'List Item', [
                CheckboxField::create("RandomDisplayImage"),
                TextField::create("ImageMaxHeight", "Image max height")->setDescription('height in px against width of 520px'),
                CheckboxField::create("RemoveChildLinking"),
                CheckboxField::create("RemoveOverlay", "Remove image overlay"),
                CheckboxField::create("ShowListImagesAsCarousel"),

            ])


        );
        $fields->push(DropdownField::create("Template")->setSource($this->owner->dbObject("Template")->enumValues()));
        $fields->push(DropdownField::create("ChildrenTemplate", "Children template")->setSource($this->owner->dbObject("ChildrenTemplate")->enumValues()));

        return $fields;
    }

    function MakeSameHeight()
    {
        if ($this->owner->LayoutView() === 'grid' && $this->owner->SameHeightBoxes) {
            return "SameHeightBoxes";
        }
        return false;

    }

    private static $db = array(
        "View" => "Enum('list,grid','list')",
        "AllowViewChange" => "Boolean",
        "Columns" => "Int",
        "RemoveReadMore" => "Boolean",
        "ReadMoreButtonClass" => "Enum('default,primary,warning,danger,info','default')",
        "SameHeightBoxes" => "Boolean",
        "ReadMoreButtonText" => "Varchar(255)",
        "ImageMaxHeight" => "Varchar(255)",
        "RemoveOverlay" => "Boolean",
        "RemoveChildLinking" => "Boolean",
        "RandomDisplayImage" => "Boolean",
        "ShowListImagesAsCarousel" => "Boolean",
        "ActionBarBackgroundColour" => "Varchar(255)",
        "Template" => "Enum('Simple,Boomerang','Boomerang')",
        "ChildrenTemplate" => "Enum('Simple,Boomerang','Boomerang')",
        'ListingsPerPage' => 'Int',
    );
    private static $defaults = array(
        "SidebarPosition" => "left",
        "View" => "list",
        'ListingsPerPage' => 10,
    );

    public static function getColumnEnums()
    {
        return array("0" => "0", "1" => "1", "2" => "2", "3" => "3", "4" => "4");
    }

    private static $many_many = array();

    public function updateCMSFields(FieldList $fields)
    {
        //$fields->addFieldToTab("Root.Manager", $compositeFields);
        $setup = PageSetupBar::create('Setup', $this->owner->getPageSetupFields());
        $fields->insertBefore($setup, 'Root');
        $fields->fieldByName('Root')->setTemplate('PageSetupBar');

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
        return ($txt = $this->owner->ReadMoreButtonText) ? $txt : "Read More";
    }

    function ColumnsSpanWidth()
    {
        $Columns = ($c = $this->owner->Columns) ? $c : 3;
        return 12 / $Columns;
    }


    function LayoutWidth(){
        return 12;
    }


}

class InsiteCommonListingControllerExtension extends DataExtension
{

    public function onAfterInit()
    {

    }

}
