<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WikiCategories extends Model
{
    protected $fillable = [
        'name',
    ];

    public function wikis(){
        return $this->belongsToMany('App\Wiki');
    }
}
