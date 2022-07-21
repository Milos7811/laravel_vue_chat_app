<?php

namespace App\Resources\Chat;

use App\Resources\User\UserCollection;
use App\Resources\User\ChatMemberResource;
use App\Resources\Message\MessageCollection;
use App\Resources\User\ChatMemberCollection;
use Illuminate\Http\Resources\Json\JsonResource;

class ChatResource extends JsonResource
{
    public function toArray($request) : array
    {
        return [
            'data' => [
                'id' => $this->id,
                'type' => 'chat',

                'attributes' => [
                    'unreadedMessagesCount' => unreadedMessagesCount($this->members, $this->messages),
                ],

                'relationships' => [

                    $this->mergeWhen($this->messages, fn () => [
                        'messages' => new MessageCollection($this->messages),
                    ]),

                    $this->mergeWhen($this->members, fn () => [
                        'members' => new ChatMemberCollection($this->members),
                    ]),
                ],
            ],
        ];
    }
}
