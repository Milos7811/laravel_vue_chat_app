<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ChatUser extends Pivot
{
    use HasFactory;

    public $incrementing = false;

    protected $keyType = 'string';

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($chatUser) {
            $chatUser->id = Str::uuid();
        });
    }
}
