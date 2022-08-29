<?php

use App\Http\Controllers\Friendship\UpdateFriendshipStatusController;
use App\Http\Controllers\Friendship\CreateFriendshipController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\GetUserDataController;
use App\Http\Controllers\User\SearchUsersController;
use App\Http\Controllers\User\StoreUserAvatarController;
use App\Http\Controllers\User\UserStatusUpdate;

Route::get('/', GetUserDataController::class);
Route::post('/avatar', StoreUserAvatarController::class);
Route::get('/{query}', SearchUsersController::class);
Route::post('/status', UserStatusUpdate::class);
Route::post('/friendship-create', CreateFriendshipController::class);
Route::post('/friendship-status', UpdateFriendshipStatusController:: class);
