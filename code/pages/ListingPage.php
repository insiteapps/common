<?php

/**
 * Class ListPage
 * @author Patrick Chitovoro
 */
class ListingPage extends Page
{
    private static $can_be_root = false;
    private static $allowed_children = array();
    private static $db = array(
        'Status' => "Enum('Active,Approved,Pending,Suspended','Pending')",
        "Reference" => "Varchar(100)",
        "Summary" => "HTMLText",
    );
    private static $has_many = array(
        "ListingImages" => "ImageResource"
    );
    private static $many_many = array(
        "Areas" => "ListingArea",
        "Collections" => "ListingCollection",
        "Locations" => "ListingLocation",
        "Types" => "ListingType",
    );

    function getTemplateName()
    {
        return $this->Parent()->ChildrenTemplate . $this->ClassName;
    }

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();


        //house keeping
        $fields->dataFieldByName('Content')->setRows(20);
        //$urlSegment = $fields->dataFieldByName('URLSegment');
        //$urlSegment->setURLPrefix($this->Parent()->RelativeLink());
        //  $fields->push(HiddenField::create('URLSegment'));
        // $fields->push(HiddenField::create('MenuTitle'));
        $fields->removeFieldsFromTab('Root.Main', array(
            // 'MenuTitle',
            //'URLSegment',
        ));

        $summary = HtmlEditorField::create('Summary', false);
        $summary->setRows(5);
        $summary->setDescription(_t(
            'BlogPost.SUMMARY_DESCRIPTION',
            'If no summary is specified the first 150 words will be used.'
        ));

        $summaryHolder = ToggleCompositeField::create(
            'CustomSummary',
            _t('BlogPost.CUSTOMSUMMARY', 'Add A Custom Summary'),
            array(
                $summary,
            )
        );
        $summaryHolder->setHeadingLevel(4);
        $summaryHolder->addExtraClass('custom-summary');
        $fields->insertBefore($summaryHolder, 'Content');


        $fields->addFieldsToTab('Root.Details', [
            DropdownField::create("Status")
                ->setSource($this->dbObject("Status")->enumValues())
                ->setEmptyString("--Select--"),
            TextField::create('Reference'),
        ]);

        $gridFieldConfig = GridFieldConfig_RecordEditor::create();
        $gridFieldConfig->addComponent(new GridFieldBulkUpload());
        $folder = 'Uploads/listings/' . $this->Parent()->URLSegment . '/' . $this->URLSegment;
        $gridFieldConfig->getComponentByType('GridFieldBulkUpload')->setUfSetup('setFolderName', $folder);
        $gridFieldConfig->addComponent(new GridFieldSortableRows('SortOrder'));
        $ImageGridfield = new GridField('Images', 'Images', $this->ListingImages(), $gridFieldConfig);
        $fields->addFieldToTab('Root.Images', $ImageGridfield);


        $oListingArea = ListingArea::get();
        $oListingAreaMap = $oListingArea ? $oListingArea->map()->toArray() : array();
        asort($oListingAreaMap);
        $fields->addFieldToTab('Root.Details', ListboxField::create('Areas', 'Please select your Areas')
            ->setMultiple(true)
            ->setSource($oListingAreaMap)
            ->setAttribute('data-placeholder', 'Areas'));

        $oListingLocation = ListingLocation::get();
        $oListingLocationMap = $oListingLocation ? $oListingLocation->map()->toArray() : array();
        asort($oListingLocationMap);
        $fields->addFieldToTab('Root.Details', ListboxField::create('Locations', 'Please select your Locations')
            ->setMultiple(true)
            ->setSource($oListingLocationMap)
            ->setAttribute('data-placeholder', 'Locations'));

        $oListingType = ListingType::get();
        $oListingTypeMap = $oListingType ? $oListingType->map()->toArray() : array();
        asort($oListingTypeMap);
        $fields->addFieldToTab('Root.Details', ListboxField::create('Types', 'Please select your Types')
            ->setMultiple(true)
            ->setSource($oListingTypeMap)
            ->setAttribute('data-placeholder', 'Types'));


        $oListingCollection = ListingCollection::get();
        $oListingCollectionMap = $oListingCollection ? $oListingCollection->map()->toArray() : array();
        asort($oListingTypeMap);
        $fields->addFieldToTab('Root.Details', ListboxField::create('Collections', 'Please select your Collections')
            ->setMultiple(true)
            ->setSource($oListingCollectionMap)
            ->setAttribute('data-placeholder', 'Collections'));


        return $fields;
    }

    function Link()
    {
        if ($this->Parent()->RemoveChildLinking) {
            return "javascript:void(0);";
        }
        return parent::Link();
    }

    /**
     * @return string
     */
    function filterCategories()
    {
        //$Categories = $this->Categories();
        //$ListCategories = $Categories->column('URLSegment');
        //return implode(' ', array_filter($ListCategories));

    }

    function ContentSummary($len = 100)
    {
        $raw_content = ($excerpt = $this->Summary) ? $excerpt : $this->Content;


        $content_strip = preg_replace("/<img[^>]+\>/i", " ", $raw_content);
        $content = preg_replace("/<p[^>]*>[\s|&nbsp;]*<\/p>/", '', $content_strip);
        $html = InsiteContentManager::truncate(str_replace(["<p></p>", "<p> </p>"], "", $content), $len);
        if ($html->Value) {
            return $html->Value;
        }
        return $html;

    }


    function Image()
    {
        $sort = ($this->Parent()->RandomDisplayImage) ? "Rand()" : null;
        $height = ($ImageMaxHeight = $this->Parent()->ImageMaxHeight) ? str_ireplace(["px", "PX"], "", $ImageMaxHeight) : "520";
        if (count($this->ListingImages())) {
            $image = $this->ListingImages()
                ->sort($sort)
                ->first();
            return $image->Image()->CroppedResize(520, $height);
        }
        return false;
    }

    function ListingImage()
    {
        if (count($this->Images())) {
            $image = $this->Images()->first();
            return $image->Image();
        }

        return $this->Image();
    }

}

class ListingPage_Controller extends Page_Controller
{

    public function init()
    {
        parent:: init();
    }

    public function SlideShow()
    {
        if (count($this->Images())) {

            return false;
        }
        return parent::SlideShow();
    }
}
