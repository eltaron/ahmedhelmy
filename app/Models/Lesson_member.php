<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson_member extends Model
{
    use HasFactory;
    protected $fillable = [
        'type',
        'lesson_id',
        'user_id',
        'end_at'
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

    public function lesson() {
        return $this->belongsTo('App\Models\Lesson');
    }
    public function user() {
        return $this->belongsTo('App\Models\User');
    }
}
