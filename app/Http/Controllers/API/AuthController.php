<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function register(Request $request) {
        $validateData = $request->validate([
            'name'  =>  'required|max:55',
            'email' =>  'email|required|unique:users',
            'password'  =>  'required'
        ]);

        // dd($validateData);

        $validateData['password'] = Hash::make($request->password);
        $user = User::create($validateData);
        $accessToken = $user->createToken('authToken')->accessToken;
        // dd($accessToken);
        return response(['user' => $user, 'access_token' => $accessToken], 201);
    }

    public function login(Request $request) {
        // dd("ok");
        $loginData = $request->validate([
            'email' => 'email|required',
            'password' => 'required'
        ]);

        if (!auth()->attempt($loginData)){
            return response(['message' => 'This User does not exist, check your details'], 400);
        }
        $accessToken = auth()->user()->createToken('authToken')->accessToken;
        return response(['user' => auth()->user(), 'access_token' => $accessToken]);
    }
}
