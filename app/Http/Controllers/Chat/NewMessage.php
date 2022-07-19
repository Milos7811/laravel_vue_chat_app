<?php

namespace App\Http\Controllers\Chat;

use App\Models\Message;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Resources\Message\MessageResource;
use Illuminate\Support\Facades\Auth;

class NewMessage extends Controller
{
    public function __invoke(Request $request)
    {
        // return $user->createToken('test1')->plainTextToken;

        checkUserInChat($request);

        $message = Message::create([
            'chat_id' => $request->input('chat_id'),
            'user_id' => Auth::id(),
            'message' => $request->input('message')
        ]);



        return new MessageResource($message);
    }
}
