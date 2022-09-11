<?php
namespace App\Actions\Notification;

use App\Models\Friendship;
use Illuminate\Support\Facades\DB;

class UpdateNotificationData {
    public function __invoke(Friendship $friendship, string $status) : void
    {

        $notification = DB::table('notifications')
        ->where('notifiable_id', $friendship->friend_id)
        ->where('data', 'LIKE', "%{$friendship->id}%")
        ->first();

        if($notification) {

            $data = json_decode($notification->data);

            $data->data->friendship->data->attributes->status = $status;

             // Update notification
             DB::table('notifications')
             ->where('notifiable_id', $friendship->friend_id)
             ->where('data', 'LIKE', "%{$friendship->id}%")
             ->update([
                 'data' => json_encode($data),
             ]);
        }
    }
}
