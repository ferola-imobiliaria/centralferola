<?php

if (!function_exists('getUserName')) {

    function getUserName($user_id)
    {
        $exist = \DB::table('users')->where('id', $user_id)->exists();

        if ($exist) {
            return \DB::table('users')->where('id', $user_id)->first()->name;
        } else {
            return null;
        }
    }
}
