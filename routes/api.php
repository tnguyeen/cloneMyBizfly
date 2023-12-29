<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

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

Route::get('/getUser', function (Request $request) {
    $user = DB::select('select username from user where username = ?', [$request->username]);
    return $user;
});

Route::get('/login', function (Request $request) {
    $user = DB::select('select * from user where username = ?', [$request->username]);
    if($user[0]->password == $request->password){
        return response([
            'result' => true,
            'data' => $user
        ]);
    } else{
        return response([
            'result' => false,
            'data' => 'Sai mật khẩu!'
        ]);
    }
    
});