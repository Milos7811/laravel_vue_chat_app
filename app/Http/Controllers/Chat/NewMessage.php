<?php

namespace App\Http\Controllers\Chat;

use App\Models\Chat;
use App\Models\Message;
use Illuminate\Http\Request;
use App\Events\NewMessageEvent;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Notifications\ChatNotification;
use App\Resources\Message\MessageResource;

class NewMessage extends Controller
{
    public function __invoke(Request $request)
    {
        // return $user->createToken('test1')->plainTextToken;

        checkUserInChat($request);

        $chat = Chat::whereId($request->input('chat_id'))
            ->with('members')
            ->first();

        // dd($chat->members);

        $message = Message::create([
            'chat_id' => $request->input('chat_id'),
            'user_id' => Auth::id(),
            'message' => $request->input('message')
        ]);


        foreach ($chat->members as $member){

            if(Auth::id() != $member->id)
                NewMessageEvent::dispatch($member->id, $message);
        }

        return new MessageResource($message);
    }
}
