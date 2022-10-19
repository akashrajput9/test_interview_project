<?php

namespace App\http\Helpers;

use App\User;
use Illuminate\Support\Facades\Auth;

class AuthHelper {
    public static function setDefaultAuth(){
        $user = User::first();
        $auth = Auth::loginUsingId($user->id);
        return $auth;
    }
}
