<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
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
            'atl_title'=> 'required|string|max:255',
            'atl_topic' => 'required|string|',
            'atl_content' => 'required',
            'atl_descript' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'required' => ':attribute bắt buộc phải nhập',
            // 'image' => ':attribute phải là hình ảnh',
            // 'mines' => ':attribute phải thuộc định dạng jpg hoặc png hoặc jpeg'
        ];
    }
    public function attributes()
    {
        return [
            'atl_title'=> 'Tiêu đề bài viết',
            'atl_topic' => 'Chủ đề',
            'atl_content' => 'Nội dung',
            'atl_descript' => 'Tóm tắt',
        ];
    }
}
