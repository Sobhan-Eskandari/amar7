<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserPasswordRequest extends FormRequest
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
            'old_password' => 'required',
            'password'=>'required|min:8|confirmed',
            'password_confirmation'=>'required',
        ];
    }

    public function messages()
    {
        return [
            'old_password.required' => 'وارد کردن رمز عبور قبلی اجباری است',
            'password.required' => 'وارد کردن رمز عبور اجباری است',
            'password.min' => 'رمز عبور باید حداقل هشت رقم باشد',
            'password.confirmed' => 'رمز عبور وارد شده با تأیید رمز عبور همخوانی ندارد',
            'password_confirmation.required' => 'وارد کردن تأیید رمز عبور اجباری است',
        ];
    }
}
