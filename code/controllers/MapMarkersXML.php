<?php

class MapMarkersXML extends InsiteContentManager
{

    function Link($action = null)
    {
        return "markers/$action";
    }

    static $allowed_actions = array(
        'xml',
        'sitetreexml'
    );
    static $skip = array('url');

    function xml() {
        $this->getResponse()->addHeader("Content-type", "text/xml");
        $pageId = Convert::raw2xml($this->urlParams['ID']);
        // $page = SiteTree::get()->byID($pageId);
        $places = Place::get();
        $tag = "<marker name=\"%s\" address=\"%s\" lat=\"%s\" lng=\"%s\" class=\"%s\"  />\n";
        $xml = "<markers>\n";
        //$xml .= sprintf($tag, Convert::raw2xml($page->Title), Convert::raw2xml($page->Address), $page->Latitude, $page->Longitude, $page->ClassName);
        if (count($places)) {
            foreach ($places as $place) {
                $xml .= sprintf($tag, Convert::raw2xml($place->Name), Convert::raw2xml($place->Address()), $place->Latitude, $place->Longitude, $place->ClassName);
            }
        }
        $xml .= "</markers>";
        return $xml;
    }

    function sitetreexml()
    {
        $this->getResponse()->addHeader("Content-type", "text/xml");
        $pageId = Convert::raw2xml($this->urlParams['ID']);
        $page = SiteTree::get()->byID($pageId);
        $xml = "<markers>\n";
        $tag = "<marker name=\"%s\" address=\"%s\" lat=\"%s\" lng=\"%s\"/>\n";
        $xml .= sprintf($tag, Convert::raw2xml($page->Title), Convert::raw2xml($page->Address), $page->Latitude, $page->Longitude);
        $xml .= "</markers>";
        return $xml;
    }

}
