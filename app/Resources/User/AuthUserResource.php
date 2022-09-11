<?php

namespace App\Resources\User;

use App\Resources\Chat\ChatCollection;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Resources\Friendship\FriendshipCollection;
use App\Resources\Notification\NotificationCollection;

class AuthUserResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'data' => [
                'id'         => $this->id,
                'type'       => 'user',
                'attributes' => [
                    'name'   => $this->name,
                    'email'  => $this->email,
                    'avatar' => $this->avatar,
                    'status' => $this->status
                ],
                'relationships' => [

                    'notifications' => [
                        'readNotifications'    => new NotificationCollection($this->readNotifications),
                        'unreadNotifications' => new NotificationCollection($this->unreadNotifications),
                    ],

                    'friendships' => [
                        $this->mergeWhen($this->friendships, fn () => [
                            'accepted' => new FriendshipCollection($this->friendships->where('status', 'accepted')),
                        ]),

                        // $this->mergeWhen($this->friendships, fn () => [
                        //     'rejected' => new FriendshipCollection($this->friendships->where('status', 'rejected')),
                        // ]),

                        $this->mergeWhen($this->friendships, fn () => [
                            'pending' => new FriendshipCollection($this->friendships->where('status', 'pending')),
                        ]),
                    ],

                    $this->mergeWhen($this->chats, fn () => [
                        'chats' => new ChatCollection($this->chats),
                    ]),
                ],
            ],
        ];
    }
}
