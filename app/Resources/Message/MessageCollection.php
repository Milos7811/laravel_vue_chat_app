<?php

namespace App\Resources\Message;

use Illuminate\Support\Collection;
use Illuminate\Http\Resources\Json\ResourceCollection;

class MessageCollection extends ResourceCollection
{
    public $collects = MessageResource::class;

    public function toArray($request) : Collection
    {
        return $this->collection;;
    }
}
