<?php


namespace App\Repositories;


use App\User;

class UserRepository implements UserRepositoryInterface
{

    public function getRealtors()
    {
        return User::where('profile', '!=', 'admin')->get();
    }
}
