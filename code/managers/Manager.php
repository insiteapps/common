<?php


/**
 * Class InsiteAppsManager
 */

namespace InsiteApps\Common;

use InsiteApps;

use DateTime;
use DateTimeZone;

class Manager extends InsiteApps\Common
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
