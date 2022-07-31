<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Resources\User\UserCollection;

class SearchUsersController extends Controller
{
    public function __invoke() : UserCollection
    {
        $users = User::where('name', 'LIKE', '%'. request()->route('query') .'%')
            ->get();

        return new UserCollection($users);
    }
}
