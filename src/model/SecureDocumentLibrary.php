<?php

/*
use SilverStripe\ORM\DataObject;
 */

class SecureDocumentLibrary extends DataObject
{
    
    private static $default_sort = 'SortOrder';
    
    private static $db = array(
        'Title'     => 'Varchar(255)',
        'Content'   => 'HTMLText',
        'SortOrder' => 'Int',
    );
    
    private static $has_one = array(
        'File'           => 'File',
        'MemberAreaPage' => 'MemberAreaPage',
    );
    
    public function getCMSFields()
    {
        $f = parent::getCMSFields();
        $f->removeByName( [
            'SortOrder',
            'MemberAreaPage',
        ] );
        $f->addFieldToTab( 'Root.Main', HTMLEditorField::create( 'Content' )->setRows( 10 ) );
        return $f;
    }
    
    private static $summary_fields = array(
        'Name',
        'Description',
    );
    
    public function getThumbnail()
    {
        $image = $this->Image();
        if ( $image && $image->ID ) {
            return $image->CMSThumbnail();
        }
    }
    
}
