<?php

namespace App\Resources\User;

use App\Resources\Chat\ChatCollection;
use Illuminate\Http\Resources\Json\JsonResource;

class AuthUserResource extends JsonResource
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
                'id'         => $this->id,
                'type'       => 'user',
                'attributes' => [
                    'name'   => $this->name,
                    'email'  => $this->email,
                    'avatar' => $this->avatar,
                    'sttaus' => $this->status
                ],
                'relationships' => [
                    $this->mergeWhen($this->friendships, fn () => [
                        'friendships' => new FriendshipCollection($this->friendships),
                    ]),

                    $this->mergeWhen($this->chats, fn () => [
                        'chats' => new ChatCollection($this->chats),
                    ]),
                ],
            ],
        ];
    }
}
