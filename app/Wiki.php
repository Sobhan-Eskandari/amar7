<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Wiki extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title',
        'body',
        'user_id',
        'seen',
        'file',
    ];

    public function photos(){
        return $this->morphToMany('App\Photo', 'photoable');
    }

    public function wiki_categories(){
        return $this->belongsToMany('App\WikiCategories');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }
    public function tags(){
        return $this->morphToMany('App\Tag','taggable');
    }
}
