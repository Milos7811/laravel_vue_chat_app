<?php

namespace App\Notifications;

use App\Models\Friendship;
use App\Resources\User\FriendshipResource;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class FriendshipRequestNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(
        public Friendship $friendship,
    ){
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database', 'broadcast'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'category' => 'friend-request',
            'title' => 'Friend Request',
            'description' => 'You have new friend rquest',
            'data' => [
                'friendship' => new FriendshipResource($this->friendship)
            ]
        ];
    }
}
