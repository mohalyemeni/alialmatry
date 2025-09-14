<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class SheikhIntroRequest extends FormRequest
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
                    'title'             => 'required|string|max:255|unique:sheikh_intro,title',
                    'description'       => 'required|string',
                    'img'               => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:3000',
                    'meta_keywords'     => 'nullable|string',
                    'meta_description'  => 'nullable|string',
                    'meta_slug'         => 'nullable|string|alpha_dash|unique:sheikh_intro,meta_slug',
                    'published_on'      => 'required|date',
                    'status'            => 'required|boolean',
                ];

            case 'PUT':
            case 'PATCH':
                $id = $this->route('sheikh_intro');
                return [
                    'title'             => 'required|string|max:255|unique:sheikh_intro,title,' . $id,
                    'description'       => 'required|string',
                    'img'               => 'sometimes|image|mimes:jpg,jpeg,png,gif,webp|max:3000',
                    'meta_keywords'     => 'nullable|string',
                    'meta_description'  => 'nullable|string',
                    'meta_slug'         => 'nullable|string|alpha_dash|unique:sheikh_intro,meta_slug,' . $id,
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
            'title'             => 'عنوان النبذة',
            'description'       => 'المحتوى',
            'img'               => 'الصورة',
            'meta_keywords'     => 'كلمات الميتا',
            'meta_description'  => 'وصف الميتا',
            'meta_slug'         => 'رابط الميتا',
            'published_on'      => 'تاريخ النشر',
            'status'            => 'الحالة',
        ];
    }
}
