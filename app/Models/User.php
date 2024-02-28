<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'username',
        'groupid',
        'avatar',
        'phone',
        'status',
        'only',
        'mac',
        'filename'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    protected $appends = [
        'time_ago'
    ];

    public function getTimeAgoAttribute()
    {
        return $this->created_at->diffForHumans();
    }
    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'groupid');
    }
    public function answers()
    {
        return $this->hasMany('App\Models\Answer');
    }
    public function top()
    {
        return $this->hasOne('App\Models\Top');
    }
    public function messages()
    {
        return $this->hasMany('App\Models\Message');
    }
    public function lessons()
    {
        return $this->hasMany('App\Models\Lesson_member');
    }
    public function comments()
    {
        return $this->hasMany('App\Models\Comment');
    }
}
