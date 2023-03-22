<?php

use App\Http\Controllers\API\AuthController;
use Illuminate\Support\Facades\Route;

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

Route::post('/auth/register', [AuthController::class, 'createUser']);
Route::post('/auth/login', [AuthController::class, 'loginUser']);

Route::group(['prefix' => 'v1'], function () {

    Route::apiResource('posts', \App\Http\Controllers\API\V1\PostController::class);
    Route::apiResource('posts', \App\Http\Controllers\API\V1\PostController::class)->middleware('auth:sanctum')->only('store', 'update', 'delete');
});
