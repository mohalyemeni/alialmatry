<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class AudioRequest extends FormRequest
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
                    'title'         => 'required|string|max:255|unique:audios,title',
                    'description'   => 'nullable|string',
                    'img'           => 'required|image|mimes:jpg,jpeg,png,gif,webp|max:3000',
                    'audio_file'    => 'required|file|mimes:mp3,wav,mpeg,ogg|max:204800',
                    'category_id'   => 'required|exists:categories,id',
                    'meta_keywords' => 'nullable|string',
                    'meta_description' => 'nullable|string',
                    'meta_slug'     => 'nullable|string',
                    'published_on'  => 'required|date',
                    'status'        => 'required|boolean',
                ];
            case 'PUT':
            case 'PATCH':
                return [
                    'title'         => 'required|string|max:255|unique:audios,title,' . $this->route('audio'),
                    'description'   => 'nullable|string',
                    'img'           => 'sometimes|image|mimes:jpg,jpeg,png,gif,webp|max:3000',
                    'audio_file' => 'nullable|mimes:mp3,wav,ogg,aac,flac|max:204800',
                    'category_id'   => 'required|exists:categories,id',
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
            'audio_file'     => 'ملف الصوت',
            'category_id'    => 'التصنيف',
            'meta_keywords'  => 'كلمات الميتا',
            'meta_description' => 'وصف الميتا',
            'meta_slug'      => 'رابط الميتا',
            'published_on'   => 'تاريخ النشر',
            'status'         => 'الحالة',
        ];
    }
}