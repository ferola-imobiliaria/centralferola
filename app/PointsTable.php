<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PointsTable extends Model
{
    use HasFactory;

    protected $table = 'points_tables';

    protected $fillable = [
        "year",
        "score_captured_properties",
        "score_captured_exclusives",
        "score_published_ads",
        "score_plaques",
        "score_sales",
        "target_first_quarter",
        "target_second_quarter",
        "target_third_quarter",
        "target_fourth_quarter"
    ];

    /**
     * Retorna os valores de produção do trimestre informado
     * @param User|null $user
     * @param int $quarter
     * @param int $year
     * @return array|int[]
     */
    public static function getValuesQuarter(User $user, int $quarter, int $year): object
    {
        $months = monthsOfQuarter($quarter);

        $productions = DB::table('productions')
            ->select(
                DB::raw('MONTH(DATE) as month'),
                DB::raw('SUM(productions.captured_properties) AS captured_properties'),
                DB::raw('SUM(productions.captured_exclusivities) as captured_exclusivities'),
                DB::raw('SUM(productions.published_ads) as published_ads'),
                DB::raw('SUM(productions.plaques) as plaques')
            )
            ->whereRaw('MONTH(productions.date) IN (' . implode(',', $months) . ')')
            ->whereYear('productions.date', $year)
            ->where('productions.user_id', $user->id)
            ->groupByRaw('MONTH(productions.date)')
            ->get();

        return $productions;
    }
}
