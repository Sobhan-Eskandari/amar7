<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditSessionRequest extends FormRequest
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
            'session_name'=>'required',
            'session_desc'=>'required',
            'session_file'=>'mimes:zip,rar'
        ];
    }
    public function messages()
    {
        return [
            'session_name.required' => 'وارد کردن نام جلسه اجباری است',
            'session_desc.required' => 'وارد کردن توضیحات جلسه اجباری است',
            'session_file.mimes' => 'نوع فایل باید zip یا rar باشد',

        ];
    }
}
