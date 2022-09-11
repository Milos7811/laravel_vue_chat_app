<?php

namespace App\Notifications\Friendship;

use App\Models\User;
use App\Models\Friendship;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Resources\Friendship\FriendshipNotificationResource;

class DeleteFriendRequestNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(
        public Friendship $friendship,
        public User $user,
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
        return ['broadcast'];
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
            'category' => 'friend-cancel',
            'title' => 'Friend Request',
            'description' => 'You have new friend rquest from',
            'data' => [
                'action'     => 'cancel-invitation',
                'friendship' => new FriendshipNotificationResource($this->friendship, $this->user)
            ]
        ];
    }
}
