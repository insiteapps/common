<?php

class CalendarDateManager extends CalendarManager {

    public static function isValid($dateString) {
        if (self::isDateValid($dateString)) {
            return date("Y-m-d", \strtotime($dateString));
        }

        return "-";
    }

    private static function isDateValid($dateString) {
        $intTime = \strtotime($dateString);

        //Valid since PHP 5.1.0. Previous versions return -1 on failure.
        return $intTime !== FALSE;
    }

    static function currentTime() {
        return mktime();
    }

    static function currentDateTime() {
        $intFromDateToTimeStamp = mktime();
        return mktime(0, 0, 0, date('n', $intFromDateToTimeStamp), date('j', $intFromDateToTimeStamp), date('Y', $intFromDateToTimeStamp));
    }

    static function phpTimeToMySQLTime($dtTime) {
        return date('Y-m-d', $dtTime);
    }

    static function phpTimeToMySQLTimeQuoted($dtTime) {
        return "'" . self::phpTimeToMySQLTime($dtTime) . "'";
    }

    static function calendarDateToPHPDate($strDate) {
        $iYear = (int) substr($strDate, 6, 4);
        $iMonth = (int) substr($strDate, 3, 2);
        $iDay = (int) substr($strDate, 0, 2);
        return mktime(0, 0, 0, $iMonth, $iDay, $iYear);
    }

    static function calendarDateToMySQLDate($strDate) {
        $dtDate = self::calendarDateToPHPDate($strDate);
        return self::phpTimeToMySQLTime($dtDate);
    }

    static function calendarDateToMySQLDateQuoted($strDate) {
        $dtDate = self::calendarDateToPHPDate($strDate);
        return self::phpTimeToMySQLTimeQuoted($dtDate);
    }

    static function addDaysToDate($dtDate, $iDays) {
        $arrDate = getdate($dtDate);
        $arrDate['mday'] += $iDays;

        return mktime($arrDate['hours'], $arrDate['minutes'], $arrDate['seconds'], $arrDate['mon'], $arrDate['mday'], $arrDate['year']);
    }

    static function mysqlDateToPHPDate($strDate) {
        $intFromDateToTimeStamp = strtotime($strDate);
        return mktime(0, 0, 0, date('n', $intFromDateToTimeStamp), date('j', $intFromDateToTimeStamp), date('Y', $intFromDateToTimeStamp));
    }

    static function mysqlDateToCalendarDate($strDate) {
        $dtTime = self::mysqlDateToPHPDate($strDate);
        return date('d/m/Y', $dtTime);
    }

    static function SSDateToBritishShortDate($strDate) {
        $dtTime = self::mysqlDateToPHPDate($strDate);
        return date('d/m/y', $dtTime);
    }

    static function mysqlDateToNiceDate($strDate) {
        $dtTime = self::mysqlDateToPHPDate($strDate);
        return date('jS F Y H:ia', $dtTime);
    }

    static function mysqlDateToNiceDateOnly($strDate) {
        $dtTime = self::mysqlDateToPHPDate($strDate);
        return date('jS F Y', $dtTime);
    }

    static function mysqlDateToNiceDateWithFullTextOnly($strDate) {
        $dtTime = self::mysqlDateToPHPDate($strDate);
        return date('l jS F Y', $dtTime);
    }

    static function phpTimeToNiceDateFormat($dtTime) {
        return date('l, j-m-Y', $dtTime);
    }

    static function monthFromTime($dtTime) {
        return date("m", $dtTime);
    }

    static function mysqlTimeToNiceTime($strTime) {
        $iLen = strlen($strTime);
        $strAMPM = strtoupper(substr($strTime, $iLen - 3));
        $strTime = substr($strTime, 0, -3);

        if ($strAMPM == 'PM') {
            $arrParts = explode(':', $strTime);
            $iHour = (int) $arrParts[0];
            $iHour +=12;
            $strTime = $iHour . ':' . $arrParts[1];
        }

        return $strTime;
    }

    static function getSSTimeStr($dtDate) {
        return date('H:i:s', $dtDate);
    }

    public static function getTimeStr($dtDate) {
        return date('H:i', $dtDate);
    }

    public static function ssDateToPHPDate($strDate) {
        $intFromDateToTimeStamp = strtotime($strDate);
        return mktime(0, 0, 0, date('n', $intFromDateToTimeStamp), date('j', $intFromDateToTimeStamp), date('Y', $intFromDateToTimeStamp));
    }

    public static function getDayStr($dtDate) {
        return strftime('%A', $dtDate);
    }

}
