<?php

namespace App\Http\Controllers\Chat;

use App\Models\Chat;
use App\Models\Message;
use App\Events\NewMessageEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\NewMessageRequest;
use Illuminate\Support\Facades\Auth;
use App\Resources\Message\MessageResource;

class NewMessageController extends Controller
{
    public function __invoke(NewMessageRequest $request) : MessageResource
    {
        checkUserInChat($request);

        $chat = Chat::whereId($request->input('chat_id'))
            ->with('members')
            ->first();

        // Update the update_at collum to current time
        $chat->touch();

        $message = Message::create([
            'chat_id' => $request->input('chat_id'),
            'user_id' => Auth::id(),
            'message' => $request->input('message')
        ]);


        foreach ($chat->members as $member){

            if(Auth::id() != $member->id) {
                NewMessageEvent::dispatch($member->id, $message);
            }
        }

        return new MessageResource($message);
    }
}
