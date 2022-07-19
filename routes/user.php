<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\GetUserDataController;
use App\Http\Controllers\User\SearchUsersController;

Route::get('/', GetUserDataController::class);
Route::get('/{query}', SearchUsersController::class);
