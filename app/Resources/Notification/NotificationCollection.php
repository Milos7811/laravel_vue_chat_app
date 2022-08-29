<?php

namespace App\Resources\Notification;

use Illuminate\Support\Collection;
use Illuminate\Http\Resources\Json\ResourceCollection;


class NotificationCollection extends ResourceCollection
{
    public $collects = NotificationResource::class;

    public function toArray($request)
    {
        return $this->collection;
    }
}
