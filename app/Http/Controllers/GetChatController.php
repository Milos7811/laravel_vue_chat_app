<?php

namespace App\Http\Controllers;

use App\Resources\Chat\ChatResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GetChatController extends Controller
{
    public function __invoke(Request $request)
    {
       $user = Auth::user();

       $chat = $user->chats->where('id', $request->id)->first();

       return new ChatResource($chat);
    }
}
