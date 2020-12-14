<?php


namespace App\Repositories;

use App\User;

interface PointsTableRepositoryInterface
{
    public function getQuarterTotalScore(User $user, $quarter, $year = null);

    public function getQuarterTarget($quarter, $year = null);
}
