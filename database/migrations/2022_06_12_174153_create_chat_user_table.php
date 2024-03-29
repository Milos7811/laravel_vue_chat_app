<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChatUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chat_user', function (Blueprint $table) {
            $table->uuid('id')->primary()->index();
            $table->uuid('chat_id');
            $table->uuid('user_id');
            $table->foreign('chat_id')->references('id')->on('chats');
            $table->foreign('user_id')->references('id')->on('users');
            $table->dateTime('last_readed')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chat_user');
    }
}
