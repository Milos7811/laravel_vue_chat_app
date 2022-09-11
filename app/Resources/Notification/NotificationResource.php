<?php

namespace App\Resources\Notification;

use Illuminate\Http\Resources\Json\JsonResource;

class NotificationResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'data' => [
                'id'   => $this->id,
                'type' => $this->type,
                'attributes' => [
                    'category'    => $this->data['category'],
                    'title'       => $this->data['title'],
                    'description' => $this->data['description'],
                    'payload'     => $this->data['data'],
                    'read_at'     => $this->read_at,
                    'created_at'  => $this->created_at
                ]
            ]
        ];
    }
}
