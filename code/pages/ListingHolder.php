<?php

class ListingHolder extends Page
{

    private static $allowed_children = array("ListingPage");
    private static $default_child = "ListingPage";
    private static $db = array();

    private static $has_one = array();
    private static $has_many = array();

    private static $defaults = array();

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();
        return $fields;
    }
}

class ListingHolder_Controller extends Page_Controller
{

    public function init()
    {
        parent:: init();


    }


}
