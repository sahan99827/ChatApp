<?php

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

    return (int) $user->id === (int) $id;
});
Broadcast::channel('user.{userId}', function ($user, $userId) {
    return true;
    return $user->id === $userId;
});
Broadcast::channel('chat', function () {
    return true;
});
//Broadcast::channel('chat.{chatId}', function ($user, $orderId) {
//    return $user->id === Chat::findOrNew($orderId)->user_id;
//});
