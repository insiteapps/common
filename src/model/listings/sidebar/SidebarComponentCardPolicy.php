<?php
/*
use SilverStripe\ORM\ArrayList;
use SilverStripe\View\ArrayData;
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
