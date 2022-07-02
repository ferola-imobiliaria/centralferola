<?php


namespace App\Repositories;


use App\Team;
use Illuminate\Support\Facades\Auth;

class TeamRepository implements TeamRepositoryInterface
{

    public function getTeam()
    {
        $userAuth = Auth::user();

        $team = $userAuth->team;

        return $team;
    }

    public function getTeamAll()
    {
        $teams = Team::all();

        return $teams;
    }
}
