<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StaffRequest extends FormRequest
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
            'staff_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'unique:admins', 'string', 'email', 'max:255'],
            'staff_pass' => ['required', 'string', 'min:8', 'confirmed'],
            'staff_phone' => ['required','max:11'],
        ];
    }
    public function messages()
    {
        return [
            'required' => ':attribute bắt buộc phải nhập',
            'email.unique' => ':attribute đã tồn tại',
            'min' => ':attribute bắt buộc phải nhập ít nhất 8 kí tự',
            'confirmed' => ':attribute không khớp, kiểm tra lại',
            'email' => ':attribute chưa đúng định dạng email',
            
        ];
    }
    public function attributes()
    {
        return [
            'staff_name' => 'Tên',
            'email'=> 'Email',
            'staff_pass' => 'Mật Khẩu',
            'staff_phone' => 'Số Điện Thoại',
        ];
    }
}
