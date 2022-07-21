<?php

namespace App\Resources\User;

use Illuminate\Support\Collection;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ChatMemberCollection extends ResourceCollection
{
    public $collects = ChatMemberResource::class;

    public function toArray($request) : Collection
    {
        return $this->collection;
    }
}
