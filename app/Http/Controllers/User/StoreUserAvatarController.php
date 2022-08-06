<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class StoreUserAvatarController extends Controller
{
    public function __invoke(Request $request)
    {
        $avatar = request()->file('avatar');

        $avatarName = Str::uuid() . '.' . $avatar->getClientOriginalExtension();

        $userId = Auth::id();

        // $path = "avatars/{$userId}";

        Storage::putFileAs('avatars/', $avatar, $avatarName);

        User::whereId($userId)
            ->update([
                'avatar' => $avatarName
            ]);
    }
}
