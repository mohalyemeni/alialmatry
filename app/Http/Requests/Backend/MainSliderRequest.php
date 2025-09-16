<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class MainSliderRequest extends FormRequest
{
    public function authorize()
    {
         return true;
    }

    public function rules()
    {
        switch ($this->method()) {
            case 'POST': {
                return [
                     'title'                 => 'required|string|max:255',
                    'subtitle'              => 'nullable|string|max:255',
                    'description'           => 'nullable|string',
                    'btn_title'             => 'nullable|string|max:255',
                     'url'                   => 'nullable|url|max:2048',

                     'show_btn_title'        => 'required|in:0,1,1',
                    'target'                => 'required|in:_self,_blank',
                    'section'               => 'nullable|integer',
                    'show_info'             => 'required|in:0,1',

                     'img'                   => 'required|image|mimes:jpg,jpeg,png,gif,webp|max:3072',

                     'metadata_title'        => 'nullable|string|max:255',
                    'metadata_description'  => 'nullable|string|max:500',
                    'metadata_keywords'     => 'nullable|string|max:500',


                    'status'                => 'required|in:0,1',
                   'published_on' => 'nullable|date',


                     'created_by'            => 'nullable|string|max:191',
                    'updated_by'            => 'nullable|string|max:191',
                    'deleted_by'            => 'nullable|string|max:191',
                ];
            }
            case 'PUT':
            case 'PATCH': {
                return [
                    'title'                 => 'required|string|max:255',
                    'subtitle'              => 'nullable|string|max:255',
                    'description'           => 'nullable|string',
                    'btn_title'             => 'nullable|string|max:255',
                    'url'                   => 'nullable|url|max:2048',

                    'show_btn_title'        => 'required|in:0,1',
                    'target'                => 'nullable|in:_self,_blank',
                    'section'               => 'nullable|integer',
                    'show_info'             => 'required|in:0,1',

                    'img'                   => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:3072',

                    'metadata_title'        => 'nullable|string|max:255',
                    'metadata_description'  => 'nullable|string|max:500',
                    'metadata_keywords'     => 'nullable|string|max:500',

                    'status'                => 'required|in:0,1',
                   'published_on' => 'nullable|date',


                    'created_by'            => 'nullable|string|max:191',
                    'updated_by'            => 'nullable|string|max:191',
                    'deleted_by'            => 'nullable|string|max:191',
                ];
            }
            default:
                return [];
        }
    }

    public function attributes()
    {
        return [
            'title' => 'العنوان',
            'subtitle' => 'العنوان الفرعي',
            'description' => 'الوصف',
            'img' => 'الصورة',
            'btn_title' => 'نص الزر',
            'url' => 'الرابط',
            'published_on' => 'تاريخ النشر',
            'status' => 'الحالة',
            'show_btn_title' => 'عرض زر التصفح',
            'show_info' => 'عرض معلومات الشريحة',
        ];
    }
}