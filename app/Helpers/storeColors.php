<?php
if (!function_exists('storeColors')) {

    function storeColors($store, $type = 'colorHex'): string
    {
        if ($type == 'colorHex') {
            switch ($store) {
                case "sede":
                    return "#28a745";
                case "noroeste" :
                    return "#dc3545";
                case "aguas_claras" :
                    return "#17a2b8";
                default:
                    exit();
            }
        } elseif ($type == 'colorName') {
            switch ($store) {
                case "sede":
                    return "success";
                case "noroeste" :
                    return "danger";
                case "aguas_claras" :
                    return "info";
                default:
                    exit();
            }
        } else {
            exit();
        }
    }

}
