<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminUpdateRequest extends FormRequest
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
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users,email,'.$this->admin_info,
            'img' => 'nullable|image',
            'gender' => 'required',
            'occupation'=>'nullable',
            'cellphone'=>'nullable|digits:11|unique:users,cellphone,'.$this->admin_info,
            'password'=>'nullable|min:8|confirmed',
            'password_confirmation'=>'nullable|min:8',
        ];
    }

    public function messages()
    {
        return [
            'first_name.required' => 'وارد کردن نام اجباری است',
            'last_name.required' => 'وارد کردن نام خانوداگی اجباری است',
            'email.required' => 'وارد کردن رایانامه اجباری است',
            'email.email' => 'ایمیل وارد شده نامعتبر است',
            'email.unique' => 'ایمیل وارد شده قبل در سیستم ثبت شده است',
            'img.image' => 'فایل انتخاب شده تصویر نمی باشد',
            'cellphone.digits' => 'شماره موبایل باید یازده رقم باشد',
            'cellphone.unique' => 'شماره موبایل 1 وارد شده قبلا در سیستم ثبت شده است',
            'password.min' => 'رمز عبور باید حداقل شش رقم باشد',
            'password.confirmed' => 'رمز عبور وارد شده با تأیید رمز عبور همخوانی ندارد',
        ];
    }
}
