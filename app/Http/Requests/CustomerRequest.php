<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'cus_email' => ['required', 'string', 'email', 'max:255', 'unique:customers'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'phone' => ['required','max:11'],
        ];
    }
    public function messages()
    {
        return [
            'required' => ':attribute bắt buộc phải nhập',
            'min' => ':attribute bắt buộc phải nhập ít nhất 8 kí tự',
            'confirmed' => ':attribute không khớp, kiểm tra lại',
            'cus_email' => ':attribute chưa đúng định dạng email',
            'cus_email.unique' => ':attribute đã tồn tại'
        ];
    }
    public function attributes()
    {
        return [
            'name' => 'Tên',
            'cus_email'=> 'Email',
            'password' => 'Mật Khẩu',
            'phone' => 'Số Điện Thoại',
        ];
    }
}
