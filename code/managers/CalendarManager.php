<?php

/**
 * Description of CalendarManager
 *
 * @author Patrick Chitovoro
 */
class CalendarManager extends Object
{

    const MySqlDateFormat = 'Y-m-d';
    private $today;

    /**
     *
     * @var type
     */
    private $date_format = 'Y-m-d';

    /**
     *
     * @var type
     */
    private $currentView = 'month';

    /**
     *
     * @var type
     */
    private $currentDate;

    /**
     *
     * @var type
     */
    private $currentWeek;

    public function __construct()
    {
        parent::__construct();
        $this->currentDate = date($this->date_format);
    }

    static function geDateRange($start_date, $range = 10)
    {
        $begin = new DateTime($start_date);
        $ts = strtotime($start_date);
        $fortnight = date(self::MySqlDateFormat, sfTime::add($ts, $range));
        $end_date = new DateTime($fortnight);
        $interval = new DateInterval('P1D');
        $dateRange = new DatePeriod($begin, $interval, $end_date);
        $days = array();
        foreach ($dateRange as $date) {
            $days[] = $date->format("Y-m-d");
        }

        return $days;
    }

    function isFirstDayOfTheMonth($date)
    {
        if (date('j', strtotime($date)) === '1') {
            return 'FirstDay';
        }
        return false;
    }

    static function isLastDayOfTheMonth($date)
    {
        $last_day = date('t', strtotime($date));
        if (date('j', strtotime($date)) === $last_day) {
            return 'LastDay';
        }
        return false;
    }

    static function isWeekend($date)
    {
        $date = date('D', strtotime($date));
        if (in_array($date, array("Sat", "Sun"))) {
            return 'weekend';
        }
        return false;
    }

    static function isDateOnWeekend($date)
    {
        return (date('N', strtotime($date)) >= 6);
    }

    static function formatedDate($date)
    {
        $time = strtotime($date);
        return sprintf("<span class='day'>%s</span><span class=\"date\">%s</span><span>%s</span>", date('D', $time), date('d', $time), date('M', $time));
    }

}
