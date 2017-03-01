<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'header_txt',
        'header_img',
        'thSlider_txt',
        'thSlider_img',
        'ndSlider_txt',
        'ndSlider_img',
        'rdSlider_txt',
        'rdSlider_img',
        'contactUs_img',
        'email',
        'number',
        'instagram',
        'telegram',
        'twitter',
        'facebook',
        'linkedin',
        'aparat',
        'aboutUs_txt',
        'aboutUs_img'
    ];
}
