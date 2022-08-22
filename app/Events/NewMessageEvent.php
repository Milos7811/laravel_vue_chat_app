<?php

namespace App\Events;

use App\Models\Message;
use Illuminate\Queue\SerializesModels;
use App\Resources\Message\MessageResource;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;

class NewMessageEvent implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(
        public string $member,
        public Message $message
    )
    {
    }

    /**
     * The event's broadcast name.
     */
    public function broadcastAs()
    {
        return 'message';
    }

    /**
     * Get the channels the event should broadcast on.
     *
     */
    public function broadcastOn()
    {
        return new PrivateChannel('App.Models.User.' . $this->member);
    }

    public function broadcastWith()
    {
        return (new MessageResource($this->message))->resolve();
    }
}
