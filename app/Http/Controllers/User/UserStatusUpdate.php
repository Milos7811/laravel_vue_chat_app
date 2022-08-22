<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserStatusUpdate extends Controller
{
    public function __invoke() : Response
    {
        $user = User::whereId(Auth::id())->first();

        if (request()->input('status') === 'online') {
            $user->online();
        }

        if (request()->input('status') === 'offline') {
            $user->offline();
        }

        return response('User status updated.', 200);
    }
}
