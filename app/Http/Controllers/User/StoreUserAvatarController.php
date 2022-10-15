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

        $extension = $avatar->getClientOriginalExtension();

        $avatarName = Str::uuid() . '.' . $extension;

        $userId = Auth::id();

        Storage::putFileAs('avatars/', $avatar, $avatarName);

        User::whereId($userId)
            ->update([
                'avatar' => $avatarName
            ]);

       return 'data:' . $extension . ';base64, ' . base64_encode(file_get_contents($avatar));
    }
}
