<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Chat\GetAllChatsController;
use App\Http\Controllers\Chat\NewMessage;
use App\Http\Controllers\Chat\UpdateLastReadedChat;
use App\Http\Controllers\GetChatController;

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
Route::post('/new-message', NewMessage::class);
Route::post('/{id}/last-readed', UpdateLastReadedChat::class );

