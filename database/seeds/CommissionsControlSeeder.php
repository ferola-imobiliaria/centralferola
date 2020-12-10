<?php

namespace Database\Seeders;

use App\CommissionsControl;
use Illuminate\Database\Seeder;

class CommissionsControlSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $commissions = CommissionsControl::factory()->count(20)->create();
    }
}
