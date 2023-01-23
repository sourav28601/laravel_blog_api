<?php

use App\Http\Controllers\api\BlogController;
use App\Http\Controllers\CategoryController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//BlogController Routes
Route::get('getall',[BlogController::class,'getall']);
Route::post('blog/new',[BlogController::class,'store']);
Route::get('blog/show/{id}',[BlogController::class,'show']);
Route::put('blog/update/{id}',[BlogController::class,'update']);
Route::delete('blog/delete/{id}',[BlogController::class,'delete']);

//CategoryController Routes
Route::post('category/new',[CategoryController::class,'store']);
Route::get('displayall',[CategoryController::class,'displayall']);
Route::get('category/show/{id}',[CategoryController::class,'show']);
Route::put('category/update/{id}',[CategoryController::class,'update']);
Route::delete('category/delete/{id}',[CategoryController::class,'delete']);

