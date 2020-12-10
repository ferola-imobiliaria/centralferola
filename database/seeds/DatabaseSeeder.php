<?php

use Database\Seeders\TeamSeeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\CommissionsControlSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(TeamSeeder::class);
        $this->call(UserSeeder::class);
//        $this->call(CommissionsControlSeeder::class);
    }
}
