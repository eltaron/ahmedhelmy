<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;
    protected $fillable = [
        'lesson_name',
        'lesson_description',
        'video',
        'video_name',
        'allow_comment',
        'approve',
        'pdf',
        'user_id',
        'category_id',
        'vfilename',
        'pdffilename',
        'status',
        'imagethumb'
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
    public function users()
    {
        return $this->hasMany('App\Models\Lesson_member');
    }
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }
    public function exam()
    {
        return $this->hasOne('App\Models\Exam');
    }
    public function comments()
    {
        return $this->hasMany('App\Models\Comment');
    }
}
