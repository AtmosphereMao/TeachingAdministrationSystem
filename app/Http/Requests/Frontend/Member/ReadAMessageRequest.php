<?php

/*
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace App\Http\Requests\Frontend\Member;

use App\Http\Requests\Frontend\BaseRequest;

class ReadAMessageRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'id' => 'required',
        ];
    }

    public function filldata()
    {
        return [
            'id' => $this->post('id'),
        ];
    }
}
