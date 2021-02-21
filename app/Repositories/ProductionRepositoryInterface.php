<?php


namespace App\Repositories;

use App\User;

interface ProductionRepositoryInterface
{

    public function getTeamProduction(int $team, int $month, int $year = null);

    public function getIndividualProduction(int $user_id, string $field, $year = null);

    public function getIndividualYearProduction(User $user, int $year = null);

    public function getRankingProduction(string $field, string $store = null, int $year = null);

    public function getProductionMonth(User $user, int $month, int $year = null);
}
