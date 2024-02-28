<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;
    protected $fillable = [
        'url',
        'filename',
        'post_id',
        'article_id',
        'event_id',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function post() {
        return $this->belongsTo('App\Models\Post');
    }
    public function article() {
        return $this->belongsTo('App\Models\Article');
    }
    public function event() {
        return $this->belongsTo('App\Models\Event');
    }
}
