<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
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
                    'title'         => 'required|string|max:255|unique:books,title',
                    'description'   => 'nullable|string',
                    'img'           => 'required|image|mimes:jpg,jpeg,png,gif,webp|max:3000',
                    'file'     => 'required|file|mimes:pdf,epub,doc,docx|max:204800',
                    'meta_keywords' => 'nullable|string',
                    'meta_description' => 'nullable|string',
                    'meta_slug'     => 'nullable|string',
                    'published_on'  => 'required|date',
                    'status'        => 'required|boolean',
                ];
            case 'PUT':
            case 'PATCH':
                return [
                    'title'         => 'required|string|max:255|unique:books,title,' . $this->route('book'),
                    'description'   => 'nullable|string',
                    'img'           => 'sometimes|image|mimes:jpg,jpeg,png,gif,webp|max:3000',
                    'file'     => 'nullable|file|mimes:pdf,epub,doc,docx|max:204800',
                    'meta_keywords' => 'nullable|string',
                    'meta_description' => 'nullable|string',
                    'meta_slug'     => 'nullable|string',
                    'published_on'  => 'required|date',
                    'status'        => 'required|boolean',
                ];
            default:
                return [];
        }
    }

    public function attributes()
    {
        return [
            'title'          => 'العنوان',
            'description'    => 'الوصف',
            'img'            => 'الصورة',
            'book_file'      => 'ملف الكتاب',
            'meta_keywords'  => 'كلمات الميتا',
            'meta_description' => 'وصف الميتا',
            'meta_slug'      => 'رابط الميتا',
            'published_on'   => 'تاريخ النشر',
            'status'         => 'الحالة',
        ];
    }
}