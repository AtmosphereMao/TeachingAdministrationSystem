<?php

/*
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace App\Exceptions\Backend;

use Exception;

class ServiceException extends Exception
{
    public function render()
    {
        return response()->json([
            'status' => 500,
            'message' => $this->message,
        ]);
    }
}
