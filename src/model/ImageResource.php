<?php

/**
 * Class ImageResource
 */
class ImageResource extends DataObject
{
    
    private static $default_sort = 'SortOrder';
    
    private static $db = array(
        'VideoLink'   => 'Varchar(255)',
        'VideoType'   => 'Enum("Youtube,Vimeo","Vimeo")',
        'Name'        => 'Varchar(255)',
        'Description' => 'Text',
        'Easing'      => 'Enum("default,easeOutBack,easeInBack,Power4.easeOut","default")',
        'Transition'  => 'Enum("fade,boxfade,slideleft,zoomout,papercut,slidedown,slotfade-horizontal,slideoverhorizontal","fade")',
        'SortOrder'   => 'Int',
    );
    
    private static $has_one = array(
        'Image' => 'FittedImage',
        'Page'  => 'Page',
    );
    
    public function getCMSFields()
    {
        
        $f = parent::getCMSFields();
        $f->removeByName( 'SortOrder' );
        $f->removeByName( 'PageID' );
        $f->addFieldsToTab( "Root.Settings", array(
            DropdownField::create( "Easing" )->setSource( $this->dbObject( "Easing" )->enumValues() ),
            DropdownField::create( "Transition" )->setSource( $this->dbObject( "Transition" )->enumValues() ),
        ) );
        
        
        $URLSegment = null;
        if ( $this->PageID ) {
            $URLSegment = $this->Page()->URLSegment;
        }
        $ImageField = FileAttachmentField::create( 'Image' )->imagesOnly()->setMaxFilesize( 1 )
                                         ->setFolderName( 'Uploads/Images/' . $URLSegment );
        
        $f->addFieldToTab( 'Root.Images', $ImageField );
        
        $f->addFieldsToTab( 'Root.Video', [
            DropdownField::create( "VideoType" )->setSource( $this->dbObject( "VideoType" )->enumValues() ),
            TextField::create( "VideoLink" )->setRightTitle( 'Please paste the embed code only' ),
        ] );
        
        return $f;
    }
    
    private static $summary_fields = array(
        'Thumbnail',
        'Name',
        //'Description',
        "VideoLink",
    
    );
    
    function getThumbnail()
    {
        
        $image = $this->Image();
        if ( $image && $image->ID ) {
            return $image->CMSThumbnail();
        }
    }
    
    function LinkingClass()
    {
        
        return strtolower( $this->VideoType );
        
        
        /*
        $url = $this->VideoLink;
        if (strpos($url, 'youtube') > 0) {
            $player = 'youtube';
        } elseif (strpos($url, 'vimeo') > 0) {
            $player = 'vimeo';
        }

        return $player;
        */
        
        
    }
    
    function IsVideo()
    {
        
        if ( $this->VideoLink ) {
            
            return true;
        }
        
        return false;
    }
    
    function IsVideoClass()
    {
        
        if ( $this->IsVideo() ) {
            return "HasVideo";
        }
        
        return false;
    }
    
    protected function onBeforeDelete()
    {
        
        parent::onBeforeDelete();
        
        if ( $this->ImageID ) {
            $oImage = $this->Image();
            if ( $oImage->exists() ) {
                $oImage->delete();
                $oImage->destroy();
            }
        }
    }
    
}