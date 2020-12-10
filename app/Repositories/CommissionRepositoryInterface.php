<?php

namespace App\Repositories;

use App\User;

interface CommissionRepositoryInterface
{
    public function getIndividualCommission(int $user_id, string $field, int $year = null);

    public function getCommissionStore($store = null, $year = null);

    public function getVgvStore($store = null, $year = null);

    public function getVgvRealtor(User $user, int $month = null, int $year = null);

    public function getMonthsVgv(User $user, int $year = null);

    public function getQtdSalesRealtor($user, $year = null);

    public function getQtdItem(int $user_id, string $field, int $year = null);
}
