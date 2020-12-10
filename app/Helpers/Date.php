<?php

namespace App\Helpers;

use Carbon\Carbon;

class Date
{

    /**
     * @param $month
     * @param $year
     */
    public static function daysInMonth($month, $year)
    {
        $dateFormatted = $year . '-' . $month;
        $date = Carbon::parse($dateFormatted);
        $daysInMonth = $date->daysInMonth;

        return $daysInMonth;
    }

    /**
     * @param $month
     * @param $year
     */
    public static function monthCalendar($month, $year)
    {
        $daysInMonth = self::daysInMonth($month, $year);

        for ($i = 1; $i <= $daysInMonth; $i++) {
            $date = Carbon::createFromDate($year, $month, $i);
            $dates[] = $date->toDateString();
        }

        return $dates;
    }

    public static function allMonths($type = 'name')
    {
        $date = new Carbon();

        switch ($type) {
            case 'number':
                for ($i = 0; $i < 12; $i++) {
                    $allMonths[] = $date->months($i)->addMonths(1)->month;
                }
                return $allMonths;
                break;

            case 'name':
                for ($i = 0; $i < 12; $i++) {
                    $allMonths[] = $date->months($i)->addMonths(1)->monthName;
                }
                return $allMonths;
                break;
        }
    }

    public static function getMonthNow($type = 'number')
    {
        $date = Carbon::now();

        switch ($type) {
            case 'number':
                return $date->month;
                break;
            case 'name':
                return $date->monthName;
                break;
        }

    }

    /**
     * @param $startYear
     * @param $endYear
     */
    public static function intervalYear($startYear, $endYear)
    {
        for ($i = $startYear; $i >= $endYear; $i--) {
            $years[] = $i;
        }

        return $years;
    }
}
