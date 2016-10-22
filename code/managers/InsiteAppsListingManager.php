<?php

/**
 * Class InsiteAppsListingManager
 */
class InsiteAppsListingManager extends InsiteAppsCommonManager
{
    public static function getPropertyMinMax($field)
    {
        $oProperties = PropertyPage::get();
        $data = $oProperties->column($field);
        $data = array_unique($data);
        asort($data);
        $min = min($data);
        $max = max($data);
        return array_combine(range($min, $max), range($min, $max));

    }


    public static function get_listing_object_map($className, $key = "ID")
    {
        $oObj = $className::get();
        $oObjMap = $oObj ? $oObj->map($key, "Title")->toArray() : array();
        asort($oObjMap);
        return $oObjMap;
    }

}
