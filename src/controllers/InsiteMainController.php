<?php

/*
use SilverStripe\Security\Member;
use SilverStripe\Core\Convert;
*/

class InsiteMainController extends Page_Controller
{

    
    
    /**
     * @var array
     */
    private static $aFontList = array();

    function Member()
    {
        return Member::currentUser();
    }

    /**
     * @param $url
     *
     * @return string
     */
    static public function AddProtocol($url)
    {
        if (strtolower(substr($url, 0, 8)) !== 'https://' && strtolower(substr($url, 0, 7)) !== 'http://') {
            return 'http://' . $url;
        }

        return $url;
    }
    
    
    protected function getRequestData( $query = null )
    {
        
        $data = $this->requestVars();
        if ( $data ) {
            
            
            $aData = RecordController::cleanREQUEST( $data );
            if ( $query ) {
                
                
                if ( isset( $aData[ $query ] ) ) {
                    return $aData[ $query ];
                }
                
                return false;
            }
            
            return $aData;
        }
        
        return [];
        
    }
    public function requestVars()
    {
        
        $data = array_merge_recursive( $this->GetVars(), $this->PostVars() );
        
        return (array) static::cleanREQUEST( $data );
    }
    
    
    public function GetVars()
    {
        
        return count( $_g = (array) filter_input_array( INPUT_GET ) ) ? $_g : [];
    }
    
    public function PostVars()
    {
        
        return count( $_g = (array) filter_input_array( INPUT_POST ) ) ? $_g : [];
    }
    /**
     *
     * @param array $request
     * @param array $Unset
     *
     * @return array
     */
    public static function cleanREQUEST(array $request, array $Unset = array())
    {
        $request = Convert::raw2sql($request);
        $aUnset = array('url', 'SecurityID');
        $arrUnset = array_merge($aUnset, $Unset);
        foreach ( $arrUnset as $value ) {
            unset($request[ $value ]);
        }

        return $request;
    }

    public static function validateDate($date)
    {
        $d = DateTime::createFromFormat('Y-m-d', $date);

        return $d && $d->format('Y-m-d') === $date;
    }

    function generate_page_controller($title = "Page")
    {
        $tmpPage = new Page();
        $tmpPage->Title = $title;
        $tmpPage->URLSegment = strtolower(str_replace(' ', '-', $title));
        // Disable ID-based caching  of the log-in page by making it a random number
        $tmpPage->ID = -1 * rand(1, 10000000);

        $controller = Page_Controller::create($tmpPage);
        //$controller->setDataModel($this->model);
        $controller->init();

        return $controller;
    }

    function urlParamsID()
    {
        return Convert::raw2sql($this->urlParams['ID']);
    }
    function urlParamsOtherID()
    {
        return Convert::raw2sql($this->urlParams['OtherID']);
    }
    function urlParamsAction()
    {
        return Convert::raw2sql($this->urlParams['Action']);
    }
    function urlParamsParts()
    {
        return Convert::raw2sql($this->urlParams);
    }

    /**
     * @return array|bool
     */
    public static function get_fonts_library_names()
    {
        $url = "https://cdn.insiteapps.co.za/fonts/names/";
        $oManager = new  InsiteAppsCurlManager();
        $results = $oManager->processCurlWithHeaders($url);

        return $results;

    }

}
