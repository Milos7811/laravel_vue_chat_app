<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'chat_id',
        'user_id',
        'message',
    ];

    public function owner()
    {
       return $this->belongsTo(User::class, 'user_id');
    }

    public function chat()
    {
        $this->belongsTo(Chat::class, 'chat_id');
    }

    public function lastReaded ()
    {

    }
}
