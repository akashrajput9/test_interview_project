<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post("/login","Auth\LoginController@login");

Route::group(['middleware' => "auth:api","namespace" => "Api"],function(){
    Route::resource("user","UserController");
    Route::resource("category","CategoryController");
    Route::resource("book","BookController");
    Route::resource("page","PageController");

});
