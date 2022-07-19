<?php

namespace App\Resources\User;

use Illuminate\Support\Collection;
use Illuminate\Http\Resources\Json\ResourceCollection;

class UserCollection extends ResourceCollection
{
    public $collects = UserResource::class;

    public function toArray($request) : Collection
    {
        return $this->collection;
    }
}
