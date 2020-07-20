<?php

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

Route::middleware('auth:api')->group(function () {

    Route::get('/me', 'UserController@meAction');

    Route::prefix('/users')->group(function () {
        Route::get('/', 'UserController@getAll');
        Route::put('/', 'UserController@editProfile');
        Route::post('/images', 'UserController@uploadImage');
    });

    Route::prefix('projects')->group(function () {
        Route::post('/', 'ProjectController@create');
        Route::get('/{project}', 'ProjectController@get');
        Route::delete('/{project}', 'ProjectController@delete')->middleware('can:ownerAction,project');
    });
});

Route::post('/register', 'UserRegistrationController@register');
Route::post('/login', 'LoginController@login');
