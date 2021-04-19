<?php

use App\Http\Controllers\DiseaseController;
use App\Http\Controllers\IndexController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [IndexController::class, 'index'])->name('user.index');
Route::get('/addUser', [IndexController::class, 'create'])->name('user.create');
Route::post('/store', [IndexController::class, 'store'])->name('user.store');
Route::get('/editUsers/{id}', [IndexController::class, 'edit'])->name('user.edit');
Route::patch('/updateUsers/{id}', [IndexController::class, 'update'])->name('user.update');
Route::delete('/destroyUsers/{id}', [IndexController::class, 'destroy'])->name('user.destroy');

Route::get('/getDisease/{disease_id}', [DiseaseController::class, 'getDisease']);
Route::get('/getDiseaseSex/{disease_id}/{sex_id}', [DiseaseController::class, 'getDiseaseSex']);
Route::get('/getDiseaseProvince/{disease_id}/{province_id}', [DiseaseController::class, 'getDiseaseProvince']);
Route::get('/getDiseaseAge/newborn/{disease_id}', [DiseaseController::class, 'getDiseaseAgeNewborn']);
Route::get('/getDiseaseAge/children/{disease_id}', [DiseaseController::class, 'getDiseaseAgeChildren']);
Route::get('/getDiseaseAge/working/{disease_id}', [DiseaseController::class, 'getDiseaseAgeWorking']);
Route::get('/getDiseaseAge/senile/{disease_id}', [DiseaseController::class, 'getDiseaseAgeSenile']);
