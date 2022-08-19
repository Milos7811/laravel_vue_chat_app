<?php

namespace App\Resources\User;

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
                    'friend' => $this->friendsTo->id === Auth::id() ? $this->friendsFrom : $this->friendsTo,
                ],

            ]
        ];
    }
}
