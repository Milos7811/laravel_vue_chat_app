<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class GetUserDataController extends Controller
{
    public function __invoke(Request $request)
    {
        // dd('aa');
        return Auth::user();
    }
}
