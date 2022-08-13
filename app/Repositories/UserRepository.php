<?php


namespace App\Repositories;


use App\User;

class UserRepository implements UserRepositoryInterface
{
    public function getAll()
    {
        return User::all();
    }

    public function getRealtors()
    {
        return User::join('teams', 'teams.id', '=', 'users.team_id')
            ->where('profile', '!=', 'admin')
            ->get();
    }

    public function getUserTeam()
    {
        return User::join('teams', 'teams.id', '=', 'users.team_id')
            ->orderBy('name_short', 'asc')
            ->get('*');
    }

    public function getUserTeamById($id)
    {
        return User::join('teams', 'teams.id', '=', 'users.team_id')
            ->where('users.id', $id)
            ->orderBy('name_short', 'asc')
            ->get('*')
            ->toArray();
    }

    public function getUsersTeamByTeam($team)
    {
        $time = $team[0]['id'];

        return User::join('teams', 'teams.id', '=', 'users.team_id')
            ->where('teams.id', $time)
            ->orderBy('name_short', 'asc')
            ->get('users.*', 'teams.*');
    }

    public function getUsersNotAdmin()
    {
        return User::all()
            ->where('profile', '!=', 'admin');

    }
}
