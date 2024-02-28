<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam_part extends Model
{
    use HasFactory;
    protected $fillable = [
        'part_name',
        'number',
        'photo',
        'exam_id',
        'filename'
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
    public function exam()
    {
        return $this->belongsTo('App\Models\Exam');
    }
    public function questions()
    {
        return $this->hasMany('App\Models\Question', 'part_id');
    }
}
