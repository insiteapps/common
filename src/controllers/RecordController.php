<?php

/*
use SilverStripe\ORM\DataObject;
use SilverStripe\View\Requirements;
use SilverStripe\Security\Group;
 */

class RecordController extends InsiteMainController
{
    
    private static $allowed_actions = array(
        'logout',
        'mapmarkers',
        'loadVideoModal',
        'resend_contact_email' => "ADMIN",
        'delete_record',
    );
    
    public function Link( $action = null )
    {
        
        return "records/$action";
    }
    
    public static function Guid()
    {
        mt_srand( (double) microtime() * 10000 );
        $charid = strtoupper( md5( uniqid( rand(), true ) ) );
        $hyphen = chr( 45 );// "-"
        return substr( $charid, 0, 8 ) . $hyphen . substr( $charid, 8, 4 ) . $hyphen . substr( $charid, 12, 4 ) . $hyphen . substr( $charid, 16, 4 ) . $hyphen . substr( $charid, 20, 12 );
    }
    
    public static function uuid()
    {
        mt_srand( (double) microtime() * 100000 );
        $charid = strtolower( md5( uniqid( rand(), true ) ) );
        return substr( $charid, 0, 8 ) . substr( $charid, 8, 4 ) . substr( $charid, 12, 4 ) . substr( $charid, 16, 4 ) . substr( $charid, 20, 12 );
    }
    
    public static function find_link( $action = false )
    {
        
        return self::create()->Link( $action );
    }
    
    public function delete_record()
    {
        
        $member = Member::currentUser();
        try {
            if ( $member ) {
                $aResponse = array();
                $params    = Convert::raw2sql( $this->urlParams );
                $ClassName = $params[ 'ID' ];
                $record_id = $params[ 'OtherID' ];
                if ( $ClassName && $record_id ) {
                    $record = DataObject::get_by_id( $ClassName, $record_id );
                    if ( Page::IsAdmin() || ( $record->exists() && $record->canDelete() ) ) {
                        $record->delete();
                        $record->destroy();
                        $aResponse[ 'status' ]  = "success";
                        $aResponse[ 'message' ] = "Record deleted";
                    } else {
                        $aResponse[ 'status' ]  = "error";
                        $aResponse[ 'message' ] = "Sorry Record NOT deleted, you don't have permission to delete this record";
                    }
                }
            }
        } catch ( Exception $e ) {
            $aResponse[ 'status' ]  = "Fail";
            $msg                    = "Sorry you don't have permission to delete this record. " . $e;
            $aResponse[ 'message' ] = $msg;
            user_error( $msg, E_USER_WARNING );
        }
        
        return Convert::raw2json( $aResponse );
    }
    
    public function loadVideoModal()
    {
        
        $params              = $this->urlParamsParts();
        $Id                  = $params[ 'ID' ];
        $gallery             = GalleryImage::get()->byID( $Id );
        $data                = array();
        $data[ 'VideoCode' ] = $gallery->VideoCode;
        $data[ 'Title' ]     = $gallery->Name;
        
        return $this->customise( $data )->renderWith( array( 'VideoModalContent' ) );
    }
    
    public function resend_contact_emaill()
    {
        
        $pages = ContactPage::get();
        foreach ( $pages as $page ) {
            $form_items = DataObject::get( "SubmittedForm", "ParentID = " . $page->ID );
            foreach ( $form_items as $form_item ) {
                $form_item_fields        = $form_item->Values();
                $form_item_fields_values = $form_item_fields->column( "Value" );
                $data[ "Name" ]          = $form_item_fields_values[ 0 ];
                $data[ "Email" ]         = $form_item_fields_values[ 1 ];
                $data[ "Message" ]       = $form_item_fields_values[ 2 ];
                $data[ "PageLink" ]      = false;
                
                $recipients = $page->EmailRecipients();
                if ( count( $recipients ) ) {
                    foreach ( $recipients as $recipient ) {
                        $Subject           = $recipient->EmailSubject;
                        $data[ "Subject" ] = $Subject;
                        $From              = $data[ 'Email' ];
                        
                        $To    = $recipient->EmailAddress;
                        $email = new Email( $From, $To, $Subject );
                        $email->setTemplate( 'SendContactSubmission' );
                        $email->populateTemplate( $data );
                        if ( $To !== "submissions@insitesolutions.co.za" ) {
                            $email->send();
                            debug::show( "Email sent" );
                        }
                        
                    }
                }
                
            }
            
        }
        
    }
    
    public function mapmarkers()
    {
        
        Requirements::css( BOOTSTRAP_DIR . "/css/bootstrap.min.css" );
        Requirements::css( PROJECT . "/css/SelectMarkerPositioning.css" );
        Requirements::javascript( PROJECT . "/js/SelectMarkerPositioning.js" );
        Requirements::javascript( PROJECT . '/js/jquery.kinetic.js' );
        
        $ID        = $this->urlParamsID();
        $SlideShow = SlideShow::get()->byID( $ID );
        $image     = $SlideShow->Image();
        $data      = array(
            "Image" => $image,
        );
        
        return $this->customise( $data )->renderWith( array( "SelectMarkerPosition" ) );
    }
    
    
    public static function AddProtocol( $url )
    {
        
        if ( strtolower( substr( $url, 0, 8 ) ) !== 'https://' && strtolower( substr( $url, 0, 7 ) ) !== 'http://' ) {
            return 'http://' . $url;
        }
        
        return $url;
    }
    
    public static function find_or_make_customers_group()
    {
        
        $group = DataObject::get_one( "Group", "Code='customers'" );
        if ( !$group ) {
            $group        = new Group();
            $group->Code  = 'customers';
            $group->Title = 'Customers';
            $group->write();
            Permission::grant( $group->ID, 'SITE_CUSTOMER' );
        }
        
        return $group;
    }
    
    
}
