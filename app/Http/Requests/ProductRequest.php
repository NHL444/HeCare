<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'pro_name' => 'required|min:6',
            'pro_price'=> 'required|numeric',
            'pro_descript' => 'required',
            'pro_origin' => 'required',
            'pro_profit' => 'required|numeric',
            'pro_discount' => 'numeric',
            'pro_qty' => 'required|numeric',
            'pro_content' => 'required'

        ];
    }
    public function messages()
    {
        return [
            'required' => ':attribute bắt buộc phải nhập',
            'min' => ':attribute không được nhỏ hơn :min kí tự',
            'numeric'=> ':attribute phải là số',
        ];
    }
    public function attributes()
    {
        return [
            'pro_name' => 'Tên sản phẩm',
            'pro_price' => 'Giá sản phẩm',
            'pro_descript'=>'Tóm tắt',
            'pro_origin' => 'Xuất xứ',
            'pro_profit' => 'Lợi nhuận',
            'pro_qty' => '% khuyến mãi',
            'pro_qty' => 'Số lượng',
            'pro_content' => 'Nội Dung'
        ];
    }
}
