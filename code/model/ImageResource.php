<?php

/**
 * Class ImageResource
 */
class ImageResource extends DataObject
{

    private static $default_sort = 'SortOrder';
    private static $db = array(
        'Name' => 'Varchar(255)',
        'Description' => 'Text',
        'Easing' => 'Enum("easeOutBack,easeInBack,Power4.easeOut","easeOutBack")',
        'Transition' => 'Enum("fade,boxfade,slideleft,zoomout,papercut,slidedown,slotfade-horizontal","fade")',
        'SortOrder' => 'Int',
    );
    private static $has_one = array(
        'Image' => 'FittedImage',
        'Page' => 'Page',
    );

    public function getCMSFields()
    {
        $f = parent::getCMSFields();
        $f->removeByName('SortOrder');
        $f->removeByName('PageID');
        $f->addFieldsToTab("Root.Settings", array(
            DropdownField::create("Easing")->setSource($this->dbObject("Easing")->enumValues()),
            DropdownField::create("Transition")->setSource($this->dbObject("Transition")->enumValues()),
        ));


        $ImageField = new UploadField('Image', 'Please upload a Hero image <span>(max. 1 files)</span>');
        $ImageField->setAllowedFileCategories('image');
        $ImageField->setAllowedMaxFileNumber(1);
        $ImageField->getValidator()->setAllowedExtensions(array('jpg', 'jpeg', 'png', 'gif'));
        $ImageField->setConfig('allowedMaxFileNumber', 1);
        $URLSegment = null;
        if ($this->PageID) {
            $URLSegment = $this->Page()->URLSegment;
        }
        $ImageField->setFolderName('Uploads/Images/' . $URLSegment);
        $f->addFieldToTab('Root.Images', $ImageField);
        return $f;
    }

    private static $summary_fields = array(
        'Thumbnail',
        'Name',
        'Description'
    );

    function getThumbnail()
    {
        $image = $this->Image();
        if ($image && $image->ID) {
            return $image->CMSThumbnail();
        }
    }

}
