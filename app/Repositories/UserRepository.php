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
        return User::where('profile', '!=', 'admin')->get();
    }
}
