<?php

/*
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace App\Http\Requests\ApiV2;

class PasswordChangeRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'mobile' => 'required',
            'mobile_code' => 'required',
            'password' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'mobile.required' => __('mobile.required'),
            'mobile_code.required' => __('mobile_code.required'),
            'password.required' => __('password.required'),
        ];
    }

    public function filldata()
    {
        return [
            'password' => $this->post('password'),
            'mobile' => $this->post('mobile'),
        ];
    }
}
