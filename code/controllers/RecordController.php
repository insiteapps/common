<?php

class RecordController extends Controller
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

    static public function AddProtocol($url)
    {
        if (strtolower(substr($url, 0, 8)) !== 'https://' && strtolower(substr($url, 0, 7)) !== 'http://') {
            return 'http://' . $url;
        }
        return $url;
    }
}
