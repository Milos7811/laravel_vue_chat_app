<?php

use App\Models\Chat;
use Illuminate\Support\Facades\Auth;

if (! function_exists('checkUserInChat')) {
    /**
     * Check if is user member of chat
     */
    function checkUserInChat($request)
    {
        $chat = Chat::whereId($request->input('chat_id'))
        ->with('users')
        ->first();

        foreach ($chat->users as $user) {
            if($user->id == Auth::id()) {
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
