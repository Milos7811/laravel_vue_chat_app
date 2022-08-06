<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\GetUserDataController;
use App\Http\Controllers\User\SearchUsersController;
use App\Http\Controllers\User\StoreUserAvatarController;

Route::get('/', GetUserDataController::class);
Route::post('/avatar', StoreUserAvatarController::class);
Route::get('/{query}', SearchUsersController::class);
