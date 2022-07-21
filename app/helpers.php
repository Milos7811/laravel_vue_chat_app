<?php

use App\Models\Chat;
use Illuminate\Support\Carbon;
use Illuminate\Container\Container;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

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
     * Counting unread messages
     */

    function unreadedMessagesCount ($members, $messages) {
        $user = null;
        $unreadedMessages = [];

        foreach($members as $member) {
            if($member->id === Auth::id()) {
                $user = $member;
            }
        }

        foreach($messages as $message) {

            // Format times to same format
            $messageTime = $message->created_at->format('H:i:s d.m.Y');
            $lastReaded = Carbon::createFromFormat('Y-m-d H:i:s',  $user->pivot->last_readed)->format('H:i:s d-m-Y');

            if($messageTime > $lastReaded && $message->owner->id != Auth::id()) {
                array_push($unreadedMessages, $message);
            }
        }
        // Return count of unreaded messages
        return count($unreadedMessages);
    }
}
