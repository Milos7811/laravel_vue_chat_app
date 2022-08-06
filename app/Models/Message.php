<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'chat_id',
        'user_id',
        'message',
    ];

    public $incrementing = false;

    protected $keyType = 'string';

    public function owner()
    {
       return $this->belongsTo(User::class, 'user_id');
    }

    public function chat()
    {
        $this->belongsTo(Chat::class, 'chat_id');
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($message) {
            $message->id = Str::uuid();
        });
    }
}
