<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PointsTableInfo extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'quarter',
        'year',
        'type',
        'value'
    ];


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * Retorna o endereço das placas penduradas, código das fotos e o endereço das esclusividades da Tabela de Pontos
     * @param User $user
     * @param $quarter
     * @param $year
     * @return array
     */
    public static function infos(User $user, $quarter, $year): array
    {
        $info['plaque_address'] = $user->pointsTableInfo()
            ->where('type', 'plaque_address')
            ->where('quarter', $quarter)
            ->where('year', $year)
            ->get(['id', 'value']);
        $info['published_ads'] = $user->pointsTableInfo()
            ->where('type', 'published_ads')
            ->where('quarter', $quarter)
            ->where('year', $year)
            ->get(['id', 'value']);
        $info['exclusivity_address'] = $user->pointsTableInfo()
            ->where('type', 'exclusivity_address')
            ->where('quarter', $quarter)
            ->where('year', $year)
            ->get(['id', 'value']);

        return $info;
    }
}
