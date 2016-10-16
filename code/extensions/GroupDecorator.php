<?php

class GroupDecorator extends DataExtension
{

    static $db = array(
        "MemberGroup" => "Boolean",
        "GroupLevel" => "Int",
        "CanSignUp" => "Boolean",
        "GoToAdmin" => "Boolean",
    );
    static $has_one = array(
        "LinkPage" => "SiteTree"
    );

    public function updateCMSFields(FieldList $fields)
    {
        $fields->addFieldToTab("Root.Members", new CheckboxField("MemberGroup", "Member Group"), 'Members');
        $fields->addFieldToTab("Root.Members", new NumericField("GroupLevel", "Group Level"), 'Members');
        $fields->addFieldToTab("Root.Members", new CheckboxField("CanSignUp", " Can Signup"), 'Members');
        $fields->addFieldToTab("Root.Members", new CheckboxField("GoToAdmin", " Go to Admin area"), 'Members');
        $fields->addFieldToTab("Root.Members", new TreeDropdownField("LinkPageID", "Or select a Page to redirect to", "SiteTree"), 'Members');
    }

}
