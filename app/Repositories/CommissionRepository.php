<?php

namespace App\Repositories;

use App\CommissionsControl;
use App\User;
use Illuminate\Support\Facades\DB;

class CommissionRepository implements CommissionRepositoryInterface
{

    /**
     * @param int $user_id
     * @param string $field
     * @param int|null $year
     * @return \Illuminate\Support\Collection
     */
    public function getIndividualCommission(int $user_id, string $field, int $year = null)
    {
        $year = $year ?? date('Y');

        switch ($field) {
            case 'realtor_commission':
                $field_user = 'user_id';
                break;
            case 'catcher_commission':
                $field_user = 'catcher';
                break;
            case 'exclusive_commission':
                $field_user = 'exclusive';
                break;
            default:
                exit();
        }

        $data = collect([]);

        for ($i = 1; $i <= count(months('number')); $i++) {
            $data->push(
                CommissionsControl::
                where($field_user, $user_id)
                    ->groupBy(DB::raw("MONTH(sale_date)"))
                    ->whereMonth('sale_date', $i)
                    ->whereYear('sale_date', $year)
                    ->sum($field)
            );
        }
        return $data;
    }

    /**
     * Função que retorna o valor de comissão recebido pela loja
     *
     * @param null $store
     * @param null $year
     * @return \Illuminate\Support\Collection
     */
    public function getCommissionStore($store = null, $year = null)
    {
        $year = $year ?? date('Y');

        $data = collect([]);

        for ($i = 1; $i <= count(months('number')); $i++) {
            $data->put($i,
                CommissionsControl::selectRaw("MONTH(sale_date) as month")
                    ->whereMonth('sale_date', $i)
                    ->whereYear('sale_date', $year)
                    ->when($store, function ($query, $store) {
                        return $query->where('store', $store);
                    })
                    ->groupBy(DB::raw("MONTH(sale_date)"))
                    ->sum('real_estate_commission')
            );
        }

        return $data;
    }

    /**
     * Função que retorna o valor de VGV recebido pela loja
     *
     * @param null $store
     * @param null $year
     * @return \Illuminate\Support\Collection
     */
    public function getVgvStore($store = null, $year = null)
    {
        $year = $year ?? date('Y');

        $data = collect();

        for ($i = 1; $i <= count(months('number')); $i++) {
            $data->put($i,
                CommissionsControl::whereMonth('sale_date', $i)
                    ->whereYear('sale_date', $year)
                    ->when($store, function ($query, $store) {
                        return $query->where('store', $store);
                    })
                    ->groupBy(DB::raw('MONTH(sale_date)'))
                    ->sum('sale_value')
            );
        }

        return $data;
    }

    /**
     * @param User $user
     * @param int|null $month
     * @param int|null $year
     * @return int|mixed
     */
    public function getVgvRealtor(User $user, int $month = null, int $year = null)
    {
        $year = $year ?? date('Y');

        $vgv = $user->commissions()
            ->when($month, function ($query, $month) {
                return $query->whereMonth('sale_date', $month);
            })
            ->whereYear('sale_date', $year)
            ->sum('sale_value');

        return $vgv;
    }

    public function getMonthsVgv(User $user, int $year = null)
    {

        $year = $year ?? date('Y');

        $data = collect([]);

        for ($i = 1; $i <= count(months('number')); $i++) {
            $data->put($i,
                $user->commissions()
                    ->whereMonth('sale_date', $i)
                    ->whereYear('sale_date', $year)
                    ->sum('sale_value')
            );
        }

        return $data;
    }

    public function getQtdSalesRealtor($user, $year = null)
    {
        $year = $year ?? date('Y');

        $data = collect([]);

        for ($i = 1; $i <= count(months('number')); $i++) {
            $data->put($i,
                $user->commissions()
                    ->whereMonth('sale_date', $i)
                    ->whereYear('sale_date', $year)
                    ->count()
            );
        }

        return $data;
    }

    /**
     *
     * @param int $user_id
     * @param string $field
     * @param int|null $year
     * @return \Illuminate\Support\Collection
     */
    public function getQtdItem(int $user_id, string $field, int $year = null)
    {
        $year = $year ?? date('Y');

        switch ($field) {
            case 'captures_sold':
                $field_user = 'catcher';
                break;
            case 'exclusivities_sold':
                $field_user = 'exclusive';
                break;
            default:
                exit();
        }

        $data = collect([]);

        for ($i = 1; $i <= count(months('number')); $i++) {
            $data->put($i,
                CommissionsControl::where($field_user, $user_id)
                    ->whereMonth('sale_date', $i)
                    ->whereYear('sale_date', $year)
                    ->count()
            );
        }

        return $data;
    }
}
