<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['prefix' => 'auth','middleware' => ['web']], function() {
    Route::controller(AuthController::class)->group(function () {
        Route::post('login', 'login');
        Route::get('login', 'getLogin');
        Route::post('logout', 'logout');
    });
});

Route::group(['prefix' => 'user','middleware' => ['web']], function() {
    Route::controller(UserController::class)->group(function () {
        Route::get('/aa', 'create');
        Route::post('create', 'create');
        Route::post('logout', 'logout');
    });
});