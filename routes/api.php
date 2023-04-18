<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
//use App\Http\Controllers\UserController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::post('user/register','App\Http\Controllers\UserController@store');
Route::post('user/login','App\Http\Controllers\UserController@login');
//Route::post('user/register',[UserContoller::class, 'store']);
//Route::post('user/login','App\Http\Controllers\UserController@login');
//Route::post('login',[UserContoller::class,'login']);
// Route::post('user/login','App\Http\Controllers\UserController@login');

Route::prefix('admin')->middleware(['auth:api','isAdmin'])->group(function(){
//
});

Route::middleware(['auth:api'])->group(function(){
    Route::post('notification','App\Http\Controllers\NotificationController@store');
//
});
