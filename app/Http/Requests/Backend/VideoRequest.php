<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class VideoRequest extends FormRequest
{
    public function authorize()
    {

        return true;
    }

    public function rules()
    {
        return [
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'youtube_id' => 'required|string|max:20',
            'thumbnail' => 'nullable|string|max:255',
            'published_on' => 'nullable|date',
            'status' => 'required|boolean',
            'meta_keywords' => 'nullable|string',
            'meta_description' => 'nullable|string',
        ];
    }

    public function messages()
    {
        return [
            'category_id.required' => 'حقل التصنيف مطلوب.',
            'category_id.exists' => 'التصنيف المحدد غير صالح.',
            'title.required' => 'حقل العنوان مطلوب.',
            'youtube_id.required' => 'حقل معرف اليوتيوب مطلوب.',
            'status.required' => 'حقل الحالة مطلوب.',
            'status.boolean' => 'حقل الحالة يجب أن يكون صحيحاً أو خطأ.',
            'published_on.date' => 'حقل تاريخ النشر يجب أن يكون تاريخاً صحيحاً.',
        ];
    }
}