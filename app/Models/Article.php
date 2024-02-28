<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;
    protected $fillable = [
        'article_name',
        'article_description',
        'allow_comment',
        'tags',
        'type',
        'user_id',
        'category_id',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    protected $appends = [
        'time_ago'
    ];

    public function getTimeAgoAttribute()
    {
        return $this->created_at->diffForHumans();
    }
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }
    public function image()
    {
        return $this->hasOne('App\Models\Image');
    }
    public function images()
    {
        return $this->hasMany('App\Models\Image');
    }
    public function comments()
    {
        return $this->hasMany('App\Models\Comment')->where('status', 1);
    }
}
