<?php

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
            ToggleCompositeField::create('ViewConfiguration', 'Display', [
                CheckboxField::create("SameHeightBoxes", "Same height boxes on Grid"),
                CheckboxField::create("RemoveReadMore"),
                TextField::create("ReadMoreButtonText", "Button Text")
            ]),
            ToggleCompositeField::create('ImagesConfiguration', 'List Item', [
                CheckboxField::create("RandomDisplayImage"),
                TextField::create("ImageMaxHeight", "Image max height")->setDescription('height in px against width of 520px'),
                CheckboxField::create("RemoveChildLinking"),
                CheckboxField::create("RemoveOverlay", "Remove image overlay"),
                CheckboxField::create("ShowListImagesAsCarousel"),

            ])


        );


        return $fields;
    }

    function MakeSameHeight()
    {
        if ($this->owner->View === 'Grid' && $this->owner->SameHeightBoxes) {
            return "SameHeightBoxes";
        }
        return false;

    }

    private static $db = array(
        "View" => "Enum('List,Grid','List')",
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
        "ActionBarBackgroundColour" => "Varchar(255)",
    );
    private static $defaults = array(
        "SidebarPosition" => "left",
        "View" => "List",
    );

    public static function getColumnEnums()
    {
        return array("0" => "0", "1" => "1", "2" => "2", "3" => "3", "4" => "4");
    }

    private static $many_many = array();

    public function updateCMSFields(FieldList $fields)
    {
        //$fields->addFieldToTab("Root.Manager", $compositeFields);
        $setup = PageSetupBar::create('Setup', $this->getPageSetupFields());
        $fields->insertBefore($setup, 'Root');
        $fields->fieldByName('Root')->setTemplate('PageSetupBar');

    }

    function LayoutView()
    {
        $DefaultView = $this->View;
        $LayoutView = Cookie::get('LayoutView_' . $this->ID);
        if ($LayoutView) {
            return $LayoutView;
        }
        Cookie::set('LayoutView_' . $this->ID, $DefaultView);
        return $DefaultView ? $DefaultView : "List";
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
}

class InsiteCommonListingControllerExtension extends DataExtension
{

    public function onAfterInit()
    {


    }


}
