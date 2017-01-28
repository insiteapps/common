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

use SilverStripe\ORM\ArrayList;
use SilverStripe\View\ArrayData;

/**
 * Class SidebarComponentCardPolicy
 */
class SidebarComponentCardPolicy extends ListingSidebarComponent
{


    /**
     * Human-readable singular name.
     * @var string
     * @config
     */
    private static $singular_name = "CardPolicy";

    /**
     * Human-readable plural name
     * @var string
     * @config
     */
    private static $plural_name = "CardPolicies";

    public static $cards = array(
        //"nocreditcards" => "No credit cards accepted",
        "euromastercard" => "Euro/Mastercard",
        "visa" => "Visa",
        "americanexpress" => "American Express",
        "maestro" => "Maestro",
    );

    /**
     * @return mixed
     */
    public  function CardsAccepted()
    {
        $set = ArrayList::create();
        foreach (self::$cards as $name => $card) {
            $set->push(ArrayData::create(array(
                "Name" => $name,
                "Title" => $card
            )));
        }
        return $set;
    }
}
