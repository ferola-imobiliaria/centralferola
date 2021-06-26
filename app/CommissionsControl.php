<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Winners\CommisionControl;

class CommissionsControl extends Model
{
    use HasFactory;

    protected $table = "commissions_controls";

    protected $fillable = [
        "user_id",
        "store",
        "property",
        "edifice",
        "owner",
        "owner_cpf",
        "owner_phone",
        "sale_date",
        "sale_value",
        "commission_percentage",
        "commission_value",
        "realtor_percentage",
        "realtor_commission",
        "catcher",
        "catcher_percentage",
        "catcher_commission",
        "exclusive",
        "exclusive_percentage",
        "exclusive_commission",
        "supervisor",
        "supervisor_percentage",
        "supervisor_commission",
        "real_estate_commission"
    ];

    public function getRouteKeyName()
    {
        return 'uuid';
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }


    protected static function booted()
    {
        static::creating(function (Model $model) {
            $model->user_id = Auth::id();
            $model->uuid = Str::uuid();
        });
    }

    public static function getCommissionsControlUser()
    {
        if(Auth::user()->profile !== 'admin')
        {
            $commissionsControl = CommissionsControl::where('user_id', Auth::user()->id)
                ->orderBy('sale_date', 'desc')
                ->get();
        } else {
            $commissionsControl = CommissionsControl::orderBy('id', 'desc')->get();
        }

        return $commissionsControl;
    }

    /**
     *  Retorna os ganhos (comissão venda, captação, exclusividade e supervisão) por mês(es) ou por ano
     *
     * @param int $user_id
     * @param int $year
     * @param array $months
     * @return mixed
     */
    public static function sumErnings(int $user_id, int $year, array $months = [])
    {
        if (empty($months)) {
            $months = null;
        }

        $ernings['realtor'] = CommissionsControl::select(DB::raw("SUM(realtor_commission) as realtor_ernings"))
            ->where('user_id', $user_id)
            ->when($months, function ($query, $months) {
                return $query->whereRaw('MONTH(sale_date) IN (' . implode(',', $months) . ')');
            })
            ->whereYear('sale_date', $year)
            ->first();

        $ernings['catcher'] = CommissionsControl::select(DB::raw("SUM(catcher_commission) as catcher_ernings"))
            ->where('catcher', $user_id)
            ->when($months, function ($query, $months) {
                return $query->whereRaw('MONTH(sale_date) IN (' . implode(',', $months) . ')');
            })
            ->whereYear('sale_date', $year)
            ->first();

        $ernings['exclusive'] = CommissionsControl::
        select(DB::raw("SUM(exclusive_commission) as exclusive_ernings"))
            ->where('exclusive', $user_id)
            ->when($months, function ($query, $months) {
                return $query->whereRaw('MONTH(sale_date) IN (' . implode(',', $months) . ')');
            })
            ->whereYear('sale_date', $year)
            ->first();

        $ernings['supervisor'] = CommissionsControl::select(DB::raw("SUM(supervisor_commission) as supervisor_ernings"))
            ->where('supervisor', $user_id)
            ->when($months, function ($query, $months) {
                return $query->whereRaw('MONTH(sale_date) IN (' . implode(',', $months) . ')');
            })
            ->whereYear('sale_date', $year)
            ->first();

        return $ernings;
    }

    public function clearMoney($value)
    {
        return str_replace(',', '.', str_replace('.', '', $value));
    }

    public function getSaleDateAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y');
    }

    public function setSaleValueAttribute($value)
    {
        $this->attributes['sale_value'] = $this->clearMoney($value);
    }

    public function setCommissionValueAttribute($value)
    {
        $this->attributes['commission_value'] = $this->clearMoney($value);
    }

    public function setRealtorCommissionAttribute($value)
    {
        $this->attributes['realtor_commission'] = $this->clearMoney($value);
    }

    public function setCatcherCommissionAttribute($value)
    {
        $this->attributes['catcher_commission'] = $this->clearMoney($value);
    }

    public function setExclusiveCommissionAttribute($value)
    {
        if (empty($value)) {
            $this->attributes['exclusive_commission'] = "0.00";
        } else {
            $this->attributes['exclusive_commission'] = $this->clearMoney($value);
        }
    }

    public function setSupervisorCommissionAttribute($value)
    {
        $this->attributes['supervisor_commission'] = $this->clearMoney($value);
    }

    public function setRealEstateCommissionAttribute($value)
    {
        $this->attributes['real_estate_commission'] = $this->clearMoney($value);
    }
}
