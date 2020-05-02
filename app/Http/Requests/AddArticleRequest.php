<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddArticleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // 这里要改成 true
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     * 表单验证
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required',
            'desc' => 'required',
            'body' => 'required',
        ];
    }

    // 自定义验证信息
    public function messages()
    {
        return [
            'title.required' => '标题一定要写'
        ];
    }
}
