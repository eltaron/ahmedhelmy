<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;
    protected $fillable = [
        'question',
        'image',
        'answer_1',
        'answer_2',
        'answer_3',
        'answer_4',
        'answer',
        'email',
        'right_answer',
        'part_id',
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
    public function part()
    {
        return $this->belongsTo('App\Models\Exam_part', 'part_id');
    }
}
