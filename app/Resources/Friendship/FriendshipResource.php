<?php

namespace App\Resources\Friendship;

use App\Resources\User\UserResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Resources\Json\JsonResource;

class FriendshipResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'data' => [
                'id' => $this->id,
                'type' => 'friendship',
                'attributes' => [
                    'status' => $this->status,
                    'isAuthor' => $this->friendsTo->id === Auth::id() ? true : false,
                    'friend' => new UserResource($this->friendsTo->id === Auth::id() ? $this->friendsFrom : $this->friendsTo)
                ],

            ]
        ];
    }
}
