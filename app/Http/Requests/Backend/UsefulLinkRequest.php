<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class UsefulLinkRequest extends FormRequest
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
                    'title' => 'required|string|max:255|unique:useful_links,title',
                    'url'   => 'required|url|max:2048',
                    'meta_keywords'   => 'nullable|string',
                    'meta_description'=> 'nullable|string',
                    'meta_slug'       => 'nullable|string|max:255',
                    'published_on'    => 'nullable|date',
                    'status'          => 'required|boolean',
                ];
            case 'PUT':
            case 'PATCH':
                $id = $this->route('useful_link') ?? $this->route('id');
                return [
                    'title' => 'required|string|max:255|unique:useful_links,title,' . $id,
                    'url'   => 'required|url|max:2048',
                    'meta_keywords'   => 'nullable|string',
                    'meta_description'=> 'nullable|string',
                    'meta_slug'       => 'nullable|string|max:255',
                    'published_on'    => 'nullable|date',
                    'status'          => 'required|boolean',
                ];
            default:
                return [];
        }
    }

    public function attributes()
    {
        return [
            'title'           => 'العنوان',
            'url'             => 'الرابط',
            'meta_keywords'   => 'كلمات الميتا',
            'meta_description'=> 'وصف الميتا',
            'meta_slug'       => 'رابط الميتا',
            'published_on'    => 'تاريخ النشر',
            'status'          => 'الحالة',
        ];
    }
}