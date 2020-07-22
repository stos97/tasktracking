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
        Route::get('/', 'ProjectController@getMyProjects');
        Route::post('/', 'ProjectController@create');
        Route::get('/{project}', 'ProjectController@get')->middleware('can:teamMemberAction,project');
        Route::delete('/{project}', 'ProjectController@delete')->middleware('can:ownerAction,project');
    });

    Route::prefix('checklists')->group(function () {
        Route::post('/', 'ChecklistController@create');
        Route::delete('/{checklist}', 'ChecklistController@delete')->middleware('can:teamMemberAction,checklist');
        Route::put('/{checklist}', 'ChecklistController@update')->middleware('can:teamMemberAction,checklist');
    });
});

Route::post('/register', 'UserRegistrationController@register');
Route::post('/login', 'LoginController@login');
