<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ApiUsersResource;
use App\Models\ApiUsers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ApiUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data_users = User::all();

        if($data_users) {
            return response([
                'users' => ApiUsersResource::collection($data_users),
                'message'   => 'Retrieved Successfully'
            ], 200);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'name'  =>  'required|max:55',
            'email' =>  'email|required|unique:users',
            'password'  =>  'required'
        ]);

        $validateData['password'] = Hash::make($request->password);
        $user = User::create($validateData);
        // $accessToken = $user->createToken('authToken')->accessToken;
        // dd($accessToken);
        // return response(['user' => $user, 'access_token' => $accessToken], 201);
        return response(['user' => $user], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ApiUsers  $apiUsers
     * @return \Illuminate\Http\Response
     */
    public function show(ApiUsers $apiUsers)
    {
        // dd($apiUsers);
        // $test = new ApiUsersResource($apiUsers);

        // dd($test);
        // $apiUsers = '1';
        return response([
            'apiUsers'      => new ApiUsersResource($apiUsers),
            'message'       => 'Retrieved Successfully'
        ], 200);


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ApiUsers  $apiUsers
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ApiUsers $apiUsers)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ApiUsers  $apiUsers
     * @return \Illuminate\Http\Response
     */
    public function destroy(ApiUsers $apiUsers)
    {
        //
    }
}
