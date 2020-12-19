<?php

if (!function_exists('getUserCpf')) {

    function getUserCpf($user_id)
    {
        $exist = \DB::table('users')->where('id', $user_id)->exists();

        if ($exist) {
            return \DB::table('users')->where('id', $user_id)->first()->cpf;
        } else {
            return null;
        }
    }
}
