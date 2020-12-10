<?php

if (!function_exists('monthsOfQuarter')) {

    function monthsOfQuarter($quarter)
    {
        switch ($quarter) {
            case 1:
                return array(1, 2, 3);
            case 2:
                return array(4, 5, 6);
            case 3:
                return array(7, 8, 9);
            case 4:
                return array(10, 11, 12);
            default:
                exit();
        }
    }
}
