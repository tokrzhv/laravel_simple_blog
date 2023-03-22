<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [\App\Http\Controllers\Main\IndexController::class, 'index'])->name('main.index');

Route::get('/posts', [\App\Http\Controllers\Post\PostController::class, 'index'])->name('post.index');
Route::get('/posts/{post}', [\App\Http\Controllers\Post\PostController::class, 'show'])->name('post.show');

Route::group(['middleware' => 'auth'], function(){
    Route::get('/post/create', [\App\Http\Controllers\Post\PostController::class, 'create'])->name('post.create');
    Route::post('post/', [\App\Http\Controllers\Post\PostController::class, 'store'])->name('post.store');
    Route::get('post/{post}/edit', [\App\Http\Controllers\Post\PostController::class, 'edit'])->name('post.edit');
    Route::patch('post/{post}', [\App\Http\Controllers\Post\PostController::class, 'update'])->name('post.update');
    Route::delete('post/{post}', [\App\Http\Controllers\Post\PostController::class, 'destroy'])->name('post.destroy');
});

Auth::routes();
