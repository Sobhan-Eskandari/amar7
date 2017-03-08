<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable =[
        'name'
    ];
    public function lessons(){
        return $this->morphedByMany('App\Lesson','taggable');
    }
    public function wikis(){
        return $this->morphedByMany('App\Wiki','taggable');
    }
}
