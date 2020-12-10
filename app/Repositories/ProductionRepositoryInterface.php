<?php


namespace App\Repositories;


interface ProductionRepositoryInterface
{

    public function getTeamProduction(int $team, int $year = null);

    public function getIndividualProduction(int $user_id, string $field, $year = null);

    public function getRankingProduction(string $field, string $store, int $year = null);
}
