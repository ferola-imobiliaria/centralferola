<?php

if (!function_exists('currentQuarter')) {

    function currentQuarter(): int
    {
        $monthNow = date('m');

        if ($monthNow <= 3) {
            $currentTrimeste = 1;
        } else if ($monthNow <= 6) {
            $currentTrimeste = 2;
        } else if ($monthNow <= 9) {
            $currentTrimeste = 3;
        } else if ($monthNow <= 12) {
            $currentTrimeste = 4;
        }

        return $currentTrimeste;
    }
}
