<?php

/*
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace App\Http\Controllers\Backend\Api\V1;

use App\Constant\BackendApiConstant;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Backend\ImageUploadRequest;
use App\Huawei\OBS;

class UploadController extends BaseController
{
    public function tinymceImageUpload(ImageUploadRequest $request)
    {
        $file = $request->filldata();
        $obsService = app()->make(OBS::class);
        $obs = $obsService->createOBS();
        $input = [
            'filename' => $file,
            'md5Code' => md5($file)
        ];
        $response = $obsService->uploadObs($input, $obs, 'uploadImage/');

        return ['location' => $response['ObjectURL']];
    }
}
