<?php

use App\Http\Controllers\PostController;
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

Route::resource('/posts', PostController::class);

/* Route::post ('/post', 'App\Http\Controllers\PostController@store');
Route::get ('/posts', 'App\Http\Controllers\PostController@index');
Route::get ('/posts/{post}', 'App\Http\Controllers\PostController@show');
Route::put ('/posts/{post}', 'App\Http\Controllers\PostController@update');
Route::delete ('/posts/{post}', 'App\Http\Controllers\PostController@destroy'); */