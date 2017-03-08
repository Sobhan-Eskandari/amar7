<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WikiRequest extends FormRequest
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
            'title' => 'required',
            'body' => 'required',
            'img' => 'nullable|image',
            'wiki_categories' => 'required',
            'tags' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'وارد کردن عنوان اجباری است',
            'body.required' => 'وارد کردن متن مقاله اجباری است',
            'img.image' => 'فایل مورد نظر تصویر نیست',
            'wiki_categories.required' => 'انتخاب دسته بندی اجباری است',
            'tags.required' => 'انتخاب تگ اجباری است',
        ];
    }
}
