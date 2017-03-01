<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
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
            'email' => 'required|email|unique:users,email',
            'password'=>'required|min:8',
            'g-recaptcha-response' => 'required',
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
            'password.required' => 'وارد کردن رمز عبور اجباری است',
            'password.min' => 'رمز عبور باید حداقل هشت رقم باشد',
            'g-recaptcha-response.required' => 'تصدیق کنید که ربات نیستید',
        ];
    }
}
