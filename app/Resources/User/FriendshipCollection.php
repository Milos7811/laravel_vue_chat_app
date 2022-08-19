<?php

namespace App\Resources\User;

use Illuminate\Support\Collection;
use Illuminate\Http\Resources\Json\ResourceCollection;

class FriendshipCollection extends ResourceCollection
{
    public $collects = FriendshipResource::class;

    public function toArray($request) : Collection
    {
        return $this->collection;;
    }
}
