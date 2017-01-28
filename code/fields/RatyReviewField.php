<?php
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

/**
 *
 * @package forms
 * @subpackage fields-dataless
 * @author Patrick Chitovoro
 */
class RatyReviewField extends DatalessField
{

    /**
     * @var string $content
     */
    protected $content;

    public function __construct($name, $title = null)
    {
        parent::__construct($name, $title);
    }

    /**
     * @param array $properties
     * @return string
     */
    public function Field($properties = array())
    {
        
        $f_name = $this->name;
        $field = "<div class='raty-reviews-field'>";
        if ($this->Title()) {
            $field .= " <label>{$this->Title()}</label>";
        }
        $field .= "<div data-target='#{$f_name}' class='raty-review'></div>";
        $field .= sprintf("<input type=\"hidden\" class=\"valueReader\" value='1' name=\"%s\" id=\"%s\" >", $f_name, $f_name);
        $field .= "</div>";
        return $field;

    }

    function setValue($value = null)
    {
        $this->value = $value;
    }

}
