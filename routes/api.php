<?php

use App\Http\Controllers\API\ApiDiseaseController;
use App\Http\Controllers\API\ApiUsersController;
use App\Http\Controllers\API\AuthController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);

Route::apiResource('users', ApiUsersController::class)->middleware('auth:api');

Route::get('getDisease/{disease_id}', [ApiDiseaseController::class, 'countDisease']);
Route::get('getDiseaseGender/{disease_id}', [ApiDiseaseController::class, 'genderDisease']);
Route::get('getDiseaseProvince/{disease_id}', [ApiDiseaseController::class, 'provinceDisease']);
Route::get('getDiseaseAge/{disease_id}', [ApiDiseaseController::class, 'newbornDisease']);
// Route::get('getDiseaseChildren/{disease_id}', [ApiDiseaseController::class, 'childrenDisease']);
// Route::get('getDiseaseWorking/{disease_id}', [ApiDiseaseController::class, 'workingDisease']);
// Route::get('getDiseaseSenile/{disease_id}', [ApiDiseaseController::class, 'senileDisease']);
