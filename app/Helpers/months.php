<?php

if (!function_exists('months')) {

    function months($type): array
    {
        switch ($type) {
            case 'number':
                return [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12];
            case 'name':
                return [
                    "Janeiro",
                    "Fevereiro",
                    "Março",
                    "Abril",
                    "Maio",
                    "Junho",
                    "Julho",
                    "Agosto",
                    "Setembro",
                    "Outubro",
                    "Novembro",
                    "Dezembro"
                ];
            case 'short':
                return [
                    "Jan",
                    "Fev",
                    "Mar",
                    "Abr",
                    "Mai",
                    "Jun",
                    "Jul",
                    "Ago",
                    "Set",
                    "Out",
                    "Nov",
                    "Dez"
                ];
            default:
                exit();
        }
    }
}
