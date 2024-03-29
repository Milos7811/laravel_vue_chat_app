<?php

namespace App\Resources\Friendship;

use App\Resources\User\UserResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Resources\Json\JsonResource;

class FriendshipResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'data' => [
                'id' => $this->id,
                'type' => 'friendship',
                'attributes' => [
                    'status' => $this->status,
                    'author' => $this->user_id,
                    'friend' => new UserResource($this->friendsTo->id === Auth::id() ? $this->friendsFrom : $this->friendsTo)
                ],

            ]
        ];
    }
}
