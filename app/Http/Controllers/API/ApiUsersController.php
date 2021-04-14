<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ApiUsersResource;
use App\Models\ApiUsers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ApiUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data_users = ApiUsers::all();

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
        $accessToken = $user->createToken('authToken')->accessToken;
        // dd($accessToken);
        // return response(['user' => $user, 'access_token' => $accessToken], 201);
        return response([
            'user'          => new ApiUsersResource($user),
            'access_token'  => $accessToken,
            'message'       => 'Create successfully'
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ApiUsers  $apiUsers
     * @return \Illuminate\Http\Response
     */
    public function show(ApiUsers $apiUsers, $id)
    {
        $data_users = ApiUsers::where('id', $id)->first();
        return response([
            'apiUsers'      => new ApiUsersResource($data_users),
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
        $apiUsers = ApiUsers::find($request->id);
        $apiUsers->name   = $request->name;
        $apiUsers->save();

        return response([
            'apiUsers'   => new ApiUsersResource($apiUsers),
            'message'       => 'Update successfully'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ApiUsers  $apiUsers
     * @return \Illuminate\Http\Response
     */
    public function destroy(ApiUsers $apiUsers, $id)
    {
        $apiUsers = ApiUsers::find($id);

        if ($apiUsers) {
            $destroy = ApiUsers::destroy($id);

            if ($destroy) {
                return response(['message' => 'Destroy successfully']);
            } else {
                return response(['message' => 'Destroy Fail!!']);
            }
        } else {
            return response(['message' => 'Missing']);
        }
    }
}
