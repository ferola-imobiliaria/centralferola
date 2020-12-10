<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Report extends Model
{
    use HasFactory;

    public static function getTeam()
    {
        $userAuth = Auth::user();

        switch ($userAuth->profile) {
            case 'supervisor' :
                $team = $userAuth->team()->get();
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
