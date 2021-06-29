<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fname', 'lname', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function activity_logs()
    {
        return $this->hasMany(Activity_log::class);
    }

    public function followers()
    {
        return $this->belongsToMany(self::class,'followers','followers_id','user_id')->withTimestamps();
    }

    public function follows()
    {
        return $this->belongsToMany(self::class,'followers','user_id','followers_id')->withTimestamps();
    }

    public function follow($userId)
    {
        $this->follows()->attach($userId);
        return $this;
    }

    public function unfollow($userId)
    {
        $this->follows()->detach($userId);
        return $this;
    }

    public function isFollowing($userId)
    {
        return (boolean) $this->follows()->where('follows_id',$userId)->first(['id']);
    }

    public function setFirstNameAttribute($value)
    {
        $this->attribute['fname'] = strtoupper($value);
    }
}