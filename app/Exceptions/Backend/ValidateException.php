<?php

/*
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace App\Exceptions\Backend;

class ValidateException extends \Exception
{
    public function render()
    {
        return response()->json([
            'status' => 406,
            'message' => $this->message,
        ]);
    }
}
