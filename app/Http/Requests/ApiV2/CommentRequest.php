<?php

/*
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace App\Http\Requests\ApiV2;

class CommentRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'content' => 'required|min:6',
        ];
    }

    public function messages()
    {
        return [
            'content.required' => __('comment.content.required'),
            'content.min' => __('comment.content.min', ['count' => 6]),
        ];
    }

    public function filldata()
    {
        return ['content' => $this->post('content')];
    }
}
