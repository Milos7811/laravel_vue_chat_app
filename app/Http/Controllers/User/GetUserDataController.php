<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Resources\User\AuthUserResource;

class GetUserDataController extends Controller
{
    public function __invoke() : AuthUserResource
    {
        return new AuthUserResource(Auth::user());
    }
}
