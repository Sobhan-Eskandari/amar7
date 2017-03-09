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
            'aboutUs_img'=>'image',
            'middle_cover_img' => 'image',
            'number' => 'required|digits:11',
            'address' => 'required',
            'email' => 'required|email',
            'landline' => 'required|digits:11',
            'rules' => 'required',
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
            'middle_cover_img.image' => 'فایل کاور میانی باید عکس باشد',
            'rules.required' => 'وارد کردن قوانین و مقرارت اجباری است',
            'landline.required' => 'وارد کردن شماره تماس خط ثابت اجباری است',
            'landline.digits' => 'شماره تماس خط ثابت باید 11 رقم باشد',
            'address.required' => 'وارد کردن آدرس پستی اجباری است',
            'email.required' => 'وارد کردن ایمیل اجباری است',
            'email.email' => 'ایمیل وارد شده معتبر نیست',
            'number.required' => 'وارد کردن شماره تماس موبایل اجباری است',
            'number.digits' => 'شماره تماس موبایل باید 11 رقم باشد',
        ];
    }
}
