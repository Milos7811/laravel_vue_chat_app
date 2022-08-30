<?php

use App\Models\Chat;
use App\Models\Friendship;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

if (! function_exists('checkUserInChat')) {
    /**
     * Check if is user member of chat
     */
    function checkUserInChat($request)
    {
        $chat = Chat::whereId($request->input('chat_id'))
        ->with('members')
        ->first();

        foreach ($chat->members as $member) {
            if($member->id == Auth::id()) {
                return true;
            }
        }

        abort(
            response()->json([
                'type'    => 'error',
                'message' => 'User is not a member of this chat!',
            ], 422)
        );
    }
}

if (! function_exists('unreadedMessagesCount')) {
    /**
     * Counting unreaded messages
     */
    function unreadedMessagesCount (
        Collection $members,
        Collection $messages,
    ) : String {

        $user = null;
        $unreadedMessages = [];

        // Get current user from the members to get date of last read messages
        foreach($members as $member) {
            if($member->id === Auth::id()) {
                $user = $member;
            }
        }

        // Get count of the don't read messages
        foreach($messages as $message) {
            if($message->created_at->greaterThan($user->pivot->last_readed) && $message->owner->id != Auth::id()) {
                array_push($unreadedMessages, $message);
            }
        }

        // Return count of unreaded messages
        return count($unreadedMessages);
    }
}

if(! function_exists('checkFriendshipExist')) {
    /**
    * Check if Friendship exist already
    */
   function checkFriendshipExist(string $friendId) : Friendship | Bool
   {
        $friendship = Friendship::where([
            ['user_id', Auth::id()],
            ['friend_id', $friendId]
        ])
        ->orWhere([
            ['user_id', $friendId],
            ['friend_id', Auth::id() ]
        ])->first();

        return $friendship ? $friendship : false;
   }
}

if(! function_exists('storeAvatar')) {
     /**
     * Check if is user member of chat
     */
    function storeAvatar()
    {

        //   // Generate avatar name
        //   $avatar_name = Str::uuid() . '.' . $image->getClientOriginalExtension();

        //   // Create intervention image
        //   $intervention = Image::make($image->getRealPath());

    }
}
