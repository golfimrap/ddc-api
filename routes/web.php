<?php

use App\Http\Controllers\API\ApiUsersController;
use App\Http\Controllers\API\UsersController;
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

Route::get('/', [ApiUsersController::class, 'index'])->name('user.index');
Route::get('/addUser', [IndexController::class, 'create'])->name('user.create');
Route::post('/storeUsers', [IndexController::class, 'store'])->name('user.api.store');