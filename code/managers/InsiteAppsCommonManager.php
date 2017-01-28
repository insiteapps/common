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

use SilverStripe\Core\Object;

/**
 * Class InsiteAppsCommonManager
 */
class InsiteAppsCommonManager extends Object
{

    /**
     * @param int $x
     * @param int $max
     * @return array
     */
    public function getNumericValues($x = 0, $max = 4)
    {
        $arrValues = array();
        for ($i = $x; $i <= $max; $i++) {
            $arrValues[$i] = $i;
        }
        return $arrValues;
    }

}
