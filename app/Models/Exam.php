<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;
    protected $fillable = [
        'exam_name',
        'exam_desc',
        'number',
        'time',
        'type',
        'user_id',
        'category_id',
        'lesson_id',
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
    public function lesson()
    {
        return $this->belongsTo('App\Models\Lesson');
    }
    public function questions()
    {
        return $this->hasMany('App\Models\Question')->inRandomOrder()->take($this->number);
    }
    public function parts()
    {
        return $this->hasMany('App\Models\Exam_part');
    }
    public function answers()
    {
        return $this->hasMany('App\Models\Answer');
    }
}
