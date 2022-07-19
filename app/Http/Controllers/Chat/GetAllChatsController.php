<?php

namespace App\Http\Controllers\Chat;


use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Resources\Chat\ChatCollection;

class GetAllChatsController extends Controller
{
    public function __invoke()
    {
        $user = Auth::user();

        return new ChatCollection($user->chats);
    }
}
