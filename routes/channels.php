<?php

use App\Resources\User\UserResource;
use Illuminate\Support\Facades\Broadcast;

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

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return auth()->check();
});

Broadcast::channel('User.Presence', function ($user) {
    if (auth()->check()) {
        return new UserResource($user);
    }
});
