<?php

/**
 * Class InsiteAppsListingManager
 */
class InsiteAppsListingManager extends InsiteAppsCommonManager
{

    public static function get_listing_area_map()
    {
        $oListingArea = ListingArea::get();
        $oListingAreaMap = $oListingArea ? $oListingArea->map()->toArray() : array();
        asort($oListingAreaMap);
        return $oListingAreaMap;
    }

}
