<?php

namespace App\Models;

use App\Models\Chat;
use App\Models\Friendship;
use Illuminate\Support\Str;
use Laravel\Scout\Searchable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens, Searchable;

    protected $guarded = [
        'id'
    ];

    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar',
        'status'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $searchable = [
        'name'
    ];

    public $incrementing = false;

    protected $keyType = 'string';

    public function online()
    {
        $this->update([
            'status' => 'online',
        ]);
    }

    public function offline()
    {
        $this->update([
            'status' => 'offline',
        ]);
    }

    public function chats()
    {
        return $this->belongsToMany(Chat::class)
            ->with('messages')
            ->with('members')
            ->orderBy('updated_at', 'DESC');
    }

    public function lastReaded()
    {
        return $this->belongsToMany(Chat::class, 'chat_user', 'user_id', 'chat_id' )
            ->withPivot('last_readed');
    }

    public function friendships()
    {
        return $this->hasMany(Friendship::class)
            ->where('user_id', $this->id)
            ->oRwhere('friend_id', $this->id);
    }


    public function getAvatarAttribute()
    {
        if (! $this->attributes['avatar']) {
            return null;
        }

        return url("/avatars/{$this->attributes['avatar']}");

    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            $user->id = Str::uuid();
        });
    }
}
