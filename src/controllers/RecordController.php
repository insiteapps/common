<?php
use SilverStripe\ORM\DataObject;
use SilverStripe\View\Requirements;
use SilverStripe\Security\Group;

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

class RecordController extends InsiteMainController
{

    private static $allowed_actions = array(
        'logout',
        'mapmarkers',
        'loadVideoModal',
        'resend_contact_email' => "ADMIN"
    );

    function Link($action = null)
    {
        return "records/$action";
    }

    static function find_link($action = false)
    {

        return self::Link($action);
    }

    function loadVideoModal()
    {
        $params = $this->urlParamsParts();
        $Id = $params['ID'];
        $gallery = GalleryImage::get()->byID($Id);
        $data = array();
        $data['VideoCode'] = $gallery->VideoCode;
        $data['Title'] = $gallery->Name;

        return $this->customise($data)->renderWith(array('VideoModalContent'));
    }

    function resend_contact_email()
    {
        $pages = ContactPage::get();
        foreach ($pages as $page) {
            $form_items = DataObject::get("SubmittedForm", "ParentID = " . $page->ID);
            foreach ($form_items as $form_item) {
                $form_item_fields = $form_item->Values();
                $form_item_fields_values = $form_item_fields->column("Value");
                $data["Name"] = $form_item_fields_values[0];
                $data["Email"] = $form_item_fields_values[1];
                $data["Message"] = $form_item_fields_values[2];
                $data["PageLink"] = false;

                $recipients = $page->EmailRecipients();
                if (count($recipients)) {
                    foreach ($recipients as $recipient) {
                        $Subject = $recipient->EmailSubject;
                        $data["Subject"] = $Subject;
                        $From = $data['Email'];

                        $To = $recipient->EmailAddress;
                        $email = new Email($From, $To, $Subject);
                        $email->setTemplate('SendContactSubmission');
                        $email->populateTemplate($data);
                        if ($To !== "submissions@insitesolutions.co.za") {
                            $email->send();
                            debug::show("Email sent");
                        }

                    }
                }

            }

        }

    }

    function mapmarkers()
    {
        Requirements::css(BOOTSTRAP_DIR . "/css/bootstrap.min.css");
        Requirements::css(PROJECT . "/css/SelectMarkerPositioning.css");
        Requirements::javascript(PROJECT . "/js/SelectMarkerPositioning.js");
        Requirements::javascript(PROJECT . '/js/jquery.kinetic.js');

        $ID = $this->urlParamsID();
        $SlideShow = SlideShow::get()->byID($ID);
        $image = $SlideShow->Image();
        $data = array(
            "Image" => $image
        );

        return $this->customise($data)->renderWith(array("SelectMarkerPosition"));
    }


    static public function AddProtocol($url)
    {
        if (strtolower(substr($url, 0, 8)) !== 'https://' && strtolower(substr($url, 0, 7)) !== 'http://') {
            return 'http://' . $url;
        }
        return $url;
    }

    public static function find_or_make_customers_groupp() {
        $group = DataObject::get_one("Group", "Code='customers'");
        if (!$group) {
            $group = new Group();
            $group->Code = 'customers';
            $group->Title = 'Customers';
            $group->write();
            Permission::grant($group->ID, 'SITE_CUSTOMER');
        }
        return $group;
    }


}
