<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CoursesCategories extends Model
{
    protected $fillable = [
        'name'
    ];

    public function lessons(){
        return $this->belongsToMany('App\Lesson');
    }
}
