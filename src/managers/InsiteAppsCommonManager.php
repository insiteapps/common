<?php

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
