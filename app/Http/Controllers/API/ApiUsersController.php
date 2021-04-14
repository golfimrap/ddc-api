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

    /**
        * @OA\Info(
        *    title="DDC-API API Document",
        *    version="1.0.0",
        * )
    */

    /** @OA\Get(
        ** path="/api/users",
        *   tags={"Users"},
        *   summary="Get Users List",
        *   operationId="Users Index",
        *   @OA\RequestBody(
        *       required=true,
        *       description="Users Detail",
        *       @OA\JsonContent(
        *           required={
        *               "id",
        *               "name",
        *               "email",
        *               "email_verified_at",
        *               "password",
        *               "remember_token",
        *               "created_at",
        *               "updated_at",
        *           },
        *           @OA\Property(property="id", type="bigint", example="1"),
        *           @OA\Property(property="name", type="varchar", example="จอห์น ชาวไร่"),
        *           @OA\Property(property="email", type="varchar", example="user1@mail.com"),
        *           @OA\Property(property="email_verified_at", type="timestamp", example=""),
        *           @OA\Property(property="password", type="varchar", example="PassWord12345"),
        *           @OA\Property(property="remember_token", type="varchar", example=""),
        *           @OA\Property(property="created_at", type="timestamp", example="2021-04-13 15:14:44"),
        *           @OA\Property(property="updated_at", type="timestamp", example="2021-04-14 01:22:08"),
        *       ),
        *   ),
        *   @OA\Response(
        *       response=200,
        *       description="Success",
        *       @OA\JsonContent(
        *           @OA\Property(property="message", type="string", example="Retrieved Successfully")
        *       )
        *   ),
        *   @OA\Response(
        *      response=401,
        *       description="Unauthenticated"
        *   ),
        *   @OA\Response(
        *      response=400,
        *      description="Bad Request"
        *   ),
        *   @OA\Response(
        *      response=404,
        *      description="not found"
        *   ),
        *      @OA\Response(
        *          response=403,
        *          description="Forbidden"
        *      )
        *)
    **/

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

    /**
    * @OA\post(
        **  path="api/users",
        *   summary="Store new users",
        *   description="detail by name, email, password",
        *   operationId="User Store",
        *   tags={"Users"},
        *   @OA\Parameter(
        *       required=true,
        *       name="email",
        *       description="email",
        *       in="path",
        *       @OA\Schema(
        *           type="string"
        *       ),
        *   ),
        *   @OA\Parameter(
        *       required=true,
        *       name="password",
        *       description="password",
        *       in="path",
        *       @OA\Schema(
        *           type="string"
        *       )
        *   ),
        *   @OA\Parameter(
        *       required=true,
        *       name="name",
        *       description="name",
        *       in="path",
        *       @OA\Schema(
        *           type="string"
        *       )
        *   ),
        *   @OA\RequestBody(
        *       required=true,
        *       description="Pass user credentials",
        *       @OA\JsonContent(
        *           required={"name","email","password"},
        *           @OA\Property(property="name", type="string", format="name", example="จอห์น ชาวไร่"),
        *           @OA\Property(property="password", type="string", format="password", example="PassWord12345"),
        *           @OA\Property(property="email", type="string", format="email", example="user1@mail.com"),
        *       ),
        *   ),
        *   @OA\Response(
        *       response=201,
        *       description="Create",
        *       @OA\JsonContent(
        *           @OA\Property(property="message", type="string", example="Create successfully")
        *       )
        *   )
        * ),
    **/

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

    /** @OA\Get(
        ** path="/api/users/{id}",
        *   tags={"Users"},
        *   summary="Show Users Detail",
        *   operationId="Users Show",
        *   @OA\Parameter(
        *       required=true,
        *       name="id",
        *       description="id",
        *       in="path",
        *       @OA\Schema(
        *           type="integer"
        *       )
        *   ),
        *   @OA\Response(
        *       response=200,
        *       description="Success",
        *       @OA\JsonContent(
        *           @OA\Property(property="message", type="string", example="Retrieved Successfully")
        *       )
        *   ),
        *   @OA\Response(
        *      response=401,
        *       description="Unauthenticated"
        *   ),
        *   @OA\Response(
        *      response=400,
        *      description="Bad Request"
        *   ),
        *   @OA\Response(
        *      response=404,
        *      description="not found"
        *   ),
        *      @OA\Response(
        *          response=403,
        *          description="Forbidden"
        *      )
        *)
    **/

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

    /** @OA\patch(
        ** path="/api/users/{id}",
        *   tags={"Users"},
        *   summary="Update Users",
        *   operationId="Users Update",
        *   @OA\Parameter(
        *       required=true,
        *       name="id",
        *       description="id",
        *       in="path",
        *       @OA\Schema(
        *           type="integer"
        *       )
        *   ),
        *   @OA\RequestBody(
        *       required=true,
        *       description="Pass user credentials",
        *       @OA\JsonContent(
        *           required={"name"},
        *           @OA\Property(property="id", type="integer", format="id", example="1"),
        *           @OA\Property(property="name", type="string", format="name", example="จอห์น ชาวไร่"),
        *       ),
        *   ),
        *   @OA\Response(
        *       response=200,
        *       description="Success",
        *       @OA\JsonContent(
        *           @OA\Property(property="message", type="string", example="Retrieved Successfully")
        *       )
        *   ),
        *   @OA\Response(
        *      response=401,
        *       description="Unauthenticated"
        *   ),
        *   @OA\Response(
        *      response=400,
        *      description="Bad Request"
        *   ),
        *   @OA\Response(
        *      response=404,
        *      description="not found"
        *   ),
        *      @OA\Response(
        *          response=403,
        *          description="Forbidden"
        *      )
        *)
    **/

    public function update(Request $request, ApiUsers $apiUsers)
    {
        $apiUsers = ApiUsers::find($request->id);
        $apiUsers->name   = $request->name;
        $apiUsers->save();

        return response([
            'apiUsers'      => new ApiUsersResource($apiUsers),
            'message'       => 'Update successfully'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ApiUsers  $apiUsers
     * @return \Illuminate\Http\Response
     */

    /** @OA\Delete(
        ** path="/api/users/{id}",
        *   tags={"Users"},
        *   summary="Delete existing User",
        *   operationId="Users Delete",
        *   @OA\Parameter(
        *       required=true,
        *       name="id",
        *       description="id",
        *       in="path",
        *       @OA\Schema(
        *           type="integer"
        *       )
        *   ),
        *   @OA\Response(
        *       response=200,
        *       description="Success",
        *       @OA\JsonContent(
        *           @OA\Property(property="message", type="string", example="Destroy successfully")
        *       )
        *   ),
        *   @OA\Response(
        *      response=401,
        *       description="Unauthenticated"
        *   ),
        *   @OA\Response(
        *      response=400,
        *      description="Bad Request"
        *   ),
        *   @OA\Response(
        *      response=404,
        *      description="not found"
        *   ),
        *      @OA\Response(
        *          response=403,
        *          description="Forbidden"
        *      )
        *)
    **/

    public function destroy(ApiUsers $apiUsers, $id)
    {
        $apiUsers = ApiUsers::find($id);

        if ($apiUsers) {
            $destroy = ApiUsers::destroy($id);

            if ($destroy) {
                return response(['message' => 'Destroy successfully'], 200);
            } else {
                return response(['message' => 'Destroy Fail!!']);
            }
        } else {
            return response(['message' => 'Missing']);
        }
    }
}
