<?php


namespace App\Repositories;


use App\Team;
use Illuminate\Support\Facades\Auth;

class TeamRepository implements TeamRepositoryInterface
{

    public function getTeam()
    {
        $userAuth = Auth::user();

        switch ($userAuth->profile) {
            case 'supervisor' :
                $team = $userAuth->team;
                break;
            case 'admin' :
                $team = Team::orderBy('name', 'asc')->get();
                break;
            default :
                exit();
        }

        return $team;
    }
}
