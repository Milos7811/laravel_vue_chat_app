<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Friendship extends Model
{
    use HasFactory;

    public $incrementing = false;

    public function friendship()
    {
        return $this->hasMany(Friendship::class);
    }

    protected $keyType = 'string';

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function friendsTo()
    {
        return $this->hasOne(User::class , 'id', 'user_id');
    }

    public function friendsFrom()
    {
        return $this->hasOne(User::class, 'id', 'friend_id');
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($friendship) {
            $friendship->id = Str::uuid();
        });
    }
}
