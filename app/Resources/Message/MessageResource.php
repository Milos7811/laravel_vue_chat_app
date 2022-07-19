<?php

namespace App\Resources\Message;

use App\Resources\User\UserResource;
use Illuminate\Http\Resources\Json\JsonResource;

class MessageResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'data' => [
                'id' => $this->id,
                'type' => 'message',
                'attributes' => [
                    'message' => $this->message,
                    'chat_id' => $this->chat_id,
                    'created_at'    => $this->created_at,
                    'updated_at'    => $this->updated_at,
                ],

                'relationships' => [
                    $this->mergeWhen($this->owner, fn () => [
                        'owner' => new UserResource($this->owner),
                    ]),
                ],
            ]
        ];
    }
}
