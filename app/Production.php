<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Production extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'captured_properties',
        'captured_exclusivities',
        'published_ads',
        'plaques',
        'proposals'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function (Model $model) {
            $userId = Auth::id();
            $model->user_id = $userId;
        });
    }



    /**
     * Função que retorna a soma individual dos itens da produção mensal do usuário
     * @param $user_id
     * @param $month
     * @param $year
     * @return mixed
     */
    public static function userMonthProduction(int $user_id, int $month, int $year)
    {
        $productions = User::findOrFail($user_id)
            ->productions()
            ->select(
                DB::raw('SUM(captured_properties) as captured_properties'),
                DB::raw('SUM(captured_exclusivities) as captured_exclusivities'),
                DB::raw('SUM(published_ads) AS published_ads'),
                DB::raw('SUM(plaques) as plaques'),
                DB::raw('SUM(proposals) AS proposals')
            )
            ->whereMonth('date', $month)
            ->whereYear('date', $year)
            ->first();

        return collect($productions);
    }

    /**
     * Função que retorna a soma individual dos itens da produção anual do usuário
     * @param int $user_id
     * @param int $year
     * @return mixed
     */
    public static function userYearProduction(int $user_id, int $year)
    {
        $productions = User::findOrFail($user_id)
            ->productions()
            ->select(
                DB::raw('SUM(captured_properties) as captured_properties'),
                DB::raw('SUM(captured_exclusivities) as captured_exclusivities'),
                DB::raw('SUM(published_ads) AS published_ads'),
                DB::raw('SUM(plaques) as plaques'),
                DB::raw('SUM(proposals) AS proposals')
            )
            ->whereYear('date', $year)
            ->first();

        return collect($productions);
    }

    /**
     * Retorma a soma do mês de um campo da produção de um usuário
     * @param int $user_id
     * @param string $field
     * @param array $months
     * @param int $year
     * @return
     */
    public static function sumFieldProduction(int $user_id, string $field, array $months, int $year)
    {
        $production = User::findOrFail($user_id)
            ->productions()
            ->select(
                DB::raw("SUM({$field}) as value")
            )
            ->whereRaw('MONTH(DATE) IN (' . implode(',', $months) . ')')
            ->whereYear('date', $year)
            ->first();

        return $production;
    }
}
