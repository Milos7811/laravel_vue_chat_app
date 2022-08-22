<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\GetUserDataController;
use App\Http\Controllers\User\SearchUsersController;
use App\Http\Controllers\User\StoreUserAvatarController;
use App\Http\Controllers\User\UserStatusUpdate;

Route::get('/', GetUserDataController::class);
Route::post('/avatar', StoreUserAvatarController::class);
Route::get('/{query}', SearchUsersController::class);
Route::post('/status', UserStatusUpdate::class);
