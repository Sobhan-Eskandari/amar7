<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactUsRequest extends FormRequest
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
            'name' => 'required',
            'email' => 'email|required',
            'message' => 'required',
            'g-recaptcha-response' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'وارد کردن نام اجباری است',
            'email.required' => 'وارد کردن ایمیل اجباری است',
            'email.email' => 'ایمیل وارد شده متبر نیست',
            'message.required' => 'وارد کردن پیام اجباری است',
            'g-recaptcha-response.required' => 'recapcha اجباری است',
        ];
    }
}
