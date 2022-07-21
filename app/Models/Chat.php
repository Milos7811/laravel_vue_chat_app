<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
    ];

    public function members()
    {
        return $this->belongsToMany(User::class)
            ->withPivot('last_readed');
    }

    public function messages()
    {
        return $this->hasMany(Message::class)
            ->with('owner');
    }
}
