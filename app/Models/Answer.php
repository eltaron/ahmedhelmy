<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;
    protected $fillable = [
        'mark',
        'user_id',
        'exam_id',
        'groupid',
        'team'
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
    public function exam() {
        return $this->belongsTo('App\Models\Exam');
    }
}
