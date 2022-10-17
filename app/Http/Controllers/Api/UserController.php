<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\http\Helpers\ApiResponse;
use App\http\Helpers\ApiToken;
use App\Http\Requests\UserStoreRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        return $request->user();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        $validated = Validator::make($request->all(),[
            'name' => 'required|min:3|max:100',
            'email' => 'required|unique:users,email|max:191|min:5',
            'password' => 'required|max:16|min:8',
        ]);
        if($validated->fails()){
            return ApiResponse::fail("validation error",401,$validated->errors()->all());
        }
        try{
            $user = User::create([
                'email' => $request->email,
                'password' => $request->password,
                'name' => $request->name,
            ]);
            $user->api_token = ApiToken::updateAndGetToken($user->id);
            return ApiResponse::success("user regested successfully",200,$user);
        }catch(\Exception $e){
            return ApiResponse::fail("Query Error",400,[$e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
