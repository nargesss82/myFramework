<?php

namespace Asus\Core;

use App\Models\User;

class Auth
{
    public static function check():bool
    {
        return (bool)session()->get('auth-user');
    }

    public static function login($user):void
    {
        session()->set('auth-user',$user->id);
    }

    public static function logout()
    {
        session()->remove('auth-user');
    }

    public static function user()
    {
        $user=session()->get('auth-user');
        return ((new User())->find($user));
    }

}