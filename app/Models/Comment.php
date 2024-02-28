<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $fillable = [
        'exam_desc',
        'status',
        'user_id',
        'post_id',
        'lesson_id',
        'article_id',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    protected $appends = [
        'time_ago'
    ];

    public function getTimeAgoAttribute(){
        return $this->created_at->diffForHumans();
    }
    public function user() {
        return $this->belongsTo('App\Models\User');
    }
    public function post() {
        return $this->belongsTo('App\Models\Post');
    }
    public function lesson() {
        return $this->belongsTo('App\Models\Lesson');
    }
    public function article() {
        return $this->belongsTo('App\Models\Article');
    }
}
