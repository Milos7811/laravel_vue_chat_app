<?php

namespace App\Http\Controllers\Chat;

use App\Models\ChatUser;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UpdateLastReadedChatController extends Controller
{
    public function __invoke() : Response
    {
        ChatUser::where('chat_id', request()->route('id'))
            ->where('user_id', Auth::id())
            ->update(['last_readed' => Carbon::now()]);

        return response('Last readed chat time was updated.', 200);
    }
}
