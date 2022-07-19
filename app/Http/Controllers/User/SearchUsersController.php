<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SearchUsersController extends Controller
{
    public function __invoke()
    {
        // dd(request());
        dd($users = User::search(request()->input('query')));
    }
}
