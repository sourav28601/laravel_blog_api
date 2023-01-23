<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\StoreRegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Cookie;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    public function store(StoreRegisterRequest $request)
    {

        return User::create($request->only(['name', 'email']) + [
            'password' =>bcrypt($request->confirm_password)
        ]);
        // print_r($request->all());

    }
    public function login(LoginRequest $request){

        if(!Auth::attempt($request->validated())){
            return response([
                'error'=>'invalid credentials'
            ],Response::HTTP_UNAUTHORIZED);
        }
        $user=Auth::user();
        $jwt = $user->createToken('token')->plainTextToken;
        $cookie = cookie('jwt',$jwt,60*24);
        return response([
           'message'=>'success',
           'token'=> $jwt 
        ])->withCookie($cookie);
    }
        

    public function user(Request $request)
    {
        return $request->user();
    }

    public function logout(Request $request)
    {
        $cookie = Cookie::forget('jwt');
        return response([
            'message'=>'success'
        ])->withCookie($cookie);

    }

}
