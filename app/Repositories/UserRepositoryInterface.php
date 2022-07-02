<?php


namespace App\Repositories;


interface UserRepositoryInterface
{
    public function getAll();

    public function getRealtors();

    public function getUserTeam();

    public function getUserTeamById($id);

    public function getUsersTeamByTeam($team);

}
