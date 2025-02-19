<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterRequest;

class AuthController extends Controller
{
    public function register(RegisterRequest $request){
       $fields = $request->validated();

       $user = User::create($fields);
       $token = $user->createToken($request->name);

       return [
          'user' => $user,
          'token' => $token->plainTextToken
       ];
    }

    public function login(LoginRequest $request){

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)){
            return [
                "message"=>"Invalid Credentials", 
            ];
        }
        
        $token = $user->createToken($user->name);

        return [
            'user' => $user,
            'token' => $token->plainTextToken
         ];
    }

    public function logOut(Request $request){
        $request->user()->tokens()->delete();
        
        return [
            'message' => 'You are Logged Out'
        ];
    }
}
