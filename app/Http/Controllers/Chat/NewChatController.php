<?php

namespace App\Http\Controllers\Chat;

use App\Models\Chat;
use App\Models\Message;
use App\Http\Controllers\Controller;
use App\Resources\Chat\ChatResource;
use Illuminate\Support\Facades\Auth;
use App\Actions\Chat\CreateNewChatAction;
use App\Http\Requests\NewChatRequest;

class NewChatController extends Controller
{
    public function __construct(
        public CreateNewChatAction $createChat,
    )
    {
    }
    public function __invoke(NewChatRequest $request) : ChatResource
    {
        $chat = Chat::create();

        Message::create([
            'chat_id' => $chat->id,
            'user_id' => Auth::id(),
            'message' => $request->input('message')
        ]);

        ($this->createChat)($chat);

        $chat->broadcast = false;

        return new ChatResource($chat);
    }
}
