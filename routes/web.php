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

Route::get('/', [IndexController::class, 'index'])->name('user.index');
Route::get('/addUser', [IndexController::class, 'create'])->name('user.create');
Route::post('/store', [IndexController::class, 'store'])->name('user.store');
Route::get('/editUsers/{id}', [IndexController::class, 'edit'])->name('user.edit');
Route::patch('/updateUsers/{id}', [IndexController::class, 'update'])->name('user.update');
Route::delete('/destroyUsers/{id}', [IndexController::class, 'destroy'])->name('user.destroy');
