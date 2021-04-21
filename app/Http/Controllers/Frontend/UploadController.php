<?php

/*
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace App\Http\Controllers\Frontend;

use App\Http\Requests\Frontend\UploadImageRequest;

class UploadController extends FrontendController
{
    public function imageHandler(UploadImageRequest $request)
    {
        [$path, $url] = $request->filldata();

        return $this->data(compact('path', 'url'));
    }
}
