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
 * Class CalendarManagerToolkit
 */
class CalendarManagerToolkit
{

    public static function breakdown($ts = null)
    {
        // default to now
        if ($ts === null) $ts = self::now();

        // gather individual variables
        $H = date('H', $ts); // hour
        $i = date('i', $ts); // minute
        $s = date('s', $ts); // second
        $m = date('m', $ts); // month
        $d = date('d', $ts); // day
        $Y = date('Y', $ts); // year

        return array($H, $i, $s, $m, $d, $Y);
    }

    /**
     * Returns the current timestamp.
     *
     * @return    timestamp
     *
     * @see        time
     */
    public static function now()
    {
        return time();
    }

    /**
     * Retrieve the timestamp from a number of different formats.
     *
     * @param    mixed    value to use for timestamp retrieval
     */
    public static function getTS($value = null)
    {
        if ($value === null) {
            return self::now();
        } else if ($value instanceof sfDate) {
            return $value->get();
        } else if (!is_numeric($value)) {
            return strtotime($value);
        } else if (is_numeric($value)) {
            return $value;
        }

        throw new SS_HTTPResponse_Exception(sprintf('A timestamp could not be retrieved from the value: %s', $value));
    }
}
