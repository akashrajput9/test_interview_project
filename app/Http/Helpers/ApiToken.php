<?php 

namespace App\http\Helpers;

use App\User;
use Illuminate\Support\Str;

class ApiToken {
    public static function updateAndGetToken($userId){
        $token = Str::random(80);

        $user = User::find($userId);
        $user->api_token = hash('sha256', $token);
        $user->save();

        return $token;
    }

    
}