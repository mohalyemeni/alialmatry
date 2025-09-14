<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class BlogRequest  extends FormRequest
{
    public function authorize()
    {
        return true;
    }

   public function rules()
{
    switch ($this->method()) {
        case 'POST':
            return [
                'title'             => 'required|string|max:255',
                'description'       => 'nullable|string',
                'img'               => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:3000',
                'category_id'       => 'required|exists:categories,id',
                'meta_keywords'     => 'nullable|string',
                'meta_description'  => 'nullable|string',
                'meta_slug'         => 'nullable|string|alpha_dash',
                'published_on'      => 'required|date',
                'status'            => 'required|boolean',
            ];
        case 'PUT':
        case 'PATCH':
            return [
                'title'             => 'required|string|max:255',
                'description'       => 'nullable|string',
                'img'               => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:3000',
                'category_id'       => 'required|exists:categories,id',
                'meta_keywords'     => 'nullable|string',
                'meta_description'  => 'nullable|string',
                'meta_slug'         => 'nullable|string|alpha_dash',
                'published_on'      => 'required|date',
                'status'            => 'required|boolean',
            ];
        default:
            return [];
    }
}


    public function attributes()
    {
        return [
            'title'             => 'عنوان التصنيف',
            'description'       => 'الوصف',
            'img'               => 'الصورة',
            'meta_keywords'     => 'كلمات الميتا',
            'meta_description'  => 'وصف الميتا',
            'meta_slug'         => 'رابط الميتا',
            'published_on'      => 'تاريخ النشر',
            'status'            => 'الحالة',
        ];
    }
}