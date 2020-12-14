<?php


namespace App\Repositories;


use App\CommissionsControl;
use App\PointsTable;
use App\User;

class PointsTableRepository implements PointsTableRepositoryInterface
{

    /**
     * @param $quarter
     * @param null $year
     * @return mixed
     */
    public function getQuarterTotalScore(User $user, $quarter, $year = null)
    {
        $year = $year ?? date('Y');

        $production = $user->productions()
            ->selectRaw("
                        SUM(captured_properties) as captured_properties,
                        SUM(captured_exclusivities) as captured_exclusivities,
                        SUM(published_ads) as published_ads,
                        SUM(plaques) as plaques,
                        SUM(proposals) as proposals"
            )
            ->whereRaw('MONTH(DATE) IN (' . implode(',', monthsOfQuarter($quarter)) . ')')
            ->whereYear('date', $year)
            ->first();

        $points = PointsTable::where('year', $year)->first();

        $sales = $user->commissions()
            ->whereRaw('MONTH(sale_date) IN (' . implode(',', monthsOfQuarter($quarter)) . ')')
            ->whereYear('sale_date', $year)
            ->count();

        if ($points) {
            $data = ($points->score_captured_properties * $production->captured_properties) +
                ($points->score_captured_exclusives * $production->captured_exclusivities) +
                ($points->score_published_ads * $production->published_ads) +
                ($points->score_plaques * $production->plaques) +
                ($points->score_sales * $sales);
        } else {
            $data = null;
        }

        return $data;
    }

    /**
     * @param $quarter
     * @param null $year
     * @return mixed
     */
    public function getQuarterTarget($quarter, $year = null)
    {
        $year = $year ?? date('Y');

        $data = PointsTable::where('year', $year)->first();

        switch ($quarter) {
            case '1' :
                return $data->target_first_quarter ?? null;
                break;
            case '2' :
                return $data->target_second_quarter ?? null;
                break;
            case '3' :
                return $data->target_third_quarter ?? null;
                break;
            case '4' :
                return $data->target_fourth_quarter ?? null;
                break;
            default:
                exit();
        }
    }
}
