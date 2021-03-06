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
        Route::get('/{project}', 'ChecklistController@getAll')->middleware('can:teamMemberAction,project');
    });

    Route::prefix('tasks')->group(function () {
        Route::post('/', 'TaskController@create');
        Route::get('/{task}', 'TaskController@getOne')->middleware('can:teamMemberAction,task');
        Route::put('/{task}', 'TaskController@update')->middleware('can:teamMemberAction,task');

        Route::prefix('/{task}/comments')->group(function () {
            Route::post('/', 'TaskCommentController@addComment');
            Route::delete('/{comment}', 'TaskCommentController@delete')->middleware('can:ownerAction,comment');;
        });
    });

    Route::prefix('bookmarks')->group(function () {
        Route::get('/projects', 'ProjectBookmarkController@getAll');
        Route::post('/projects/{project}', 'ProjectBookmarkController@addProjectBookmark');
        Route::delete('/projects/{project}', 'ProjectBookmarkController@removeProjectBookmark');
    });

    Route::prefix('invitations')->group(function () {
        Route::post('/send', 'InvitationController@send');

    });
});

Route::get('invitations/accept/{token}', 'InvitationController@accept')->name('accept');
Route::post('/register', 'UserRegistrationController@register');
Route::post('/login', 'LoginController@login');
