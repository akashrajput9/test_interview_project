<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\http\Helpers\ApiResponse;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request){

        $validated = Validator::make($request->all(),[
            "email" => "required|exists:users,email",
            'password' => "required",
        ]);

        if($validated->fails()){
            return ApiResponse::fail("validation error",401,$validated->errors()->all());
        }
        $credientials = $request->only("email","password");
        $auth = Auth::attempt($credientials);
        if(!$auth){
            return ApiResponse::fail("Invalid credentials",400,["Invalid user credientails"]);
        }
        $token = Str::random(80);
        $user = User::where("email",$request->email)->first();
        $user->api_token = hash('sha256', $token);
        $user->save();
        $user->api_token = $token;
        return ApiResponse::success("Loged in successfully",200,['user' => $user ] );
    }
}
