<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'header_img'=>'image',
            'thSlider_img'=>'image',
            'ndSlider_img'=>'image',
            'rdSlider_img'=>'image',
            'contactUs_img'=>'image',
            'aboutUs_img'=>'image'
        ];
    }
    public function messages()
    {
        return [
            'header_img.image' => 'فایل هدر باید عکس باشد',
            'thSlider_img.image' => 'فایل اسلایدر اول باید عکس باشد',
            'ndSlider_img.image' => 'فایل اسلایدر دوم باید عکس باشد',
            'rdSlider_img.image' => 'فایل اسلایدر سوم باید عکس باشد',
            'contactUs_img.image' => 'فایل تماس باما باید عکس باشد',
            'aboutUs_img.image' => 'فایل درباره ما باید عکس باشد',
        ];
    }
}
