<?php
use SilverStripe\Security\Member;
use SilverStripe\Core\Convert;

/**
 *
 * Copyright (c) 2017 Insite Apps - http://www.insiteapps.co.za
 * All rights reserved.
 * @package insiteapps
 * @author Patrick Chitovoro  <patrick@insiteapps.co.za>
 * Redistribution and use in source and binary forms, with or without modification, are NOT permitted at all.
 * There is no freedom to share or change it this file.
 *
 *
 */

class InsiteMainController extends Page_Controller
{

    function Member()
    {
        return Member::currentUser();
    }

    static public function AddProtocol($url)
    {
        if (strtolower(substr($url, 0, 8)) !== 'https://' && strtolower(substr($url, 0, 7)) !== 'http://') {
            return 'http://' . $url;
        }
        return $url;
    }

    /**
     *
     * @param array $request
     * @param array $Unset
     * @return array
     */
    public static function cleanREQUEST(array $request, array $Unset = array())
    {
        $request = Convert::raw2sql($request);
        $aUnset = array('url', 'SecurityID');
        $arrUnset = array_merge($aUnset, $Unset);
        foreach ($arrUnset as $value) {
            unset($request[$value]);
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


    function urlParamsParts()
    {
        return Convert::raw2sql($this->urlParams);
    }

}
