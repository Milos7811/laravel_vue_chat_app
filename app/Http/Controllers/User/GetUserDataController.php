<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Resources\User\AuthUserResource;
use App\Resources\User\FriendshipCollection;
use Illuminate\Support\Facades\Auth;
use App\Resources\User\UserResource;

class GetUserDataController extends Controller
{
    public function __invoke() : AuthUserResource
    {
        return new AuthUserResource(Auth::user());
    }
}
