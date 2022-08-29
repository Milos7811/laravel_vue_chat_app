<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Friendship extends Model
{
    use HasFactory;

    public $fillable = [
        'user_id',
        'friend_id',
        'status'
    ];

    public $incrementing = false;

    protected $keyType = 'string';

    public function accept()
    {
        $this->update([
            'status' => 'accepted',
        ]);
    }

    public function reject()
    {
        $this->update([
            'status' => 'rejected',
        ]);
    }

    public function friendship()
    {
        return $this->hasMany(Friendship::class);
    }

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
