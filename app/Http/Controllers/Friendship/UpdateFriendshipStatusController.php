<?php

namespace App\Http\Controllers\Friendship;

use App\Models\Friendship;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateFriendshipStatusRequest;
use App\Resources\Friendship\FriendshipResource;

class UpdateFriendshipStatusController extends Controller
{
    public function __invoke(UpdateFriendshipStatusRequest $request) : FriendshipResource
    {
        $friendship = Friendship::whereId($request->input('friendshipId'))
            ->first();

        if( $request->input('status') === 'accept' ) {
            $friendship->accept();
        }

        if( $request->input('status') === 'reject' ) {
            $friendship->reject();
        }

        return new FriendshipResource($friendship);
    }
}
