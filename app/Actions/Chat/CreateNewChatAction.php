<?php
namespace App\Actions\Chat;

use App\Models\Chat;
use App\Models\User;
use App\Models\ChatUser;
use App\Events\NewChatEvent;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class CreateNewChatAction
{
    public function __invoke(
        // Collection $users,
        Chat $chat
    )
    {
        $usersId = request()->input('usersId');

        // Push current user to the array for create pivot record
        array_push($usersId, Auth::id());

        // Create record in the pivot table
        foreach($usersId as $userId) {
            ChatUser::create([
                'chat_id' => $chat->id,
                'user_id' => $userId,
                'last_readed' => now()->subMinute(),
            ]);

        }

        // Remove current user from the array for send the event
        array_splice($usersId, Auth::id());

        // Push new chat for users
        NewChatEvent::dispatch($usersId, $chat);
    }
}
