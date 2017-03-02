<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShareRequest extends FormRequest
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
            'url' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'وارد کردن پیوند اجباری است',
            'url.required' => 'وارد کردن آدرس پیوند اجباری است',
        ];
    }
}
