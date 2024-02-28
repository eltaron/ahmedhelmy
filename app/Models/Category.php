<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'category_name',
        'category_description',
        'ordering',
        'parent',
        'Visibility',
        'user_id',
        'image'
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
    public function mparent()
    {
        return $this->belongsTo('App\Models\Category', 'parent');
    }
    public function subCategories()
    {
        return $this->hasMany('App\Models\Category', 'parent');
    }
    public function posts()
    {
        return $this->hasMany('App\Models\Post');
    }
    public function lessons()
    {
        return $this->hasMany('App\Models\Lesson')->where('status', 1);
    }
    public function users()
    {
        return $this->hasMany('App\Models\User', 'groupid');
    }
    public function articles()
    {
        return $this->hasMany('App\Models\Article');
    }
    public function exams()
    {
        return $this->hasMany('App\Models\Exam');
    }
    public function events()
    {
        return $this->hasMany('App\Models\Event');
    }
    public function audios()
    {
        return $this->hasMany('App\Models\Audio');
    }
    public function Lives()
    {
        return $this->hasMany('App\Models\Live');
    }
}
