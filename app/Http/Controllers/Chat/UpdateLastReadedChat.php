<?php

namespace App\Http\Controllers\Chat;

use App\Models\ChatUser;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UpdateLastReadedChat extends Controller
{
    public function __invoke(Request $request)
    {
        ChatUser::where('chat_id', $request->route('id'))
            ->where('user_id', Auth::id())
            ->update(['last_readed' => Carbon::now()]);

        return response('Last readed chat time was updated.', 200);
    }
}
