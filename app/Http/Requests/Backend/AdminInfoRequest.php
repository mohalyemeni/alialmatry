<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class AdminInfoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'username'   => 'required|unique:users,username,' . auth()->id(),
            'email'      => 'required|email|unique:users,email,' . auth()->id(),
            'mobile'     => 'required|unique:users,mobile,' . auth()->id(),
            'password'   => 'nullable|min:8',
        ];
    }


    public function messages()
    {
        return [
            'user_image.max' => 'The user image must not exceed 2MB in size.',
            'user_image.mimes' => 'Only PNG, JPG, JPEG, and GIF images are allowed.'
        ];
    }
}