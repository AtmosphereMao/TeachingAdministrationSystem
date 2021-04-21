<?php

/*
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace App\Http\Requests\Frontend;

class LoginPasswordRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'email' => 'required',
            'password' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'email.required' => __('email.required'),
            'password.required' => __('password.required'),
        ];
    }

    public function filldata()
    {
        return [
            'email' => $this->post('email'),
            'password' => $this->post('password'),
        ];
    }
}
