<?php

use App\Http\Controllers\Friendship\UpdateFriendshipStatusController;
use App\Http\Controllers\Friendship\CreateFriendshipController;
use App\Http\Controllers\User\StoreUserAvatarController;
use App\Http\Controllers\User\GetUserDataController;
use App\Http\Controllers\User\SearchUsersController;
use Illuminate\Support\Facades\Route;

Route::get('/', GetUserDataController::class);
Route::post('/avatar', StoreUserAvatarController::class);
Route::get('/{query}', SearchUsersController::class);
Route::post('/friendship-create', CreateFriendshipController::class);
Route::post('/friendship-status', UpdateFriendshipStatusController:: class);
