<?php


namespace App\Repositories;


use App\CommissionsControl;
use App\Helpers\Date;
use App\Team;
use App\User;
use Illuminate\Support\Arr;


class ProductionRepository implements ProductionRepositoryInterface
{

    public function getTeamProduction(int $team, int $month, int $year = null)
    {
        $year = $year ?? date('Y');

        $team = Team::findOrFail($team);

        $data = collect([]);

        foreach ($team->users as $user) {
            $data->put($user->name_short,
                $user->productions()
                    ->selectRaw("
                        COALESCE(SUM(captured_properties), 0) as captured_properties,
                        COALESCE(SUM(captured_exclusivities), 0) as captured_exclusivities,
                        COALESCE(SUM(published_ads), 0) as published_ads,
                        COALESCE(SUM(plaques), 0) as plaques,
                        COALESCE(SUM(proposals), 0) as proposals
                    ")
                    ->whereMonth('date', $month)
                    ->whereYear('date', $year)
                    ->first()
            );

//            Arr::add($data[$user->name_short], 'sales', $user->commissions()
//                ->whereMonth('sale_date', $month)
//                ->whereYear('sale_date', $year)
//                ->count());


        }

        return $data;
    }

    /**
     * @param int $user_id
     * @param string $field
     * @param null $year
     * @return \Illuminate\Support\Collection
     */
    public function getIndividualProduction($user_id, $field, $year = null)
    {
        $user = User::findOrFail($user_id);

        $year = $year ?? date('Y');

        $data = collect([]);

        for ($i = 1; $i <= count(months('number')); $i++) {
            $data->push(
                $user->productions()
                    ->whereMonth('date', $i)
                    ->WhereYear('date', $year)
                    ->sum($field)
            );
        }

        return $data;
    }

    public function getIndividualYearProduction(User $user, int $year = null)
    {
        $year = $year ?? date('Y');

        $data = collect([]);

        for ($i = 1; $i <= count(months('number')); $i++) {
            $data->put($i,
                $user->productions()
                    ->selectRaw("
                        SUM(captured_properties) as captured_properties,
                        SUM(captured_exclusivities) as captured_exclusivities,
                        SUM(published_ads) as published_ads,
                        SUM(plaques) as plaques,
                        SUM(proposals) as proposals"
                    )
                    ->whereMonth('date', $i)
                    ->WhereYear('date', $year)
                    ->first()
            );
        }

        return $data;
    }

    /**
     * Função que retorna o ranking de corretores por item de produção anual
     *
     * @param string $field
     * @param string $store
     * @param int|null $year
     * @return mixed
     */
    public function getRankingProduction(string $field, string $store = null, int $year = null)
    {
        $year = $year ?? date('Y');

        $data = CommissionsControl::join('users', 'users.id', '=', 'commissions_controls.user_id')
            ->selectRaw("users.*, SUM($field) as $field")
            ->when($store, function ($query, $store) {
                return $query->where('commissions_controls.store', $store);
            })
            ->whereYear('sale_date', $year)
            ->groupBy('user_id')
            ->orderBy($field, 'desc')
            ->get();

        return $data;
    }

    public function getProductionMonth(User $user, int $month, int $year = null)
    {
        $year = $year ?? date('Y');

        $monthCalendar = Date::monthCalendar($month, $year);

        $userProductions = $user->productions()
            ->whereMonth('date', $month)
            ->whereYear('date', $year)
            ->orderBy('date')
            ->get();

        $data = collect([]);

        if (!$userProductions->isEmpty()) {
            foreach ($monthCalendar as $day) {
                foreach ($userProductions as $prod) {
                    if ($prod->date == $day) {
                        $dayProd = $prod;
                        break;
                    } else {
                        $dayProd = null;
                    }
                }
                $data->put($day, $dayProd);
            }
        } else {
            foreach ($monthCalendar as $day) {
                $data->put($day, 0);
            }
        }

        return $data;
    }
}
