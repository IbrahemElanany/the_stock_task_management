<?php

use Illuminate\Http\Request;
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

Route::group(['prefix' => 'v1', 'namespace' => 'App\Http\Controllers\Api'], function (){
    Route::post('login', 'UserController@login');
    Route::post('register', 'UserController@register');

    Route::group(['middleware' => 'auth:sanctum'], function (){
        Route::get('profile', 'UserController@profile');

        // tasks
        Route::resource('tasks','TaskController')->except(['create','edit']);

        // collaborations
        Route::resource('collaborations','CollaborationController')->only(['store']);

        // attachments
        Route::resource('attachments','AttachmentController')->only(['store']);
    });
});
