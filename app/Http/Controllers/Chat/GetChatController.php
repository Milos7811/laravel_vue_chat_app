<?php

namespace App\Http\Controllers\Chat;

use App\Http\Controllers\Controller;
use App\Resources\Chat\ChatResource;
use Illuminate\Support\Facades\Auth;

class GetChatController extends Controller
{
    public function __invoke() : ChatResource
    {
       $user = Auth::user();

       $chat = $user->chats->where('id', request()->id)->first();

       return new ChatResource($chat);
    }
}
