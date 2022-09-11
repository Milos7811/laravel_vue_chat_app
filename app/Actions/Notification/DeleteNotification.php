<?php
namespace App\Actions\Notification;

use App\Models\Friendship;
use Illuminate\Support\Facades\DB;

class DeleteNotification {
    public function __invoke(Friendship $friendship) : void
    {
        DB::table('notifications')
        ->where('notifiable_id', auth()->id())
        ->where('data', 'LIKE', "%{$friendship->id}%")
        ->delete();
    }
}
