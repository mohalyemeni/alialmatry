<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
   public function rules(): array
   {
    switch ($this->method()) {
        case 'POST':
            return [
                'first_name' => 'required',
                'last_name'  => 'required',
                'username'   => 'required|max:20|unique:users',
                'email'      => 'required|email|max:255|unique:users',
                'mobile'     => 'required|numeric|unique:users',
                'status'     => 'required',
                'password'   => 'required|min:8',
                'user_image' => 'nullable|mimes:png,jpg,jpeg,svg|max:20000',
            ];

        case 'PUT':
        case 'PATCH':
            $id = $this->route('customer')->id;
            return [
                'first_name' => 'required',
                'last_name'  => 'required',
                'username'   => "required|max:20|unique:users,username,{$id}",
                'email'      => "required|email|max:255|unique:users,email,{$id}",
                'mobile'     => "required|numeric|unique:users,mobile,{$id}",
                'status'     => 'required',
                'password'   => 'nullable|min:8',
                'user_image' => 'nullable|mimes:png,jpg,jpeg,svg|max:20000',
            ];

        default:
            return [];
     }
 }

}