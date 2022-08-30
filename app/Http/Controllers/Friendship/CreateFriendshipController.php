<?php

namespace App\Http\Controllers\Friendship;

use App\Models\User;
use App\Models\Friendship;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CreateFriendshipRequest;
use App\Notifications\FriendshipRequestNotification;
use App\Resources\Friendship\FriendshipResource;


class CreateFriendshipController extends Controller
{
    public function __invoke(CreateFriendshipRequest $request) : FriendshipResource
    {
        $friendship = Friendship::firstOrCreate([
            'user_id'   => Auth::id(),
            'friend_id' => $request->input('friendId'),
            'status'    => 'pending'
        ]);

        $user = User::whereId($request->input('friendId'))->first();

        $user->notify(new FriendshipRequestNotification($friendship));

        return new FriendshipResource($friendship);
    }
}
