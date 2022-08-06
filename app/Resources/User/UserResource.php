<?php

namespace App\Resources\User;

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
                    'name'   => $this->name,
                    'email'  => $this->email,
                    'avatar' => $this->avatar,
                ]
            ],
        ];
    }
}
