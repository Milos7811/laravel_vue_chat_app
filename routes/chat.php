<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Chat\NewMessageController;
use App\Http\Controllers\Chat\GetChatController;
use App\Http\Controllers\Chat\NewChatController;
use App\Http\Controllers\Chat\UpdateLastReadedChatController;
use App\Http\Controllers\Chat\GetAllChatsController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::get('/', GetAllChatsController::class);
Route::get('/{id}', GetChatController::class);
Route::post('/new-message', NewMessageController::class);
Route::post('/{id}/last-readed', UpdateLastReadedChatController::class );
Route::post('create-new', NewChatController::class);

