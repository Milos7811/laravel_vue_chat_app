<?php

namespace App\Resources\Chat;

use App\Resources\User\UserCollection;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Resources\Message\MessageCollection;

class ChatResource extends JsonResource
{
    public function toArray($request) : array
    {
        return [
            'data' => [
                'id' => $this->id,
                'type' => 'chat',

                'relationships' => [

                    $this->mergeWhen($this->messages, fn () => [
                        'messages' => new MessageCollection($this->messages),
                    ]),

                    $this->mergeWhen($this->users, fn () => [
                        'members' => new UserCollection($this->users),
                    ]),
                ],
            ],
        ];
    }
}
