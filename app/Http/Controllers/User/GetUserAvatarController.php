<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class GetUserAvatarController extends Controller
{
    public function __invoke(
        string $avatarName
    ) : StreamedResponse
    {

        return Storage::download("/avatars/{$avatarName}");
    }
}
