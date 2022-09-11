<?php

namespace App\Resources\Friendship;

use App\Resources\User\UserResource;
use Illuminate\Http\Resources\Json\JsonResource;

class FriendshipNotificationResource extends JsonResource
{
    private $user;

    public function __construct($resource, $user) {
        // Ensure we call the parent constructor
        parent::__construct($resource);
        $this->resource = $resource;
        $this->user = $user;
    }
    public function toArray($request)
    {
        return [
            'data' => [
                'id' => $this->id,
                'type' => 'friendship',
                'attributes' => [
                    'status' => $this->status,
                    'isAuthor' => $this->user_id,
                    'friend' => new UserResource($this->user)
                ],

            ]
        ];
    }
}
