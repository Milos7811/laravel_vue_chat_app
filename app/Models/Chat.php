<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Chat extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
    ];

    public $incrementing = false;

    protected $keyType = 'string';

    public function members()
    {
        return $this->belongsToMany(User::class)
            ->withPivot('last_readed');
    }

    public function messages()
    {
        return $this->hasMany(Message::class)
            ->with('owner')
            ->orderBy('updated_at', 'ASC');
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($chat) {
            $chat->id = Str::uuid();
        });
    }
}
