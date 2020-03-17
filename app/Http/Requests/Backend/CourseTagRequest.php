<?php

namespace App\Http\Requests\Backend;


class CourseTagRequest extends BaseRequest
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
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '请输入分类名',
        ];
    }

    public function filldata()
    {
        return [
            'name' => $this->input('name'),
            'is_show' => $this->input('is_show', 0),
        ];
    }
}
