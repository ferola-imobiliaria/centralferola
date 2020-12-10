<?php

namespace Database\Seeders;


use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'uuid' => Str::uuid(),
            'name' => 'Filipe Araújo Macêdo Costa',
            'name_short' => 'Filipe Costa',
            'email' => 'filipe@ferola.com.br',
            'username' => 'filipe',
            'cpf' => '994.114.901-15',
            'creci' => '00000',
            'phone' => '(61) 9 98149-3663',
            'profile' => 'admin',
            'password' => bcrypt('filipe'),
            'password_change' => 0,
            'photo' => null,
        ]);


        $users = User::factory()->count(20)->create();
    }
}
