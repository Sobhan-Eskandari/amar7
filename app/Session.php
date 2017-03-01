<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    protected $fillable = [
        'lesson_id',
        'session_name',
        'session_desc',
        'session_file'
    ];

    public function lesson(){
        return $this->belongsTo('App\Lesson');
    }
}
