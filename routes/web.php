<?php

use App\Http\Controllers\UserController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get("userList", [UserController::class, 'userList'])->name("userList");

Route::post("userStore", [UserController::class, 'userStore'])->name("userStore");

Route::get("userEdit", [UserController::class, 'userEdit'])->name("userEdit");

Route::post("userUpdate", [UserController::class, 'userUpdate'])->name("userUpdate");

Route::get("userDelete", [UserController::class, 'userDelete'])->name("userDelete");

Route::get('/states/{countryId}', [UserController::class, 'getStates']);

Route::get('/cities/{stateId}', [UserController::class, 'getCities']);
