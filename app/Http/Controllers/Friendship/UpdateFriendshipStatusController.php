<?php

namespace App\Http\Controllers\Friendship;

use App\Models\Friendship;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateFriendshipStatusRequest;

class UpdateFriendshipStatusController extends Controller
{
    public function __invoke(UpdateFriendshipStatusRequest $request) : Response
    {
        $friendship = Friendship::whereId($request->input('friendshipId'))
            ->first();

        if( $request->input('status') === 'accept' ) {
            $friendship->accept();
        }

        if( $request->input('status') === 'reject' ) {
            $friendship->reject();
        }

        return response('Friendship status updated.', 200);
    }
}
