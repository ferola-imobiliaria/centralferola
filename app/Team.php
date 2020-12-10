<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Team extends Model
{
    use HasFactory;

    protected $table = "teams";

    protected $fillable = [
        'supervisor_id',
        'name',
        'store'
    ];

    public function users()
    {
        return $this->hasMany(User::class, 'team_id', 'id');
    }

    /**
     * Retorna os dados do supervisor do time do usuário logado
     * @return string
     */
    public static function supervisorMyTeam()
    {
        $user_team = Auth::user()->team;
        $supervisor_team = $user_team->users()->where('profile', 'supervisor')->first([
            'id',
            'name',
            'name_short',
            'email'
        ]);

        return $supervisor_team;
    }

}
