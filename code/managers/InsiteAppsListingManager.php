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

    public static function get_listing_location_map()
    {
        $oListingLocation = ListingLocation::get();
        $oListingLocationMap = $oListingLocation ? $oListingLocation->map()->toArray() : array();
        asort($oListingLocationMap);
        return $oListingLocationMap;
    }

    public static function get_listing_type_map()
    {
        $oListingType = ListingType::get();
        $oListingTypeMap = $oListingType ? $oListingType->map()->toArray() : array();
        asort($oListingTypeMap);;
        return $oListingTypeMap;
    }

    public static function get_listing_collection_map()
    {
        $oListingCollection = ListingCollection::get();
        $oListingCollectionMap = $oListingCollection ? $oListingCollection->map()->toArray() : array();
        asort($oListingCollectionMap);
        return $oListingCollectionMap;
    }

}
