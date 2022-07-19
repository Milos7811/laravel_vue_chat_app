<?php

namespace App\Resources\Chat;

use Illuminate\Support\Collection;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ChatCollection extends ResourceCollection
{
    public $collects = ChatResource::class;

    public function toArray($request) : Collection
    {
        return $this->collection;;
    }
}
