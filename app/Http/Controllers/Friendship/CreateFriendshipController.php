<?php

namespace App\Http\Controllers\Friendship;

use App\Models\User;
use App\Models\Friendship;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CreateFriendshipRequest;
use App\Notifications\FriendshipRequestNotification;


class CreateFriendshipController extends Controller
{
    public function __invoke(CreateFriendshipRequest $request)
    {
        $friendship = Friendship::create([
            'user_id'   => Auth::id(),
            'friend_id' => $request->input('friendId'),
        ]);

        $user = User::whereId($request->input('friendId'))->first();

        $user->notify(new FriendshipRequestNotification($friendship));

        return response('Friend request was sended', 201);
    }
}
