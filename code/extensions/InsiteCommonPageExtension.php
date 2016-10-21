<?php

class InsiteCommonPageExtension extends DataExtension
{
    private static $db = array(
        "SliderSetup" => "Enum('ShowOnAncestry,HideOnAncestry,HideOnChildPages','ShowOnAncestry')",
        "SidebarPosition" => "Enum('none,left,right','none')"
    );
    private static $many_many = array();

    public function updateCMSFields(FieldList $fields)
    {
        $compositeFields = CompositeField::create(

            ToggleCompositeField::create('DefaultConfiguration', 'Default', [
                DropdownField::create("SliderSetup", "Slider Setup", [
                    "ShowOnAncestry" => "ShowOnAncestry",
                    "HideOnAncestry" => "HideOnAncestry",
                    "HideOnChildPages" => "HideOnChildPages"
                ], $oComponentsValues->SliderSetup)->setEmptyString("--select--"),
                DropdownField::create("SidebarPosition", "Sidebar position")->setSource(["none" => "none", "left" => "left", "right" => "right"])
            ])
        );
        $fields->addFieldToTab("Root.Manager", $compositeFields);

    }


}

class InsiteCommonPageControllerExtension extends DataExtension
{

    public function onAfterInit()
    {
        Requirements::css(INSITE_COMMON_DIR . "/css/common.css");

        Requirements::javascript(INSITE_COMMON_DIR . "/js/js.cookie.js");
        
    }

    function SocialGroup($name)
    {
        $title = urlencode($this->Title);
        $summary = urlencode($this->MetaDescription);
        $url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $url = "http://www.jamin.com/";
        $logo = Controller::join_links($url, 'themes/adventures/images/logo.png');
        //  debug::show($logo);
        switch ($name) {
            case 'Twitter':
                $href = "https://twitter.com/home/tweet?status=" . $title . '+' . urlencode($url);
                break;
            case 'Facebook':

                $query = array();
                $query["app_id"] = '1792760461000651';
                $query["link"] = $url;
                $query["name"] = $title;
                $query["picture"] = $logo;
                $query["description"] = $summary;
                $query["redirect_uri"] = $url;

                $href = "https://www.facebook.com/dialog/feed?" . http_build_query($query);

                break;
            case 'Google':
                $href = "https://plus.google.com/share?url=" . urlencode($url);
                break;
            case 'Pinterest':
                $href = 'javascript:void((function()%7Bvar%20e=document.createElement(&apos;script&apos;);e.setAttribute(&apos;type&apos;,&apos;text/javascript&apos;);e.setAttribute(&apos;charset&apos;,&apos;UTF-8&apos;);e.setAttribute(&apos;src&apos;,&apos;http://assets.pinterest.com/js/pinmarklet.js?r=&apos;+Math.random()*99999999);document.body.appendChild(e)%7D)());';
                break;
            default:
                break;
        }
        return $href;
    }

}
