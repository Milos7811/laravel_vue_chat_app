<?php

namespace App\Events;

use App\Models\Chat;
use App\Models\User;
use Illuminate\Support\Collection;
use App\Resources\Chat\ChatResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;

class NewChatEvent implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(
        public array $usersId,
        public Chat $chat
    )
    {
    }

    /**
     * The event's broadcast name.
     */
    public function broadcastAs()
    {
        return 'new-chat';
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        foreach($this->usersId as $user) {
            return new PrivateChannel('App.Models.User.' . $user);
        }
    }

    public function broadcastWith()
    {
        $this->chat->broadcast = true;

        return (new ChatResource($this->chat))->resolve();
    }
}
