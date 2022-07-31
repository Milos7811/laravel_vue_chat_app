<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class GetUserDataController extends Controller
{
    public function __invoke()
    {

        return Auth::user();
    }
}
