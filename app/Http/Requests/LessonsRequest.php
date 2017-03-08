<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LessonsRequest extends FormRequest
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
            'lesson_name'=>'required',
            'lesson_desc'=>'required',
            'instructor'=>'required',
            'instructor_desc'=>'required',
            'lesson_img'=>'image|required',
            'cost'=>'numeric',
            'media'=>'required',
            'categories'=>'required',
            'tags'=>'required',
        ];
    }
    public function messages()
    {
        return [
            'lesson_name.required' => 'وارد کردن عنوان درس اجباری است',
            'lesson_desc.required' => 'وارد کردن توضیحات درس اجباری است',
            'instructor.required' => 'وارد کردن نام استاد اجباری است',
            'instructor_desc.required' => 'وارد کردن در مورد استاد اجباری است',
            'cost.numeric' => 'قیمت باید عدد باشد',
            'media.required' => 'وارد کردن رسانه اجباری است',
            'categories.required' => 'وارد کردن دسته بندی اجباری است',
            'lesson_img.image'=>'فایل باید عکس باشد',
            'lesson_img.required'=>'وارد کردن عکس اجباری است',
            'tags.required' => 'وارد کردن تگ اجباری است',

        ];
    }
}
