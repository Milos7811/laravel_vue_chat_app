<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray($request) : array
    {
        return [
            'data' => [
                'id'         => $this->id,
                'type'       => 'user',
                'attributes' => [
                    'name' => $this->name,
                    'email' => $this->email,
                    'lastReaded' => $this->whenPivotLoaded('chat_user', function () {
                        return $this->pivot->last_readed;
                    }),
                ]
            ],
        ];
    }
}
