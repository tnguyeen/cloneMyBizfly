<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Auth::routes();

Route::group(['middleware' => ['auth']], function () {
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/home', function(){return view('home');});
    Route::group(['prefix' => 'user','middleware' => ['web']], function() {
        Route::controller(UserController::class)->group(function () {
            Route::get('/', 'index');
            Route::get('/create', 'getCreate');
            Route::post('/create', 'create');
            Route::get('/edit/{id}', 'getEdit');
            Route::post('/edit', 'edit');
            Route::post('/editPassword', 'editPassword');
            Route::post('/delete/{id}', 'delete');
        });
    });
    Route::group(['prefix' => 'role','middleware' => ['isAdmin']], function() {
        Route::controller(RoleController::class)->group(function () {
            Route::get('/', 'index');
            Route::get('/create', 'getCreate');
            Route::post('/create', 'create');
            Route::get('/edit/{id}', 'getEdit');
            Route::post('/edit', 'edit');
            Route::post('/editPassword', 'editPassword');
            Route::post('/delete/{id}', 'destroy');
        });
    });
    Route::group(['prefix' => 'permission','middleware' => ['isAdmin']], function() {
        Route::controller(PermissionController::class)->group(function () {
            Route::get('/', 'index');
            Route::get('/create', 'getCreate');
            Route::post('/create', 'create');
            Route::get('/edit/{id}', 'getEdit');
            Route::post('/edit', 'edit');
            Route::post('/editPassword', 'editPassword');
            Route::post('/delete/{id}', 'destroy');
        });
    });

});