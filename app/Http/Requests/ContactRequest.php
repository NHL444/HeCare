<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
            'name' => 'required',
            'email'=> 'required|email',
            'phone' => 'required|numeric|min:10',
            'content'=> 'required'
        ];
    }
    public function messages()
    {
        return [
            'required' => ':attribute không được bỏ trống',
            'min' => ':attribute không được nhỏ hơn :min kí tự',
            'numeric'=> ':attribute phải là số',
            'email' => 'Kiểm tra lại sai sót email'
        ];
    }
    public function attributes()
    {
        return [
            'name' => 'Tên quí khách',
            'email'=> 'Email',
            'phone' => 'Số điện thoại',
            'content'=> 'Nội dung'
        ];
    }
}
