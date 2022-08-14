<?php

namespace App\Scopes;

use App\Team;
use App\User;
use \Illuminate\Database\Eloquent\Scope;
use \Illuminate\Database\Eloquent\Builder;
use \Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class InformativesTeamScope implements Scope
{

    /**
     * @inheritDoc
     */
    public function apply(Builder $builder, Model $model)
    {
        if (Auth::user()->profile != 'admin') {
            $supervisor_id = Team::supervisorMyTeam()->id;
            $builder->where('user_id', $supervisor_id)->orderBy('updated_at', 'desc');
        }else {
            $builder->where('user_id', '=', 2)->orderBy('updated_at', 'desc');
        }
    }
}
