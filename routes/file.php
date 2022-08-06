<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\GetUserAvatarController;


Route::get('avatars/{avatar}', GetUserAvatarController::class);
