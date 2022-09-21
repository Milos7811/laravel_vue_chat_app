<?php

namespace App\Http\Controllers\Friendship;

use App\Models\Friendship;
use App\Http\Controllers\Controller;
use App\Actions\Notification\DeleteNotification;
use App\Resources\Friendship\FriendshipResource;
use App\Actions\Notification\UpdateNotificationData;
use App\Http\Requests\UpdateFriendshipStatusRequest;
use App\Notifications\Friendship\AcceptFriendshipNotification;
use App\Notifications\Friendship\DeleteFriendRequestNotification;

class UpdateFriendshipStatusController extends Controller
{
    public function __construct(
        public UpdateNotificationData $updateNotificationData,
        public DeleteNotification $deleteNotification,
    ){
    }

    public function __invoke(UpdateFriendshipStatusRequest $request) : FriendshipResource
    {
        $friendship = Friendship::whereId($request->input('friendshipId'))
            ->first();

        $user = auth()->id() === $friendship->user_id ? $friendship->friendsFrom : $friendship->friendsTo;

        if( $request->input('status') === 'accept' ) {
            $friendship->accept();

            ($this->updateNotificationData)($friendship, 'accepted');

            $user->notify(new AcceptFriendshipNotification($friendship, auth()->user()));

        }

        if( $request->input('status') === 'reject' ) {
            $user->notify(new DeleteFriendRequestNotification($friendship, auth()->user()));

            ($this->updateNotificationData)($friendship, 'rejected');

            $friendship->reject();
        }

        return new FriendshipResource($friendship);
    }
}
