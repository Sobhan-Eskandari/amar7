<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    protected $fillable =[
        'lesson_name',
        'lesson_desc',
        'instructor',
        'instructor_desc',
        'cost',
        'media',
        'seen',
        'user_id',
    ];

    public function sessions(){
        return $this->hasMany('App\Session');
    }

    public function categories(){
        return $this->belongsToMany('App\CoursesCategories');
    }

    public function photo(){
        return $this->morphToMany('App\Photo', 'photoable');
    }

    public function users(){
        return $this->belongsToMany('App\User')->withPivot('bought');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function tags(){
        return $this->morphToMany('App\Tag','taggable');
    }
}
