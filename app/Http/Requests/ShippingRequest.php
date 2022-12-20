<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShippingRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'phone' => 'required|max:11|min:10',
            'address' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'required' => ':attribute bắt buộc phải nhập',
            'min' => ':attribute bắt buộc phải nhập ít nhất :min số',
            'max' => ':attribute bắt buộc phải nhập ít hơn :max kí tự',
            'email' => ':attribute chưa đúng định dạng email',
            // 'alpha' => ':attribute không chưa kí tự đặc biệt'
        ];
    }
    public function attributes()
    {
        return [
            'name' => 'Tên',
            'email'=> 'Email',
            'phone' => 'Số Điện Thoại',
            'address' => 'Địa Chỉ Cụ Thể',
        ];
    }
}
