<?php

use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\DB;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.User.{id}', function ($user, $id) {
    return (int)$user->id === (int)$id;
});

Broadcast::channel('project.{id}', function ($user, $id) {
//    $id = \Vinkla\Hashids\Facades\Hashids::decode($id);
    return DB::table('projects')
        ->
        leftJoin('project_user', 'project_user.project_id', '=', (int)$id)
        ->where(function ($query) use ($user) {
            $query
                ->where('projects.user_id', $user->id)
                ->orWhere('project_user.user_id', $user->id);
        })
        ->exists();
});
