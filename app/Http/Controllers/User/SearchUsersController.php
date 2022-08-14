<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Resources\User\UserCollection;

class SearchUsersController extends Controller
{
    public function __invoke() : UserCollection
    {
        $users = User::where('name', 'LIKE', '%'. request()->route('query') .'%')
            ->where('id', '!=', Auth::id())
            ->get();

        return new UserCollection($users);
    }
}
